<?php
/**
 * フロント固定ページに ACF 互換の post_meta（値 + フィールドキー参照）を一括書き込みする補助スクリプト。
 * portfolio-corporate テーマのローカルフィールドとキーを整合させています。
 *
 * 実行例（Mac・Local 付属の PHP 可。リポジトリルートからの相対パス例）:
 *   php wp/themes/portfolio-corporate/tools/set-front-demo-meta.php
 *   WP_LOAD_PATH="$HOME/Local Sites/my-site/app/public/wp-load.php" php wp/themes/portfolio-corporate/tools/set-front-demo-meta.php
 *   php wp/themes/portfolio-corporate/tools/set-front-demo-meta.php --post-id=12
 *
 * wp-load の解決順:
 *   環境変数 WP_LOAD_PATH → 同ディレクトリの local-wp-load.path（1行目）→ 既定の Local パス（プロジェクト名は環境に合わせて書き換えてください）。
 *
 * Cursor のエージェントは PATH に php が無いことが多いので、
 * wp/themes/portfolio-corporate/tools/run-set-front-demo-meta.sh（Local 同梱 PHP を自動検出）の利用を推奨。
 */
declare(strict_types=1);

/**
 * @param non-empty-string $raw
 */
function portfolio_corporate_expand_wp_load_path( string $raw ): string {
	$p = trim( $raw );
	if ( $p === '' ) {
		return '';
	}
	if ( $p[0] === '~' ) {
		$home = getenv( 'HOME' );
		if ( is_string( $home ) && $home !== '' ) {
			return $home . substr( $p, 1 );
		}
	}
	return $p;
}

$config_file  = __DIR__ . '/local-wp-load.path';
$file_wp_load = '';
if ( is_readable( $config_file ) ) {
	$raw = (string) file_get_contents( $config_file );
	foreach ( preg_split( "/\r\n|\n|\r/", $raw ) as $line ) {
		$line = trim( $line );
		if ( $line === '' || str_starts_with( $line, '#' ) ) {
			continue;
		}
		$file_wp_load = portfolio_corporate_expand_wp_load_path( $line );
		break;
	}
}

$home_env        = getenv( 'HOME' );
$default_wp_load = ( is_string( $home_env ) && $home_env !== '' )
	? $home_env . '/Local Sites/local-site/app/public/wp-load.php'
	: '';
$env_wp          = getenv( 'WP_LOAD_PATH' );
$wp_load         = ( is_string( $env_wp ) && $env_wp !== '' ) ? $env_wp : ( $file_wp_load !== '' ? $file_wp_load : $default_wp_load );

$cli_post_id = null;
foreach ( array_slice( $argv, 1 ) as $arg ) {
	if ( preg_match( '/^--post-id=(\d+)$/', $arg, $m ) ) {
		$cli_post_id = (int) $m[1];
		break;
	}
}

if ( $wp_load === '' || ! is_readable( $wp_load ) ) {
	fwrite( STDERR, "wp-load.php が見つかりません: {$wp_load}\n" );
	fwrite( STDERR, "環境変数 WP_LOAD_PATH で Local の wp-load.php のフルパスを指定するか、このスクリプトと同じディレクトリの local-wp-load.path に記載してください。\n" );
	exit( 1 );
}
require $wp_load;

/** 自動検出できないときのフォールバック（ページ一覧の ID と合わせる） */
$fallback_post_id = 6;

$post_id = $cli_post_id;
if ( $post_id === null ) {
	$show_on = get_option( 'show_on_front' );
	$home    = (int) get_option( 'page_on_front' );
	if ( $show_on === 'page' && $home > 0 && get_post_status( $home ) !== false ) {
		$post_id = $home;
		fwrite( STDERR, "ヒント: 表示設定のホーム固定ページ ID {$post_id} を使用します。\n" );
	} else {
		$post_id = $fallback_post_id;
		fwrite( STDERR, "ヒント: ホーム未設定のためフォールバック ID {$post_id} を使います。違うなら --post-id= か表示設定を直してください。\n" );
	}
}

if ( get_post_status( $post_id ) === false ) {
	fwrite( STDERR, "post_id {$post_id} が存在しません。--post-id= または set-front-demo-meta.php 内の \$fallback_post_id を編集してください。\n" );
	exit( 1 );
}

