<?php
/**
 * CPT work に RepulsionLists 初期データを投入する。
 *
 * 実行例:
 *   WP_LOAD_PATH="/path/to/wp-load.php" php tools/seed-works.php
 *
 * @package Theme
 */

declare(strict_types=1);

$config_file  = __DIR__ . '/local-wp-load.path';
$file_wp_load = '';
if ( is_readable( $config_file ) ) {
	$raw = (string) file_get_contents( $config_file );
	foreach ( preg_split( "/\r\n|\n|\r/", $raw ) as $line ) {
		$line = trim( $line );
		if ( $line === '' || str_starts_with( $line, '#' ) ) {
			continue;
		}
		$file_wp_load = str_starts_with( $line, '~' ) ? ( getenv( 'HOME' ) ?: '' ) . substr( $line, 1 ) : $line;
		break;
	}
}

$env_wp  = getenv( 'WP_LOAD_PATH' );
$wp_load = ( is_string( $env_wp ) && $env_wp !== '' ) ? $env_wp : $file_wp_load;

if ( $wp_load === '' || ! is_readable( $wp_load ) ) {
	fwrite( STDERR, "wp-load.php が見つかりません。WP_LOAD_PATH を指定してください。\n" );
	exit( 1 );
}

require $wp_load;

require_once get_template_directory() . '/inc/portfolio-defaults.php';

$items = theme_legacy_repulsion_items();
$order = 0;

foreach ( $items as $item ) {
	$title = (string) ( $item['title'] ?? '' );
	if ( $title === '' ) {
		continue;
	}

	$existing = get_page_by_title( $title, OBJECT, 'work' );

	if ( $existing instanceof WP_Post ) {
		$post_id = wp_update_post(
			array(
				'ID'         => $existing->ID,
				'menu_order' => $order,
			),
			true
		);
	} else {
		$post_id = wp_insert_post(
			array(
				'post_type'   => 'work',
				'post_title'  => $title,
				'post_status' => 'publish',
				'menu_order'  => $order,
			),
			true
		);
	}

	if ( is_wp_error( $post_id ) ) {
		fwrite( STDERR, "ERROR: {$title} - " . $post_id->get_error_message() . "\n" );
		++$order;
		continue;
	}

	$post_id = (int) $post_id;

	$is_initial = ! empty( $item['is_initial'] );
	update_post_meta( $post_id, 'work_is_initial', $is_initial ? '1' : '0' );
	update_post_meta( $post_id, '_work_is_initial', 'field_pc_work_is_initial' );

	update_post_meta( $post_id, 'work_url', (string) ( $item['href'] ?? '' ) );
	update_post_meta( $post_id, '_work_url', 'field_pc_work_url' );
	update_post_meta( $post_id, 'work_path', (string) ( $item['to'] ?? '' ) );
	update_post_meta( $post_id, '_work_path', 'field_pc_work_path' );
	update_post_meta( $post_id, 'work_css_class', (string) ( $item['class'] ?? '' ) );
	update_post_meta( $post_id, '_work_css_class', 'field_pc_work_css_class' );
	update_post_meta( $post_id, 'work_popup', (string) ( $item['content'] ?? '' ) );
	update_post_meta( $post_id, '_work_popup', 'field_pc_work_popup' );

	$status = $existing instanceof WP_Post ? 'UPDATE' : 'OK';
	echo "{$status}: {$title} (ID {$post_id})\n";
	++$order;
}

echo "Works シード完了。\n";
