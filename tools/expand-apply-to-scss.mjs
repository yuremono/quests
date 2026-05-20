/**
 * Expand @apply in SCSS files to plain CSS (theme Tailwind config, no full utilities dump).
 * Skips lines that are // comments. Usage:
 *   node tools/expand-apply-to-scss.mjs assets/scss/_10UNIT.scss
 */
import fs from "fs";
import path from "path";
import postcss from "postcss";
import tailwindcss from "tailwindcss";
import { createRequire } from "module";
import { fileURLToPath } from "url";

const require = createRequire(import.meta.url);
const root = path.join(path.dirname(fileURLToPath(import.meta.url)), "..");
const baseConfig = require(path.join(root, "tailwind.config.cjs"));
const tailwindConfig = { ...baseConfig, content: [] };

const cache = new Map();
const SELECTOR = ".___apply_ref___";
const lineApplyRe = /^(\s*)@apply\s+([^;]+);\s*$/;

async function expandApply(utilities, indent) {
	const key = `${utilities.trim()}::${indent}`;
	if (cache.has(key)) return cache.get(key);

	const input = `${SELECTOR} { @apply ${utilities.trim()}; }`;
	const result = await postcss([tailwindcss(tailwindConfig)]).process(input, {
		from: undefined,
	});
	const formatted = formatProps(extractFromRef(result.css), indent);
	cache.set(key, formatted);
	return formatted;
}

function extractFromRef(css) {
	const root = postcss.parse(css);
	const props = [];
	const medias = [];

	root.walkRules((rule) => {
		if (rule.selector !== SELECTOR || rule.parent?.type === "atrule") return;
		rule.each((node) => {
			if (node.type === "decl") props.push(node.toString());
		});
	});

	root.walkAtRules("media", (atRule) => {
		const inner = [];
		atRule.each((node) => {
			if (node.type !== "rule" || node.selector !== SELECTOR) return;
			node.each((decl) => {
				if (decl.type === "decl") inner.push(decl.toString());
			});
		});
		if (inner.length) {
			medias.push({ query: atRule.params, decls: inner });
		}
	});

	return { props, medias };
}

function fixDecl(decl) {
	const s = decl.trim();
	return s.endsWith(";") ? s : `${s};`;
}

function formatProps({ props, medias }, indent) {
	const lines = props.map((p) => `${indent}${fixDecl(p)}`);
	for (const { query, decls } of medias) {
		lines.push(`${indent}@media ${query} {`);
		decls.forEach((d) => lines.push(`${indent}\t${fixDecl(d)}`));
		lines.push(`${indent}}`);
	}
	return lines.join("\n");
}

function isCommentLine(line) {
	const t = line.trim();
	return t.startsWith("//") || t.startsWith("*") || t.startsWith("/*");
}

async function convertFile(filePath) {
	const lines = fs.readFileSync(filePath, "utf8").split("\n");
	let count = 0;

	for (let i = 0; i < lines.length; i++) {
		if (isCommentLine(lines[i])) continue;
		const match = lines[i].match(lineApplyRe);
		if (!match) continue;
		const [, indent, utilities] = match;
		lines[i] = await expandApply(utilities, indent);
		count++;
	}

	fs.writeFileSync(filePath, lines.join("\n"));
	console.log(`${filePath}: converted ${count} @apply line(s)`);
}

const files = process.argv.slice(2);
if (!files.length) {
	console.error("Usage: node tools/expand-apply-to-scss.mjs <scss>...");
	process.exit(1);
}

for (const file of files) {
	await convertFile(path.resolve(file));
}