$pairs = array(
	array(
		'meta'  => 'tagline',
		'ref'   => 'field_pc_tagline',
		'value' => '設計提案│箕面・大阪北部│用途別ワークショップ同行',
	),
	array(
		'meta'  => 'hero_kicker',
		'ref'   => 'field_pc_hero_kicker',
		'value' => '箕面・大阪北部｜社寺・集合・福祉の建築設計',
	),
	array(
		'meta'  => 'hero_title',
		'ref'   => 'field_pc_hero_title',
		'value' => '坂ノ上設計｜社寺・集合・福祉で「場」を編む',
	),
	array(
		'meta'  => 'hero_lead',
		'ref'   => 'field_pc_hero_lead',
		'value' => "箕面から大阪北部へ、プロセスデザインと構法設計を両輪に据えます。\n現調から監理まで伴走し、制度・構造・運用まで一枚岩でご提案します。",
	),
	array(
		'meta'  => 'services_heading',
		'ref'   => 'field_pc_services_heading',
		'value' => '領域別サービス',
	),
	array(
		'meta'  => 'service_1_title',
		'ref'   => 'field_pc_svc1_title',
		'value' => '社寺・伝統的木造',
	),
	array(
		'meta'  => 'service_1_body',
		'ref'   => 'field_pc_svc1_body',
		'value' => "本尊・札所動線・地域行事まで見据えた平面組み替え。\n耐震・メンテ計画までワンストップでご提案します。",
	),
	array(
		'meta'  => 'service_2_title',
		'ref'   => 'field_pc_svc2_title',
		'value' => '集合・福祉・中小プロジェクト',
	),
	array(
		'meta'  => 'service_2_body',
		'ref'   => 'field_pc_svc2_body',
		'value' => "長寿命仕様・運営動線・ユニバーサルデザインを前提にした計画。\n行政調整やJV連携にも対応します。",
	),
	array(
		'meta'  => 'service_3_title',
		'ref'   => 'field_pc_svc3_title',
		'value' => 'リノベ・構造調査',
	),
	array(
		'meta'  => 'service_3_body',
		'ref'   => 'field_pc_svc3_body',
		'value' => "耐震診断から狭小地の増築まで局所的な構法見直し。\n竣工後の保全サイクル設計まで支援します。",
	),
	array(
		'meta'  => 'highlight_show',
		'ref'   => 'field_pc_highlight_show',
		'value' => '1',
	),
	array(
		'meta'  => 'highlight_heading',
		'ref'   => 'field_pc_highlight_heading',
		'value' => '設計へのスタンス',
	),
	array(
		'meta'  => 'highlight_body',
		'ref'   => 'field_pc_highlight_body',
		'value' => "用途と現場条件を踏まえ、法規・構造・運用のバランスを見通してから図面化します。\nワークショップや合意形成の場にも同席し、一段深い提案ができるよう伴走します。",
	),
	array(
		'meta'  => 'footer_contact_show',
		'ref'   => 'field_pc_footer_show',
		'value' => '1',
	),
	array(
		'meta'  => 'footer_contact_heading',
		'ref'   => 'field_pc_footer_heading',
		'value' => 'お問い合わせ・所在地',
	),
	array(
		'meta'  => 'footer_contact_body',
		'ref'   => 'field_pc_footer_body',
		'value' => "〒562-0001 大阪府箕面市小野原東 4-12-1 坂ノ上ビル 3F\n平日 9:30–18:30｜見学会・オンライン相談は事前予約制です",
	),
	array(
		'meta'  => 'footer_phone',
		'ref'   => 'field_pc_footer_phone',
		'value' => '072-736-2840',
	),
	array(
		'meta'  => 'footer_email',
		'ref'   => 'field_pc_footer_email',
		'value' => 'info@sakanoue-sekkei.example',
	),
);

foreach ( $pairs as $row ) {
	update_post_meta( $post_id, $row['meta'], $row['value'] );
	update_post_meta( $post_id, '_' . $row['meta'], $row['ref'] );
}

echo "OK: post_id {$post_id} にフロントページ用フィールドを書き込みました。ページを再読み込みしてください。\n";
