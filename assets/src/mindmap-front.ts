/**
 * Front-page mind map + mind wobble (bundled for WordPress).
 */
import { initMindMapRuntime } from "./mindMapRuntime";

(function () {
	const boot = () => {
		const root = document.querySelector("[data-portfolio-page]");
		if (root instanceof HTMLElement) {
			initMindMapRuntime(root);
		}
	};

	if (document.readyState === "loading") {
		document.addEventListener("DOMContentLoaded", boot);
	} else {
		boot();
	}
})();
