<?php
/**
 * Front page repulsion jitter helpers.
 *
 * @package Theme
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Deterministic jitter for repulsion chips (RepulsionLists/utils.ts).
 *
 * @param int $seed Base seed.
 * @param int $salt Salt value.
 * @return float
 */
function theme_repulsion_deterministic_noise( int $seed, int $salt = 0 ): float {
	$value = sin( $seed * 12.9898 + $salt * 78.233 ) * 43758.5453;
	return $value - floor( $value );
}

/**
 * Jitter offsets for a repulsion list chip index.
 *
 * @param int $index Chip index.
 * @return array{x: float, y: float}
 */
function theme_repulsion_chip_jitter( int $index ): array {
	$x = theme_repulsion_deterministic_noise( $index, 1 );
	$y = theme_repulsion_deterministic_noise( $index, 2 );
	return array(
		'x' => ( $x - 0.5 ) * -10,
		'y' => ( $y - 0.5 ) * -10,
	);
}

/**
 * Repulsion list items for front page.
 *
 * @return array<int, array<string, mixed>>
 */
function theme_front_page_repulsion_items(): array {
	return theme_work_repulsion_items();
}
