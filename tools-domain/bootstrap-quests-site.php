<?php
/**
 * Bootstrap a WordPress install for the Quests theme.
 *
 * Usage:
 *   WP_LOAD_PATH="/path/to/wp-load.php" php tools-domain/bootstrap-quests-site.php
 *   php tools-domain/bootstrap-quests-site.php
 *
 * @package Theme
 */

declare(strict_types=1);

/**
 * Expand a path that may start with "~".
 */
function quests_tools_expand_path( string $path ): string {
	$path = trim( $path );
	if ( '' === $path ) {
		return '';
	}

	if ( str_starts_with( $path, '~' ) ) {
		$home = getenv( 'HOME' );
		if ( is_string( $home ) && '' !== $home ) {
			return $home . substr( $path, 1 );
		}
	}

	return $path;
}

/**
 * Resolve wp-load.php from environment or local config.
 */
function quests_tools_resolve_wp_load(): string {
	$env = getenv( 'WP_LOAD_PATH' );
	if ( is_string( $env ) && '' !== $env ) {
		return quests_tools_expand_path( $env );
	}

	$config_file = dirname( __DIR__ ) . '/tools/local-wp-load.path';
	if ( ! is_readable( $config_file ) ) {
		return '';
	}

	$raw = (string) file_get_contents( $config_file );
	foreach ( preg_split( "/\r\n|\n|\r/", $raw ) as $line ) {
		$line = trim( $line );
		if ( '' === $line || str_starts_with( $line, '#' ) ) {
			continue;
		}

		return quests_tools_expand_path( $line );
	}

	return '';
}

if ( ! defined( 'ABSPATH' ) ) {
	$wp_load = quests_tools_resolve_wp_load();
	if ( '' === $wp_load || ! is_readable( $wp_load ) ) {
		fwrite( STDERR, "wp-load.php が見つかりません。WP_LOAD_PATH または tools/local-wp-load.path を確認してください。\n" );
		exit( 1 );
	}

require $wp_load;
}

require_once ABSPATH . 'wp-admin/includes/plugin.php';

wp_set_current_user( 1 );

if ( function_exists( 'switch_theme' ) ) {
	switch_theme( 'quests' );
}

if ( file_exists( WP_PLUGIN_DIR . '/advanced-custom-fields/acf.php' ) && ! is_plugin_active( 'advanced-custom-fields/acf.php' ) ) {
	activate_plugin( 'advanced-custom-fields/acf.php' );
}

/**
 * Upsert a page and set its template.
 */
function quests_tools_upsert_page( string $slug, string $title, string $template ): int {
	$page = get_page_by_path( $slug, OBJECT, 'page' );

	if ( $page instanceof WP_Post ) {
		$page_id = wp_update_post(
			wp_slash(
				array(
					'ID'          => $page->ID,
					'post_status' => 'publish',
					'post_title'  => $title,
					'post_name'   => $slug,
				)
			),
			true
		);
	} else {
		$page_id = wp_insert_post(
			wp_slash(
				array(
					'post_type'   => 'page',
					'post_status' => 'publish',
					'post_title'  => $title,
					'post_name'   => $slug,
				)
			),
			true
		);
	}

	if ( is_wp_error( $page_id ) || ! $page_id ) {
		fwrite( STDERR, "固定ページを作成できませんでした: {$title}\n" );
		exit( 1 );
	}

	update_post_meta( (int) $page_id, '_wp_page_template', $template );

	return (int) $page_id;
}

/**
 * Replace Quests Navigation with the expected default items and assign it.
 */
function quests_tools_sync_primary_menu( int $service_id ): int {
	$menu_name = 'Quests Navigation';
	$menu      = wp_get_nav_menu_object( $menu_name );
	$menu_id   = $menu instanceof WP_Term ? (int) $menu->term_id : (int) wp_create_nav_menu( $menu_name );

	if ( ! $menu_id ) {
		fwrite( STDERR, "メニューを作成できませんでした: {$menu_name}\n" );
		exit( 1 );
	}

	foreach ( (array) wp_get_nav_menu_items( $menu_id ) as $item ) {
		if ( $item instanceof WP_Post ) {
			wp_delete_post( (int) $item->ID, true );
		}
	}

	$items = array(
		array( 'title' => 'home', 'url' => home_url( '/' ) ),
		array( 'title' => 'Service', 'page_id' => $service_id ),
		array( 'title' => 'Staff', 'url' => '#' ),
		array( 'title' => 'Recruit', 'url' => '#' ),
		array( 'title' => 'Instagram', 'url' => '#' ),
		array( 'title' => 'Contact', 'url' => '#' ),
	);

	foreach ( $items as $item ) {
		if ( isset( $item['page_id'] ) ) {
			wp_update_nav_menu_item(
				$menu_id,
				0,
				array(
					'menu-item-title'     => $item['title'],
					'menu-item-object-id' => (int) $item['page_id'],
					'menu-item-object'    => 'page',
					'menu-item-type'      => 'post_type',
					'menu-item-status'    => 'publish',
				)
			);
			continue;
		}

		wp_update_nav_menu_item(
			$menu_id,
			0,
			array(
				'menu-item-title'  => $item['title'],
				'menu-item-url'    => $item['url'],
				'menu-item-type'   => 'custom',
				'menu-item-status' => 'publish',
			)
		);
	}

	$locations              = get_nav_menu_locations();
	$locations['primary']  = $menu_id;
	set_theme_mod( 'nav_menu_locations', $locations );

	return $menu_id;
}

$front_id   = quests_tools_upsert_page( 'front', 'Front', 'page-templates/quests-top.php' );
$service_id = quests_tools_upsert_page( 'service', 'Service', 'page-templates/quests-service.php' );

update_option( 'show_on_front', 'page' );
update_option( 'page_on_front', $front_id );

$menu_id = quests_tools_sync_primary_menu( $service_id );

flush_rewrite_rules( false );

echo "OK: Quests site bootstrapped.\n";
echo "front_id={$front_id}\n";
echo "service_id={$service_id}\n";
echo "menu_id={$menu_id}\n";
echo 'acf=' . ( function_exists( 'acf_add_local_field_group' ) ? 'yes' : 'no' ) . "\n";
