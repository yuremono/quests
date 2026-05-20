/**
 * RepulsionLists layout + chip interaction.
 * Ported from 0413portfolio src/pages/RepulsionLists/layout.ts + RepulsionListChip.tsx
 */
(function () {
  const root = document.querySelector("[data-portfolio-page]");
  if (!root) return;

  const card = root.querySelector("#repulsion-lists-card-container");
  const svg = root.querySelector(".repulsion-lists-lines");
  const touchTarget = root.querySelector("#repulsion-lists-horizontal-scroll-container");
  if (!(card instanceof HTMLElement) || !(svg instanceof SVGSVGElement)) return;

  const px = (value) => `${value.toFixed(2)}px`;
  const fixed = (value) => value.toFixed(2);

  const SCALE_ACTIVE = 1.4;
  const SCALE_IDLE = 0.7;
  const INFLUENCE_DISTANCE = 400;
  const JITTER_X = 275;
  const JITTER_Y = 80;
  const PUSH_X = -15;
  const PUSH_Y = 15;
  const OPACITY_ACTIVE = 1;
  const OPACITY_IDLE = 0.4;
  const REPULSION = 80;
  const REPULSION_DISTANCE = 400;
  const COLLISION_PADDING = 50;
  const COLLISION_DISTANCE = 300;
  const LINE_SECTORS = 3;
  const SETTLE_EVERY_FRAMES = 2;
  const SETTLE_DELTA = 0.5;
  const SETTLE_STABLE_FRAMES = 2;
  const SETTLE_TIMEOUT = 600;
  const MOBILE_BREAKPOINT = 1181;
  const TOUCH_SIDE_PADDING = 100;
  const TOUCH_THROTTLE = 32;
  const CARD_WIDTH = 1000;

  const distance = (from, to) => {
    const x = to.x - from.x;
    const y = to.y - from.y;
    return Math.sqrt(x * x + y * y);
  };

  const centerOf = (rect) => ({
    x: rect.left + rect.width / 2,
    y: rect.top + rect.height / 2,
  });

  const getPoints = () => {
    const points = new Map();
    card.querySelectorAll("[data-repulsion-list-chip]").forEach((node) => {
      if (!(node instanceof HTMLElement)) return;
      const rect = node.getBoundingClientRect();
      const id = node.getAttribute("data-repulsion-list-item-id");
      if (!id || rect.width <= 0 || rect.height <= 0) return;
      points.set(id, {
        id,
        point: centerOf(rect),
        element: node,
        jitterX: Number(node.getAttribute("data-jitter-x") || "0"),
        jitterY: Number(node.getAttribute("data-jitter-y") || "0"),
      });
    });
    return points;
  };

  const lineAngle = (from, to) => {
    const angle = Math.atan2(to.y - from.y, to.x - from.x);
    return angle < 0 ? angle + Math.PI * 2 : angle;
  };

  const getConnectionLines = (points) => {
    const lines = [];
    const seen = new Set();
    points.forEach((point, id) => {
      const currentPoint = "point" in point ? point.point : point;
      const neighbors = [];
      points.forEach((neighbor, neighborId) => {
        if (id === neighborId) return;
        const neighborPoint = "point" in neighbor ? neighbor.point : neighbor;
        neighbors.push({
          id: neighborId,
          point: neighborPoint,
          distance: distance(currentPoint, neighborPoint),
          angle: lineAngle(currentPoint, neighborPoint),
        });
      });
      const sectorSize = (Math.PI * 2) / LINE_SECTORS;
      for (let sector = 0; sector < LINE_SECTORS; sector += 1) {
        const start = sector * sectorSize;
        const end = (sector + 1) * sectorSize;
        const sectorNeighbors = neighbors.filter((neighbor) =>
          end > Math.PI * 2
            ? neighbor.angle >= start || neighbor.angle < end - Math.PI * 2
            : neighbor.angle >= start && neighbor.angle < end,
        );
        sectorNeighbors.sort((a, b) => a.distance - b.distance);
        const nearest = sectorNeighbors[0];
        if (!nearest) continue;
        const lineId = id < nearest.id ? `${id}-${nearest.id}` : `${nearest.id}-${id}`;
        if (seen.has(lineId)) continue;
        seen.add(lineId);
        lines.push({ id: lineId, from: currentPoint, to: nearest.point });
      }
    });
    return lines;
  };

  const getCollisionOffsets = (points) => {
    const offsets = new Map();
    points.forEach((_, id) => offsets.set(id, { deltaX: 0, deltaY: 0 }));
    const entries = Array.from(points.entries());
    for (let i = 0; i < entries.length; i += 1) {
      for (let j = i + 1; j < entries.length; j += 1) {
        const [leftId, leftPoint] = entries[i];
        const [rightId, rightPoint] = entries[j];
        if (distance(leftPoint.point, rightPoint.point) >= COLLISION_DISTANCE) continue;
        const leftLabel = leftPoint.element.querySelector(".repulsion-list-chip-label");
        const rightLabel = rightPoint.element.querySelector(".repulsion-list-chip-label");
        if (!leftLabel || !rightLabel) continue;
        const leftRect = leftLabel.getBoundingClientRect();
        const rightRect = rightLabel.getBoundingClientRect();
        const leftOffset = offsets.get(leftId);
        const rightOffset = offsets.get(rightId);
        if (!leftOffset || !rightOffset) continue;
        const leftBox = {
          left: leftRect.left + leftOffset.deltaX,
          right: leftRect.right + leftOffset.deltaX,
          top: leftRect.top + leftOffset.deltaY,
          bottom: leftRect.bottom + leftOffset.deltaY,
          centerX: leftRect.left + leftRect.width / 2 + leftOffset.deltaX,
          centerY: leftRect.top + leftRect.height / 2 + leftOffset.deltaY,
        };
        const rightBox = {
          left: rightRect.left + rightOffset.deltaX,
          right: rightRect.right + rightOffset.deltaX,
          top: rightRect.top + rightOffset.deltaY,
          bottom: rightRect.bottom + rightOffset.deltaY,
          centerX: rightRect.left + rightRect.width / 2 + rightOffset.deltaX,
          centerY: rightRect.top + rightRect.height / 2 + rightOffset.deltaY,
        };
        const intersects = !(
          leftBox.right + COLLISION_PADDING < rightBox.left ||
          leftBox.left - COLLISION_PADDING > rightBox.right ||
          leftBox.bottom + COLLISION_PADDING < rightBox.top ||
          leftBox.top - COLLISION_PADDING > rightBox.bottom
        );
        if (!intersects) continue;
        const overlapX =
          Math.min(leftBox.right, rightBox.right) -
          Math.max(leftBox.left, rightBox.left) +
          COLLISION_PADDING;
        const overlapY =
          Math.min(leftBox.bottom, rightBox.bottom) -
          Math.max(leftBox.top, rightBox.top) +
          COLLISION_PADDING;
        const directionX = leftBox.centerX < rightBox.centerX ? -1 : 1;
        const directionY = leftBox.centerY < rightBox.centerY ? -1 : 1;
        if (overlapY >= overlapX) {
          leftOffset.deltaX += (overlapX / 2) * directionX;
          rightOffset.deltaX -= (overlapX / 2) * directionX;
        } else {
          leftOffset.deltaY += (overlapY / 2) * directionY;
          rightOffset.deltaY -= (overlapY / 2) * directionY;
        }
      }
    }
    return offsets;
  };

  const getRelativePoints = (containerRect) => {
    const points = new Map();
    card.querySelectorAll("[data-repulsion-list-chip]").forEach((node) => {
      if (!(node instanceof HTMLElement)) return;
      const rect = node.getBoundingClientRect();
      const id = node.getAttribute("data-repulsion-list-item-id");
      if (!id || rect.width <= 0 || rect.height <= 0) return;
      const center = centerOf(rect);
      points.set(id, {
        x: center.x - containerRect.left,
        y: center.y - containerRect.top,
      });
    });
    return points;
  };

  const getPushOffset = (xRatio, yRatio) => ({
    x: Math.max(-1, Math.min(1, (xRatio - 0.5) * 2)) * PUSH_X,
    y: Math.max(-1, Math.min(1, (yRatio - 0.5) * 2)) * PUSH_Y,
  });

  const getVisualStates = (points, origin) => {
    const states = new Map();
    points.forEach((point, id) => {
      const itemDistance = distance(origin, point.point);
      const mix = Math.min(itemDistance / INFLUENCE_DISTANCE, 1);
      const baseScale = SCALE_ACTIVE - (SCALE_ACTIVE - SCALE_IDLE) * mix;
      const baseOpacity = OPACITY_ACTIVE - (OPACITY_ACTIVE - OPACITY_IDLE) * mix;
      states.set(id, {
        baseScale,
        visualScale: Math.max(SCALE_IDLE, Math.min(SCALE_ACTIVE, baseScale)),
        visualOpacity: Math.max(0, Math.min(1, baseOpacity)),
        distance: itemDistance,
      });
    });
    return states;
  };

  const getRepulsionOffsets = (points, states) => {
    const offsets = new Map();
    points.forEach((point, id) => {
      let x = 0;
      let y = 0;
      points.forEach((neighbor, neighborId) => {
        if (id === neighborId) return;
        const state = states.get(neighborId);
        if (!state || state.baseScale <= 1) return;
        const deltaX = point.point.x - neighbor.point.x;
        const deltaY = point.point.y - neighbor.point.y;
        const itemDistance = Math.sqrt(deltaX * deltaX + deltaY * deltaY);
        if (itemDistance > REPULSION_DISTANCE || itemDistance === 0) return;
        const strength =
          REPULSION *
          (state.baseScale - 1) *
          Math.max(0, 1 - itemDistance / REPULSION_DISTANCE);
        x += (deltaX / itemDistance) * strength;
        y += (deltaY / itemDistance) * strength;
      });
      offsets.set(id, { x, y });
    });
    return offsets;
  };

  const getPointSnapshot = (points) => {
    const snapshot = new Map();
    points.forEach((point, id) => {
      snapshot.set(id, { x: point.point.x, y: point.point.y });
    });
    return snapshot;
  };

  const getInitialFocusPoint = (points, rect) => {
    const focusElement = card.querySelector(".is-initial");
    if (!(focusElement instanceof HTMLElement)) return centerOf(rect);
    const id = focusElement.getAttribute("data-repulsion-list-item-id");
    if (!id) return centerOf(rect);
    return points.get(id)?.point ?? centerOf(rect);
  };

  const hasSettled = (current, previous) => {
    if (!previous || previous.size === 0) return false;
    let maxDelta = 0;
    current.forEach((point, id) => {
      const last = previous.get(id);
      if (!last) return;
      maxDelta = Math.max(maxDelta, Math.abs(point.x - last.x), Math.abs(point.y - last.y));
    });
    return maxDelta < SETTLE_DELTA;
  };

  let moveFrame = null;
  let settleFrame = null;
  let previousSnapshot = null;
  let touchActive = false;
  let touchStartX = 0;
  let currentTranslate = 0;
  let startTranslate = 0;
  let cachedWindowWidth = window.innerWidth;
  let maxMobileTranslate =
    (CARD_WIDTH + TOUCH_SIDE_PADDING * 2 - window.innerWidth) / 2;
  let lastTouchLayout = 0;
  let stableFrames = 0;
  let settleTicks = 0;
  let activeChipId = null;

  const measure = () => {
    const rect = card.getBoundingClientRect();
    cachedWindowWidth = window.innerWidth;
    maxMobileTranslate = (CARD_WIDTH + TOUCH_SIDE_PADDING * 2 - window.innerWidth) / 2;
    return rect;
  };

  const drawLines = (rect, points) => {
    if (rect.width <= 0 || rect.height <= 0) return;
    const viewBox = `0 0 ${rect.width} ${rect.height}`;
    if (svg.getAttribute("viewBox") !== viewBox) {
      svg.setAttribute("viewBox", viewBox);
    }
    if (points.size === 0) return;
    const existing = new Map();
    svg.querySelectorAll("line[data-connection-id]").forEach((line) => {
      if (!(line instanceof SVGLineElement)) return;
      const id = line.getAttribute("data-connection-id");
      if (id) existing.set(id, line);
    });
    getConnectionLines(points).forEach((line) => {
      let element = existing.get(line.id);
      if (!element) {
        element = document.createElementNS("http://www.w3.org/2000/svg", "line");
        element.setAttribute("data-connection-id", line.id);
        element.setAttribute("stroke", "#D7D7CF");
        element.setAttribute("stroke-width", "1");
        element.setAttribute("stroke-opacity", "0.8");
        element.style.transition =
          "x1 300ms ease-out, y1 300ms ease-out, x2 300ms ease-out, y2 300ms ease-out";
        svg.appendChild(element);
      }
      element.setAttribute("x1", line.from.x.toString());
      element.setAttribute("y1", line.from.y.toString());
      element.setAttribute("x2", line.to.x.toString());
      element.setAttribute("y2", line.to.y.toString());
      existing.delete(line.id);
    });
    existing.forEach((line) => line.remove());
  };

  const positionPopups = (rect, points) => {
    const cardCenter = centerOf(rect);
    points.forEach((point, id) => {
      const element = card.querySelector(`[data-repulsion-list-item-id="${id}"]`);
      if (!(element instanceof HTMLElement)) return;
      const opensLeft = point.point.x < cardCenter.x;
      const opensDown = point.point.y < cardCenter.y;
      element.style.setProperty("--popup-top", opensDown ? "98%" : "0%");
      element.style.setProperty("--popup-left", opensLeft ? "0%" : "98%");
      element.style.setProperty("--popup-translate-y", opensDown ? "0%" : "-98%");
      element.style.setProperty("--popup-translate-x", opensLeft ? "0%" : "-98%");
      element.style.setProperty("--popup-origin-y", opensDown ? "top" : "bottom");
      element.style.setProperty("--popup-border-top", opensDown ? "1px solid #434343" : "0");
      element.style.setProperty("--popup-border-bottom", opensDown ? "0" : "1px solid #434343");
      element.style.setProperty("--popup-opens-down", opensDown ? "1.3" : "0");
    });
  };

  const applyLayout = (pointer, push, collisionOffsets = new Map()) => {
    const points = getPoints();
    const states = getVisualStates(points, pointer);
    const repulsionOffsets = getRepulsionOffsets(points, states);

    points.forEach((point) => {
      const state = states.get(point.id);
      if (!state) return;
      const repulsion = repulsionOffsets.get(point.id) ?? { x: 0, y: 0 };
      const collision = collisionOffsets.get(point.id) ?? { deltaX: 0, deltaY: 0 };
      const x =
        push.x +
        repulsion.x +
        (point.jitterX / 100) * JITTER_X +
        collision.deltaX;
      const y =
        push.y +
        repulsion.y +
        (point.jitterY / 100) * JITTER_Y +
        collision.deltaY;
      point.element.style.transform = `translate(${px(x)}, ${px(y)})`;
      point.element.style.setProperty("--repulsion-list-chip-dynamic-scale", fixed(state.visualScale));
      point.element.style.setProperty("--repulsion-list-chip-dynamic-opacity", fixed(state.visualOpacity));
      const currentState = point.element.getAttribute("data-state");
      if (state.distance < COLLISION_DISTANCE && currentState === "idle") {
        point.element.setAttribute("data-state", "proximity");
      }
      if (state.distance >= COLLISION_DISTANCE && currentState === "proximity") {
        point.element.setAttribute("data-state", "idle");
      }
    });

    const rect = card.getBoundingClientRect();
    drawLines(rect, getRelativePoints(rect));
    return points;
  };

  const settleOnce = () => {
    const rect = measure();
    if (rect.width <= 0 || rect.height <= 0) return;
    const points = getPoints();
    const collisionOffsets = getCollisionOffsets(points);
    positionPopups(rect, points);
    applyLayout(getInitialFocusPoint(points, rect), { x: 0, y: 0 }, collisionOffsets);
  };

  const stopSettle = () => {
    if (settleFrame !== null) cancelAnimationFrame(settleFrame);
    settleFrame = null;
    previousSnapshot = null;
    stableFrames = 0;
    settleTicks = 0;
  };

  const runSettle = (finalize = true) => {
    stopSettle();
    measure();
    const startedAt = performance.now();
    const step = () => {
      if (performance.now() - startedAt > SETTLE_TIMEOUT) {
        if (finalize) settleOnce();
        stopSettle();
        return;
      }
      const rect = measure();
      if (rect.width <= 0 || rect.height <= 0) {
        settleFrame = requestAnimationFrame(step);
        return;
      }
      settleTicks += 1;
      if (settleTicks >= SETTLE_EVERY_FRAMES) {
        const points = getPoints();
        applyLayout(getInitialFocusPoint(points, rect), { x: 0, y: 0 });
        settleTicks = 0;
      }
      const snapshot = getPointSnapshot(getPoints());
      if (hasSettled(snapshot, previousSnapshot)) {
        stableFrames += 1;
        if (stableFrames >= SETTLE_STABLE_FRAMES) {
          if (finalize) settleOnce();
          stopSettle();
          return;
        }
      } else {
        stableFrames = 0;
      }
      previousSnapshot = snapshot;
      settleFrame = requestAnimationFrame(step);
    };
    settleFrame = requestAnimationFrame(step);
  };

  const schedulePointerLayout = (pointer, push) => {
    if (moveFrame !== null) return;
    moveFrame = requestAnimationFrame(() => {
      applyLayout(pointer, push);
      moveFrame = null;
    });
  };

  const handleMove = (event) => {
    const rect = card.getBoundingClientRect();
    const xRatio = (event.clientX - rect.left) / rect.width;
    const yRatio = (event.clientY - rect.top) / rect.height;
    schedulePointerLayout({ x: event.clientX, y: event.clientY }, getPushOffset(xRatio, yRatio));
  };

  const handleLeave = () => {
    if (moveFrame !== null) {
      cancelAnimationFrame(moveFrame);
      moveFrame = null;
    }
    runSettle(false);
  };

  const handleChipFocus = (event) => {
    const detail = event.detail;
    if (!detail) return;
    applyLayout({ x: detail.x, y: detail.y }, { x: 0, y: 0 });
  };

  const handleResize = () => {
    if (window.innerWidth !== cachedWindowWidth) {
      currentTranslate = 0;
      card.style.transform = "";
      runSettle(true);
    }
  };

  const handleTouchStart = (event) => {
    if (cachedWindowWidth >= MOBILE_BREAKPOINT) return;
    touchActive = true;
    touchStartX = event.touches[0].clientX;
    startTranslate = currentTranslate;
  };

  const handleTouchMove = (event) => {
    if (!touchActive) return;
    const nextTranslate = startTranslate + event.touches[0].clientX - touchStartX;
    if (Math.abs(nextTranslate) > maxMobileTranslate) return;
    currentTranslate = nextTranslate;
    card.style.transform = `translateX(${nextTranslate}px)`;
    const now = performance.now();
    if (now - lastTouchLayout >= TOUCH_THROTTLE) {
      lastTouchLayout = now;
      const rect = measure();
      applyLayout({ x: cachedWindowWidth / 2, y: rect.top + rect.height / 2 }, { x: 0, y: 0 });
    }
  };

  const handleTouchEnd = () => {
    if (touchActive) {
      const rect = measure();
      applyLayout({ x: cachedWindowWidth / 2, y: rect.top + rect.height / 2 }, { x: 0, y: 0 });
    }
    touchActive = false;
  };

  const handleChipActivate = (event) => {
    if (cachedWindowWidth >= MOBILE_BREAKPOINT) return;
    const detail = event.detail;
    const points = getPoints();
    const point = detail?.tagId ? points.get(detail.tagId) : undefined;
    if (!point) return;
    const nextTranslate = Math.max(
      -maxMobileTranslate,
      Math.min(maxMobileTranslate, cachedWindowWidth / 2 - point.point.x + currentTranslate),
    );
    currentTranslate = nextTranslate;
    card.style.transform = `translateX(${nextTranslate}px)`;
    const rect = measure();
    applyLayout({ x: cachedWindowWidth / 2, y: rect.top + rect.height / 2 }, { x: 0, y: 0 });
  };

  const closeAllChips = () => {
    activeChipId = null;
    card.querySelectorAll("[data-repulsion-list-chip]").forEach((node) => {
      if (!(node instanceof HTMLElement)) return;
      if (node.getAttribute("data-state") === "active") {
        node.setAttribute("data-state", "closing");
        const popup = node.querySelector(".repulsion-list-chip-popup");
        if (popup instanceof HTMLElement) {
          popup.style.setProperty("--repulsion-list-chip-grid-rows", "0fr");
          window.setTimeout(() => {
            node.setAttribute("data-state", "idle");
            popup.style.removeProperty("--repulsion-list-chip-grid-rows");
          }, 400);
        }
      }
    });
  };

  card.querySelectorAll("[data-repulsion-list-chip]").forEach((chip) => {
    if (!(chip instanceof HTMLElement)) return;
    const popup = chip.querySelector(".repulsion-list-chip-popup");
    const id = chip.getAttribute("data-repulsion-list-item-id");
    let openTimer = null;
    let closeTimer = null;

    const clearTimers = () => {
      if (openTimer !== null) window.clearTimeout(openTimer);
      if (closeTimer !== null) window.clearTimeout(closeTimer);
      openTimer = null;
      closeTimer = null;
    };

    const openChip = () => {
      if (!id) return;
      clearTimers();
      activeChipId = id;
      chip.setAttribute("data-state", "active");
      if (popup instanceof HTMLElement) {
        popup.style.setProperty("--repulsion-list-chip-grid-rows", "1fr");
      }
      chip.dispatchEvent(
        new CustomEvent("repulsion-list-chip:activate", {
          bubbles: true,
          detail: { tagId: id },
        }),
      );
    };

    const closeChip = () => {
      clearTimers();
      if (chip.getAttribute("data-state") !== "active") return;
      chip.setAttribute("data-state", "closing");
      if (popup instanceof HTMLElement) {
        popup.style.setProperty("--repulsion-list-chip-grid-rows", "0fr");
      }
      closeTimer = window.setTimeout(() => {
        chip.setAttribute("data-state", "idle");
        if (popup instanceof HTMLElement) {
          popup.style.removeProperty("--repulsion-list-chip-grid-rows");
        }
        if (activeChipId === id) activeChipId = null;
        closeTimer = null;
      }, 400);
    };

    const emitFocus = () => {
      const rect = chip.getBoundingClientRect();
      chip.dispatchEvent(
        new CustomEvent("repulsion-list-chip:focus", {
          bubbles: true,
          detail: {
            x: rect.left + rect.width / 2,
            y: rect.top + rect.height / 2,
          },
        }),
      );
    };

    chip.addEventListener("mouseenter", () => {
      openTimer = window.setTimeout(() => {
        emitFocus();
        openChip();
        openTimer = null;
      }, 50);
    });
    chip.addEventListener("mouseleave", closeChip);

    const link = chip.querySelector("a");
    if (link instanceof HTMLAnchorElement) {
      link.addEventListener("focus", () => {
        emitFocus();
        openChip();
      });
      link.addEventListener("blur", closeChip);
    }
  });

  if (touchTarget instanceof HTMLElement) {
    touchTarget.addEventListener("pointerleave", closeAllChips);
    touchTarget.addEventListener("blur", (event) => {
      const nextTarget = event.relatedTarget;
      if (!(nextTarget instanceof Node) || !touchTarget.contains(nextTarget)) {
        closeAllChips();
      }
    });
  }

  const initialFrame = requestAnimationFrame(() => runSettle(true));
  card.addEventListener("repulsion-list-chip:focus", handleChipFocus);
  card.addEventListener("repulsion-list-chip:activate", handleChipActivate);
  card.addEventListener("mouseenter", stopSettle);
  card.addEventListener("mousemove", handleMove);
  card.addEventListener("mouseleave", handleLeave);
  window.addEventListener("resize", handleResize);
  touchTarget?.addEventListener("touchstart", handleTouchStart, { passive: true });
  touchTarget?.addEventListener("touchmove", handleTouchMove, { passive: true });
  touchTarget?.addEventListener("touchend", handleTouchEnd, { passive: true });
  touchTarget?.addEventListener("touchcancel", handleTouchEnd, { passive: true });

  window.addEventListener("beforeunload", () => {
    cancelAnimationFrame(initialFrame);
    if (moveFrame !== null) cancelAnimationFrame(moveFrame);
    if (settleFrame !== null) cancelAnimationFrame(settleFrame);
  });
})();
