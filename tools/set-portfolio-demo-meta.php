<?php
/**
 * ポートフォリオ TOP 用 ACF 初期値を書き込む。
 *
 * 実行例:
 *   WP_LOAD_PATH="/path/to/wp-load.php" php tools/set-portfolio-demo-meta.php
 *   php tools/set-portfolio-demo-meta.php --post-id=6
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

$cli_post_id = null;
foreach ( array_slice( $argv, 1 ) as $arg ) {
	if ( preg_match( '/^--post-id=(\d+)$/', $arg, $m ) ) {
		$cli_post_id = (int) $m[1];
		break;
	}
}

if ( $wp_load === '' || ! is_readable( $wp_load ) ) {
	fwrite( STDERR, "wp-load.php が見つかりません。WP_LOAD_PATH を指定してください。\n" );
	exit( 1 );
}

require $wp_load;

require_once get_template_directory() . '/inc/portfolio-defaults.php';
require_once get_template_directory() . '/inc/demo-content.php';

$post_id = $cli_post_id;
if ( null === $post_id ) {
	$show_on = get_option( 'show_on_front' );
	$home    = (int) get_option( 'page_on_front' );
	if ( 'page' === $show_on && $home > 0 && false !== get_post_status( $home ) ) {
		$post_id = $home;
	} else {
		fwrite( STDERR, "ホーム固定ページが未設定です。--post-id= を指定してください。\n" );
		exit( 1 );
	}
}

if ( false === get_post_status( $post_id ) ) {
	fwrite( STDERR, "post_id {$post_id} が存在しません。\n" );
	exit( 1 );
}

foreach ( theme_portfolio_default_meta_rows() as $row ) {
	update_post_meta( $post_id, $row['meta'], $row['value'] );
	update_post_meta( $post_id, '_' . $row['meta'], $row['ref'] );
}

echo "OK: post_id {$post_id} にポートフォリオ TOP 用フィールドを書き込みました。\n";
