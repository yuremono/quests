/** @type {import('tailwindcss').Config} */
const plugin = require("tailwindcss/plugin");

const fontSizeWithoutLineHeight = {
	xs: "0.75rem",
	sm: "0.875rem",
	base: "1rem",
	lg: "1.125rem",
	xl: "1.25rem",
	"2xl": "1.5rem",
	"3xl": "1.875rem",
	"4xl": "2.25rem",
	"5xl": "3rem",
	"6xl": "3.75rem",
	"7xl": "4.5rem",
	"8xl": "6rem",
	"9xl": "8rem",
};

const cssVarColor = (name) =>
	`color-mix(in srgb, transparent, var(--${name}) calc(<alpha-value> * 100%))`;

module.exports = {
	content: [
		"./*.php",
		"./**/*.php",
		"./assets/**/*.{scss,css,js}",
		"!./node_modules/**",
	],
	theme: {
		fontSize: fontSizeWithoutLineHeight,
		extend: {
			screens: {
				xs: "479px",
			},
			colors: {
				MC: cssVarColor("MC"),
				SC: cssVarColor("SC"),
				AC: cssVarColor("AC"),
				BC: cssVarColor("BC"),
				TC: cssVarColor("TC"),
				WH: cssVarColor("WH"),
				BK: cssVarColor("BK"),
				GR: cssVarColor("GR"),
				primary: cssVarColor("primary"),
				secondary: cssVarColor("secondary"),
				accent: cssVarColor("accent"),
				foreground: cssVarColor("foreground"),
				muted: cssVarColor("muted"),
				background: cssVarColor("background"),
				border: cssVarColor("border"),
				third: cssVarColor("third"),
				fourth: cssVarColor("fourth"),
				stage: cssVarColor("stage"),
				rail: cssVarColor("rail"),
			},
		},
	},
	plugins: [
		plugin(function ({ matchUtilities }) {
			matchUtilities(
				{
					"text-shadow": (value) => ({
						"text-shadow": value,
					}),
				},
				{ type: ["any"] },
			);
			matchUtilities(
				{
					"drop-shadow": (value) => ({
						filter: `drop-shadow(${value})`,
					}),
				},
				{ type: ["any"] },
			);
			matchUtilities(
				{
					"box-shadow": (value) => ({
						"box-shadow": value,
					}),
				},
				{ type: ["any"] },
			);
			matchUtilities(
				{
					"text-stroke": (value) => ({
						"-webkit-text-stroke": value,
					}),
				},
				{ type: ["any"] },
			);
		}),
	],
};
