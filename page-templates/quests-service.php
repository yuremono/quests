<?php
/**
 * Template Name: Quests Service
 * Template Post Type: page
 *
 * @package Theme
 */

declare( strict_types=1 );

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
get_template_part( 'template-parts/site-header' );
get_template_part( 'template-parts/service-page-content' );
get_template_part( 'template-parts/site-footer' );
get_footer();
