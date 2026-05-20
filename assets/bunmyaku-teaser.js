/**
 * BunmyakuTeaserSection canvas animation.
 * Ported from 0413portfolio src/components/BunmyakuTeaserSection.tsx
 */
(function () {
  const root = document.querySelector("[data-bunmyaku-teaser]");
  if (!(root instanceof HTMLElement)) return;

  const BUDOUX_SELECTOR = ".BudouxFade";
  const BUDOUX_PHRASE_CLASS = "BudouxFadePhrase";
  const BUDOUX_ATTR = "data-budoux-fade";
  const BUDOUX_ZWSP = "\u200B";

  const clamp01 = (value) => Math.min(1, Math.max(0, value));
  const easeOutCubic = (value) => 1 - (1 - value) ** 3;
  const easeInPower = (value, power) => value ** power;
  const progressBetween = (value, start, end) => clamp01((value - start) / (end - start));

  const readNumber = (value, fallback) => {
    const parsed = Number.parseFloat(value);
    return Number.isFinite(parsed) ? parsed : fallback;
  };

  const segmentText = (text) => {
    if (window.Intl && typeof Intl.Segmenter === "function") {
      const segmenter = new Intl.Segmenter("ja", { granularity: "word" });
      return Array.from(segmenter.segment(text), (part) => part.segment).filter(Boolean);
    }
    return text ? [text] : [];
  };

  const wrapTextNode = (textNode) => {
    const raw = textNode.nodeValue ?? "";
    if (raw.trim() === "") {
      textNode.remove();
      return;
    }

    const ownerDocument = textNode.ownerDocument;
    const fragment = ownerDocument.createDocumentFragment();

    const lines = raw.split(/\r?\n/);
    let appended = false;

    lines.forEach((line, lineIndex) => {
      const trimmed = line.trim();
      if (trimmed !== "") {
        const phrases = segmentText(trimmed);
        phrases.forEach((phrase, index) => {
          const span = ownerDocument.createElement("span");
          span.className = BUDOUX_PHRASE_CLASS;
          span.textContent = phrase;
          fragment.append(span);

          if (index < phrases.length - 1) {
            fragment.append(ownerDocument.createTextNode(BUDOUX_ZWSP));
          }
        });
        appended = true;
      }

      if (lineIndex < lines.length - 1) {
        fragment.append(ownerDocument.createElement("br"));
        appended = true;
      }
    });

    if (!appended) {
      textNode.remove();
      return;
    }

    textNode.replaceWith(fragment);
  };

  const wrapElement = (element) => {
    Array.from(element.childNodes).forEach((node) => {
      if (node instanceof Text) {
        wrapTextNode(node);
        return;
      }
      if (node instanceof HTMLBRElement) return;
      if (node instanceof HTMLElement) {
        wrapElement(node);
      }
    });
  };

  const prepareBudouxElement = (element) => {
    if (!element.hasAttribute(BUDOUX_ATTR)) {
      element.setAttribute(BUDOUX_ATTR, "1");
      wrapElement(element);
    }

    return Array.from(element.querySelectorAll(`.${BUDOUX_PHRASE_CLASS}`)).filter(
      (phrase) => phrase instanceof HTMLElement,
    );
  };

  const resolveViewportValue = (value, viewportHeight) =>
    value <= 1 ? viewportHeight * value : value;

  const resolveRangeValue = (value, viewportHeight, elementHeight) =>
    value <= 1 ? Math.max(viewportHeight, elementHeight) * value : value;

  const readBudouxConfig = (element) => {
    const style = window.getComputedStyle(element);
    const triggerFallback = readNumber(
      style.getPropertyValue("--BudouxFadeFocus"),
      0.68,
    );
    return {
      minOpacity: clamp01(readNumber(style.getPropertyValue("--BudouxFadeMin"), 0.3)),
      trigger: readNumber(style.getPropertyValue("--BudouxFadeTrigger"), triggerFallback),
      range: readNumber(style.getPropertyValue("--BudouxFadeRange"), 1),
    };
  };

  const updateBudouxState = (state) => {
    const config = readBudouxConfig(state.element);
    const viewportHeight = window.innerHeight || document.documentElement.clientHeight;
    const triggerY = resolveViewportValue(config.trigger, viewportHeight);
    const rect = state.element.getBoundingClientRect();
    const range = Math.max(1, resolveRangeValue(config.range, viewportHeight, rect.height));
    const progress = clamp01((triggerY - rect.top) / range);
    const activeCount = progress <= 0 ? 0 : Math.ceil(progress * state.phrases.length);

    state.phrases.forEach((phrase, index) => {
      phrase.style.opacity = index < activeCount ? "1" : String(config.minOpacity);
    });
  };

  const initBudouxFade = (base) => {
    const targets = [];
    if (base instanceof HTMLElement && base.matches(BUDOUX_SELECTOR)) {
      targets.push(base);
    }
    targets.push(
      ...Array.from(base.querySelectorAll(BUDOUX_SELECTOR)).filter(
        (element) => element instanceof HTMLElement,
      ),
    );

    const states = targets
      .map((element) => ({
        element,
        phrases: prepareBudouxElement(element),
      }))
      .filter((state) => state.phrases.length > 0);

    if (states.length === 0) {
      return { disconnect: () => {} };
    }

    let rafId = null;

    const updateStates = () => {
      rafId = null;
      states.forEach(updateBudouxState);
    };

    const scheduleUpdate = () => {
      if (rafId !== null) return;
      rafId = window.requestAnimationFrame(updateStates);
    };

    const observer = new IntersectionObserver(
      () => {
        scheduleUpdate();
      },
      { rootMargin: "30% 0px 30% 0px" },
    );

    states.forEach((state) => {
      observer.observe(state.element);
    });

    window.addEventListener("scroll", scheduleUpdate, { passive: true });
    window.addEventListener("resize", scheduleUpdate);
    scheduleUpdate();

    return {
      disconnect: () => {
        observer.disconnect();
        window.removeEventListener("scroll", scheduleUpdate);
        window.removeEventListener("resize", scheduleUpdate);
        if (rafId !== null) {
          window.cancelAnimationFrame(rafId);
        }
      },
    };
  };

  const budouxFadeRuntime = initBudouxFade(root);

  const canvas = root.querySelector("canvas");
  if (!(canvas instanceof HTMLCanvasElement)) {
    budouxFadeRuntime.disconnect();
    return;
  }

  const COLOR_SCHEME = {
    "--background": "oklch(0.16 0.055 255)",
    "--foreground": "oklch(0.8 0.02 235)",
    "--MC": "oklch(0.16 0.055 255)",
    "--SC": "oklch(0.22 0.9 188)",
    "--AC": "oklch(0.45 0.9 188)",
    "--BC": "oklch(0.115 0.035 255)",
    "--TC": "oklch(0.8 0.02 255)",
    "--GR": "oklch(0.62 0.025 255)",
    "--Eng": "var(--Ship)",
    "--HFF": "var(--Ship)",
  };

  const CANVAS_COLOR = {
    base: "oklch(80% 0.005 60)",
    active: "oklch(0.9 0.02 235)",
  };

  const VIEWBOX = 1000;
  const FRAGMENT_STEP = 2;
  const CANVAS_MAX_DPR = 2;
  const FRAGMENT_SKIP_WHEN_FILL_OPACITY = 0.82;

  const TIMELINE = {
    fragmentIntroStart: 0.02,
    fragmentIntroLength: 0.52,
    gatherEnd: 0.35,
    gatherPower: 2,
    fillStart: 0.325,
    fillFadeLength: 1,
    fragmentFadeStart: 0.3,
    fragmentFinalOpacity: 0.0,
  };

  const COLOR_SCHEME_INTERSECTION = {
    root: null,
    rootMargin: "0% 0px 50% 0px",
    thresholdSteps: 10,
    activeBoundary: 0.5,
  };

  const inkBlobs = [
    { x: 255, y: 245, radius: 245, blur: 34, delay: 0 },
    { x: 525, y: 235, radius: 250, blur: 42, delay: 0.08 },
    { x: 765, y: 325, radius: 190, blur: 32, delay: 0.16 },
    { x: 310, y: 650, radius: 205, blur: 38, delay: 0.24 },
    { x: 560, y: 650, radius: 250, blur: 48, delay: 0.32 },
    { x: 760, y: 610, radius: 165, blur: 30, delay: 0.4 },
    { x: 430, y: 430, radius: 150, blur: 26, delay: 0.5 },
    { x: 650, y: 465, radius: 135, blur: 24, delay: 0.6 },
  ];

  let rafRef = null;
  let particleField = null;
  let colorSchemeActive = false;

  const randomFromIndex = (index) => {
    const value = Math.sin(index * 12.9898) * 43758.5453;
    return value - Math.floor(value);
  };

  const resolveShipFont = () => {
    const ship = getComputedStyle(document.documentElement).getPropertyValue("--Ship").trim();
    return ship || '"Shippori Mincho", serif';
  };

  const createParticleField = (font) => {
    const mask = document.createElement("canvas");
    mask.width = VIEWBOX;
    mask.height = VIEWBOX;
    const maskCtx = mask.getContext("2d", { willReadFrequently: true });
    if (!maskCtx) {
      return { font, mask, coloredMasks: new Map(), fragments: [], inkBlobs };
    }
    maskCtx.clearRect(0, 0, VIEWBOX, VIEWBOX);
    maskCtx.font = `940px ${font}`;
    maskCtx.lineWidth = 1.25;
    maskCtx.miterLimit = 2;
    maskCtx.strokeStyle = "#000";
    maskCtx.textAlign = "center";
    maskCtx.textBaseline = "middle";
    maskCtx.strokeText("文", VIEWBOX / 2, VIEWBOX / 2 + 48);

    const data = maskCtx.getImageData(0, 0, VIEWBOX, VIEWBOX).data;
    const fragments = [];
    for (let y = 0; y < VIEWBOX; y += FRAGMENT_STEP) {
      for (let x = 0; x < VIEWBOX; x += FRAGMENT_STEP) {
        let maxAlpha = 0;
        for (let yy = y; yy < Math.min(y + FRAGMENT_STEP, VIEWBOX); yy += 1) {
          for (let xx = x; xx < Math.min(x + FRAGMENT_STEP, VIEWBOX); xx += 1) {
            maxAlpha = Math.max(maxAlpha, data[(yy * VIEWBOX + xx) * 4 + 3]);
          }
        }
        if (maxAlpha <= 24) continue;
        const index = fragments.length;
        const angle = randomFromIndex(index + 11) * Math.PI * 2;
        const dist = 180 + randomFromIndex(index + 23) * 540;
        fragments.push({
          sourceX: x,
          sourceY: y,
          size: FRAGMENT_STEP,
          startX: x + Math.cos(angle) * dist,
          startY: y + Math.sin(angle) * dist,
          targetX: x,
          targetY: y,
          opacity: maxAlpha / 255,
          delay: randomFromIndex(index + 47) * 0.18,
        });
      }
    }
    return { font, mask, coloredMasks: new Map(), fragments, inkBlobs };
  };

  const createColoredMask = (field, foreground) => {
    const cachedMask = field.coloredMasks.get(foreground);
    if (cachedMask) return cachedMask;
    const coloredMask = document.createElement("canvas");
    coloredMask.width = field.mask.width;
    coloredMask.height = field.mask.height;
    const coloredMaskCtx = coloredMask.getContext("2d");
    if (!coloredMaskCtx) return null;
    coloredMaskCtx.fillStyle = foreground;
    coloredMaskCtx.fillRect(0, 0, coloredMask.width, coloredMask.height);
    coloredMaskCtx.globalCompositeOperation = "destination-in";
    coloredMaskCtx.drawImage(field.mask, 0, 0);
    field.coloredMasks.set(foreground, coloredMask);
    return coloredMask;
  };

  const drawInkFill = (ctx, width, height, scale, tx, ty, font, foreground, blobs, progress, opacity) => {
    const inkCanvas = document.createElement("canvas");
    inkCanvas.width = width;
    inkCanvas.height = height;
    const inkCtx = inkCanvas.getContext("2d");
    if (!inkCtx) return;
    inkCtx.setTransform(scale, 0, 0, scale, tx, ty);
    inkCtx.fillStyle = foreground;
    for (const blob of blobs) {
      const blobProgress = easeOutCubic(clamp01((progress - blob.delay) / (1 - blob.delay)));
      if (blobProgress <= 0) continue;
      inkCtx.save();
      inkCtx.globalAlpha = Math.min(1, 0.35 + blobProgress * 0.85);
      inkCtx.filter = `blur(${blob.blur * scale}px)`;
      inkCtx.beginPath();
      inkCtx.arc(blob.x, blob.y, blob.radius * (0.18 + blobProgress * 0.98), 0, Math.PI * 2);
      inkCtx.fill();
      inkCtx.restore();
    }
    inkCtx.globalCompositeOperation = "destination-in";
    inkCtx.filter = "none";
    inkCtx.font = `940px ${font}`;
    inkCtx.textAlign = "center";
    inkCtx.textBaseline = "middle";
    inkCtx.fillStyle = "#000";
    inkCtx.fillText("文", VIEWBOX / 2, VIEWBOX / 2 + 48);
    ctx.save();
    ctx.globalAlpha = opacity;
    ctx.drawImage(inkCanvas, 0, 0);
    ctx.restore();
  };

  const render = () => {
    const ctx = canvas.getContext("2d");
    if (!ctx) return;

    const rect = canvas.getBoundingClientRect();
    const dpr = Math.min(window.devicePixelRatio || 1, CANVAS_MAX_DPR);
    const width = Math.max(1, Math.floor(rect.width * dpr));
    const height = Math.max(1, Math.floor(rect.height * dpr));

    if (canvas.width !== width || canvas.height !== height) {
      canvas.width = width;
      canvas.height = height;
    }

    const size = width;
    const scale = size / VIEWBOX;
    const tx = 0;
    const ty = (height - size) / 2;
    const rootRect = root.getBoundingClientRect();
    const viewportHeight = window.innerHeight || height;
    const scrollProgress = rootRect
      ? clamp01((viewportHeight - rootRect.top) / (viewportHeight + rootRect.height))
      : 0;
    const gatherProgress = easeInPower(
      progressBetween(scrollProgress, TIMELINE.fragmentIntroStart, TIMELINE.gatherEnd),
      TIMELINE.gatherPower,
    );
    const fragmentIntroOpacity = easeOutCubic(
      progressBetween(
        scrollProgress,
        TIMELINE.fragmentIntroStart,
        TIMELINE.fragmentIntroStart + TIMELINE.fragmentIntroLength,
      ),
    );
    const fillProgress = easeOutCubic(progressBetween(scrollProgress, TIMELINE.fillStart, 1));
    const fillOpacity = easeOutCubic(
      progressBetween(scrollProgress, TIMELINE.fillStart, TIMELINE.fillStart + TIMELINE.fillFadeLength),
    );
    const fragmentFadeProgress = easeOutCubic(
      progressBetween(scrollProgress, TIMELINE.fragmentFadeStart, 1),
    );
    const fragmentOpacity =
      fragmentIntroOpacity * (1 - fragmentFadeProgress * (1 - TIMELINE.fragmentFinalOpacity));
    const font = resolveShipFont();
    const canvasColor = colorSchemeActive ? CANVAS_COLOR.active : CANVAS_COLOR.base;

    if (particleField?.font !== font) {
      particleField = createParticleField(font);
    }

    ctx.setTransform(1, 0, 0, 1, 0, 0);
    ctx.clearRect(0, 0, width, height);

    if (fillProgress > 0) {
      drawInkFill(
        ctx,
        width,
        height,
        scale,
        tx,
        ty,
        font,
        canvasColor,
        particleField?.inkBlobs ?? inkBlobs,
        fillProgress,
        fillOpacity,
      );
    }

    ctx.setTransform(scale, 0, 0, scale, tx, ty);

    const field = particleField;
    const coloredMask = field ? createColoredMask(field, canvasColor) : null;
    if (field && coloredMask && fragmentOpacity > 0 && fillOpacity < FRAGMENT_SKIP_WHEN_FILL_OPACITY) {
      for (const fragment of field.fragments) {
        const fragmentProgress = clamp01((gatherProgress - fragment.delay) / (1 - fragment.delay));
        const easedFragmentProgress = easeInPower(fragmentProgress, TIMELINE.gatherPower);
        const x = fragment.startX + (fragment.targetX - fragment.startX) * easedFragmentProgress;
        const y = fragment.startY + (fragment.targetY - fragment.startY) * easedFragmentProgress;
        ctx.globalAlpha = fragment.opacity * (0.25 + fragmentProgress * 0.75) * fragmentOpacity;
        ctx.drawImage(
          coloredMask,
          fragment.sourceX,
          fragment.sourceY,
          fragment.size,
          fragment.size,
          x,
          y,
          fragment.size,
          fragment.size,
        );
      }
    }
    ctx.globalAlpha = 1;
  };

  const scheduleRender = () => {
    if (rafRef !== null) return;
    rafRef = window.requestAnimationFrame(() => {
      rafRef = null;
      render();
    });
  };

  const previousScheme = new Map();
  let schemeActive = false;

  const applyScheme = () => {
    if (schemeActive) return;
    schemeActive = true;
    colorSchemeActive = true;
    Object.keys(COLOR_SCHEME).forEach((key) => {
      previousScheme.set(key, document.documentElement.style.getPropertyValue(key));
      document.documentElement.style.setProperty(key, COLOR_SCHEME[key]);
    });
    scheduleRender();
  };

  const restoreScheme = () => {
    if (!schemeActive) return;
    schemeActive = false;
    colorSchemeActive = false;
    Object.keys(COLOR_SCHEME).forEach((key) => {
      const value = previousScheme.get(key);
      if (value) {
        document.documentElement.style.setProperty(key, value);
      } else {
        document.documentElement.style.removeProperty(key);
      }
    });
    previousScheme.clear();
    scheduleRender();
  };

  const observer = new IntersectionObserver(
    (entries) => {
      const entry = entries[0];
      const rootHeight = entry.rootBounds?.height ?? window.innerHeight;
      const visible = entry.intersectionRect.height / rootHeight;
      if (entry.isIntersecting && visible >= COLOR_SCHEME_INTERSECTION.activeBoundary) {
        applyScheme();
      } else {
        restoreScheme();
      }
    },
    {
      root: COLOR_SCHEME_INTERSECTION.root,
      rootMargin: COLOR_SCHEME_INTERSECTION.rootMargin,
      threshold: Array.from(
        { length: COLOR_SCHEME_INTERSECTION.thresholdSteps + 1 },
        (_, index) => index / COLOR_SCHEME_INTERSECTION.thresholdSteps,
      ),
    },
  );

  render();
  window.addEventListener("scroll", scheduleRender, { passive: true });
  window.addEventListener("resize", scheduleRender, { passive: true });
  const resizeObserver = new ResizeObserver(scheduleRender);
  resizeObserver.observe(canvas);
  document.fonts?.ready.then(() => {
    particleField = null;
    scheduleRender();
  });
  observer.observe(root);

  window.addEventListener("beforeunload", () => {
    window.removeEventListener("scroll", scheduleRender);
    window.removeEventListener("resize", scheduleRender);
    resizeObserver.disconnect();
    observer.disconnect();
    budouxFadeRuntime.disconnect();
    restoreScheme();
    if (rafRef !== null) window.cancelAnimationFrame(rafRef);
  });
})();
