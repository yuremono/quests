<?php
/**
 * Phosphor Icons（regular）をインライン SVG で出力する。
 *
 * 移植元 @phosphor-icons/react の regular ウェイトと同じ path を使用する。
 *
 * @package Theme
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * 利用可能なアイコン名と path（regular）。
 *
 * @return array<string, string>
 */
function theme_phosphor_icon_paths(): array {
	return array(
		'caret-down'       => 'M213.66,101.66l-80,80a8,8,0,0,1-11.32,0l-80-80A8,8,0,0,1,53.66,90.34L128,164.69l74.34-74.35a8,8,0,0,1,11.32,11.32Z',
		'caret-right'      => 'M94.34,197.66a8,8,0,0,1,0-11.32L152.69,128,94.34,69.66A8,8,0,0,1,105.66,58.34l64,64a8,8,0,0,1,0,11.32l-64,64A8,8,0,0,1,94.34,197.66Z',
		'caret-up'         => 'M213.66,165.66a8,8,0,0,1-11.32,0L128,91.31,53.66,165.66a8,8,0,0,1-11.32-11.32l80-80a8,8,0,0,1,11.32,0l80,80A8,8,0,0,1,213.66,165.66Z',
		'list-plus'        => 'M32,64a8,8,0,0,1,8-8H216a8,8,0,0,1,0,16H40A8,8,0,0,1,32,64Zm8,72H216a8,8,0,0,0,0-16H40a8,8,0,0,0,0,16Zm104,48H40a8,8,0,0,0,0,16H144a8,8,0,0,0,0-16Zm88,0H216V168a8,8,0,0,0-16,0v16H184a8,8,0,0,0,0,16h16v16a8,8,0,0,0,16,0V200h16a8,8,0,0,0,0-16Z',
		'arrow-square-out' => 'M224,104a8,8,0,0,1-16,0V59.32l-66.33,66.34a8,8,0,0,1-11.32-11.32L196.68,48H152a8,8,0,0,1,0-16h64a8,8,0,0,1,8,8Zm-40,24a8,8,0,0,0-8,8v72H48V80h72a8,8,0,0,0,0-16H48A16,16,0,0,0,32,80V208a16,16,0,0,0,16,16H176a16,16,0,0,0,16-16V136A8,8,0,0,0,184,128Z',
		'x'                => 'M205.66,194.34a8,8,0,0,1-11.32,11.32L128,139.31,61.66,205.66a8,8,0,0,1-11.32-11.32L116.69,128,50.34,61.66A8,8,0,0,1,61.66,50.34L128,116.69l66.34-66.35a8,8,0,0,1,11.32,11.32L139.31,128Z',
		'moon'             => 'M233.54,142.23a8,8,0,0,0-8-2,88.08,88.08,0,0,1-109.8-109.8,8,8,0,0,0-10-10,104.84,104.84,0,0,0-52.91,37A104,104,0,0,0,136,224a103.09,103.09,0,0,0,62.52-20.88,104.84,104.84,0,0,0,37-52.91A8,8,0,0,0,233.54,142.23ZM188.9,190.34A88,88,0,0,1,65.66,67.11a89,89,0,0,1,31.4-26A106,106,0,0,0,96,56,104.11,104.11,0,0,0,200,160a106,106,0,0,0,14.92-1.06A89,89,0,0,1,188.9,190.34Z',
		'sun'              => 'M120,40V16a8,8,0,0,1,16,0V40a8,8,0,0,1-16,0Zm72,88a64,64,0,1,1-64-64A64.07,64.07,0,0,1,192,128Zm-16,0a48,48,0,1,0-48,48A48.05,48.05,0,0,0,176,128ZM58.34,69.66A8,8,0,0,0,69.66,58.34l-16-16A8,8,0,0,0,42.34,53.66Zm0,116.68-16,16a8,8,0,0,0,11.32,11.32l16-16a8,8,0,0,0-11.32-11.32ZM192,72a8,8,0,0,0,5.66-2.34l16-16a8,8,0,0,0-11.32-11.32l-16,16A8,8,0,0,0,192,72Zm5.66,114.34a8,8,0,0,0-11.32,11.32l16,16a8,8,0,0,0,11.32-11.32ZM48,128a8,8,0,0,0-8-8H16a8,8,0,0,0,0,16H40A8,8,0,0,0,48,128Zm80,80a8,8,0,0,0-8,8v24a8,8,0,0,0,16,0V216A8,8,0,0,0,128,208Zm112-88H216a8,8,0,0,0,0,16h24a8,8,0,0,0,0-16Z',
	);
}

/**
 * Phosphor アイコンをインライン SVG で返す。
 *
 * @param string               $name Icon name.
 * @param array<string, mixed> $args {
 *     Optional icon arguments.
 *
 *     @type string|null $class       Additional class.
 *     @type int|null    $size        Pixel width and height. Defaults to 1em.
 *     @type bool        $aria_hidden Defaults to true.
 * }
 * @return string 空文字列（未知の名前）または SVG マークアップ。
 */
function theme_phosphor_icon( string $name, array $args = array() ): string {
	$paths = theme_phosphor_icon_paths();
	if ( ! isset( $paths[ $name ] ) ) {
		return '';
	}

	$class       = isset( $args['class'] ) ? (string) $args['class'] : '';
	$size        = isset( $args['size'] ) ? (int) $args['size'] : null;
	$aria_hidden = array_key_exists( 'aria_hidden', $args ) ? (bool) $args['aria_hidden'] : true;

	$classes   = trim( 'phosphor_icon ' . $class );
	$size_attr = null !== $size && $size > 0
		? sprintf( ' width="%d" height="%d"', $size, $size )
		: ' width="1em" height="1em"';

	$aria = $aria_hidden ? ' aria-hidden="true"' : '';

	return sprintf(
		'<svg xmlns="http://www.w3.org/2000/svg"%s fill="currentColor" viewBox="0 0 256 256" class="%s"%s><path d="%s"/></svg>',
		$size_attr,
		esc_attr( $classes ),
		$aria,
		esc_attr( $paths[ $name ] )
	);
}
