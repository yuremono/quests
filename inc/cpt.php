<?php
/**
 * CPT registration.
 *
 * @package Theme
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * CPT: news（お知らせ）。
 */
function theme_register_news(): void {
	register_post_type(
		'news',
		array(
			'labels'        => array(
				'name'               => __( 'お知らせ', THEME_GETTEXT_DOMAIN ),
				'singular_name'      => __( 'お知らせ', THEME_GETTEXT_DOMAIN ),
				'add_new_item'       => __( 'お知らせを追加', THEME_GETTEXT_DOMAIN ),
				'edit_item'          => __( 'お知らせを編集', THEME_GETTEXT_DOMAIN ),
				'view_item'          => __( 'お知らせを表示', THEME_GETTEXT_DOMAIN ),
				'search_items'       => __( 'お知らせを検索', THEME_GETTEXT_DOMAIN ),
				'not_found'          => __( 'お知らせは見つかりませんでした', THEME_GETTEXT_DOMAIN ),
				'not_found_in_trash' => __( 'ゴミ箱にお知らせはありません', THEME_GETTEXT_DOMAIN ),
				'all_items'          => __( 'お知らせ一覧', THEME_GETTEXT_DOMAIN ),
			),
			'public'        => true,
			'show_in_rest'  => true,
			'has_archive'   => true,
			'rewrite'       => array( 'slug' => 'news' ),
			'menu_position' => 6,
			'menu_icon'     => 'dashicons-megaphone',
			'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
		)
	);
}
add_action( 'init', 'theme_register_news' );

/**
 * CPT: work（Other Works チップ）。
 */
function theme_register_work(): void {
	register_post_type(
		'work',
		array(
			'labels'        => array(
				'name'               => __( 'Works', THEME_GETTEXT_DOMAIN ),
				'singular_name'      => __( 'Work', THEME_GETTEXT_DOMAIN ),
				'add_new_item'       => __( 'Work を追加', THEME_GETTEXT_DOMAIN ),
				'edit_item'          => __( 'Work を編集', THEME_GETTEXT_DOMAIN ),
				'view_item'          => __( 'Work を表示', THEME_GETTEXT_DOMAIN ),
				'search_items'       => __( 'Work を検索', THEME_GETTEXT_DOMAIN ),
				'not_found'          => __( 'Work は見つかりませんでした', THEME_GETTEXT_DOMAIN ),
				'not_found_in_trash' => __( 'ゴミ箱に Work はありません', THEME_GETTEXT_DOMAIN ),
				'all_items'          => __( 'Works 一覧', THEME_GETTEXT_DOMAIN ),
			),
			'public'        => false,
			'show_ui'       => true,
			'show_in_rest'  => true,
			'has_archive'   => false,
			'menu_position' => 7,
			'menu_icon'     => 'dashicons-portfolio',
			'supports'      => array( 'title', 'editor', 'page-attributes' ),
		)
	);
}
add_action( 'init', 'theme_register_work' );

/**
 * Work CPT の ACF フィールド。
 */
function theme_register_work_acf(): void {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	$td = THEME_GETTEXT_DOMAIN;

	acf_add_local_field_group(
		array(
			'key'      => 'group_pc_work',
			'title'    => __( 'Work 設定', $td ),
			'fields'   => array(
				array(
					'key'          => 'field_pc_work_url',
					'label'        => __( 'リンク URL', $td ),
					'name'         => 'work_url',
					'type'         => 'url',
					'instructions' => __( '外部 URL。内部パスは「リンクパス」を使用。', $td ),
				),
				array(
					'key'          => 'field_pc_work_path',
					'label'        => __( 'リンクパス', $td ),
					'name'         => 'work_path',
					'type'         => 'text',
					'instructions' => __( '例: /rects（サイト内相対パス）', $td ),
				),
				array(
					'key'           => 'field_pc_work_is_initial',
					'label'         => __( '見出しチップ（リンクなし）', $td ),
					'name'          => 'work_is_initial',
					'type'          => 'true_false',
					'default_value' => 0,
					'ui'            => 1,
				),
				array(
					'key'   => 'field_pc_work_css_class',
					'label' => __( '追加 CSS クラス', $td ),
					'name'  => 'work_css_class',
					'type'  => 'text',
				),
				array(
					'key'          => 'field_pc_work_popup',
					'label'        => __( 'ポップアップ本文', $td ),
					'name'         => 'work_popup',
					'type'         => 'wysiwyg',
					'tabs'         => 'all',
					'toolbar'      => 'basic',
					'media_upload' => 0,
				),
			),
			'location' => array(
				array(
					array(
						'param'    => 'post_type',
						'operator' => '==',
						'value'    => 'work',
					),
				),
			),
		)
	);
}
add_action( 'acf/init', 'theme_register_work_acf' );

/**
 * Work meta value.
 *
 * ACF が無効な環境でも投稿メタから取得して fatal を避ける。
 *
 * @param string $field_name Field name.
 * @param int    $post_id    Post ID.
 * @return mixed
 */
function theme_get_work_meta_value( string $field_name, int $post_id ): mixed {
	if ( function_exists( 'get_field' ) ) {
		return get_field( $field_name, $post_id );
	}

	return get_post_meta( $post_id, $field_name, true );
}

/**
 * Work 投稿を RepulsionLists 用配列に変換。
 *
 * @return array<int, array<string, mixed>>
 */
function theme_work_repulsion_items(): array {
	$posts = get_posts(
		array(
			'post_type'      => 'work',
			'posts_per_page' => 50,
			'orderby'        => 'menu_order',
			'order'          => 'ASC',
			'post_status'    => 'publish',
		)
	);

	if ( empty( $posts ) ) {
		return theme_work_repulsion_fallback_items();
	}

	$items = array();
	foreach ( $posts as $post ) {
		$pid        = (int) $post->ID;
		$is_initial = (bool) theme_get_work_meta_value( 'work_is_initial', $pid );
		$work_url   = (string) theme_get_work_meta_value( 'work_url', $pid );
		$work_path  = (string) theme_get_work_meta_value( 'work_path', $pid );
		$css_class  = (string) theme_get_work_meta_value( 'work_css_class', $pid );
		$popup      = (string) theme_get_work_meta_value( 'work_popup', $pid );

		$item = array(
			'title'   => get_the_title( $post ),
			'class'   => $css_class,
			'content' => $popup,
		);

		if ( $is_initial ) {
			$item['is_initial'] = true;
			$item['to']         = '';
			$item['href']       = '';
		} elseif ( '' !== $work_url ) {
			$item['href'] = $work_url;
		} elseif ( '' !== $work_path ) {
			$item['to'] = $work_path;
		}

		$items[] = $item;
	}

	return $items;
}

/**
 * Work CPT 未登録時のフォールバック（旧静的データ）。
 *
 * @return array<int, array<string, mixed>>
 */
function theme_work_repulsion_fallback_items(): array {
	if ( function_exists( 'theme_legacy_repulsion_items' ) ) {
		return theme_legacy_repulsion_items();
	}
	return array();
}
