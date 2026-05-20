<?php
/**
 * Fallback menu when no menu assigned.
 *
 * @package Theme
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Echo minimal UL links when Primary menu empty.
 *
 * @param array<string, mixed> $_args Fallback menu arguments.
 */
function theme_fallback_menu( $_args = array() ): void {
	unset( $_args );

	$news_url = esc_url( get_post_type_archive_link( 'news' ) );

	echo '<ul class="primary_nav_list">';
	echo '<li class="primary_nav_item"><a class="primary_nav_link" href="' . esc_url( home_url( '/' ) ) . '">' . esc_html__( 'ホーム', THEME_GETTEXT_DOMAIN ) . '</a></li>';
	echo '<li class="primary_nav_item"><a class="primary_nav_link" href="' . esc_url( $news_url ) . '">' . esc_html__( 'お知らせ', THEME_GETTEXT_DOMAIN ) . '</a></li>';
	echo '</ul>';
}
