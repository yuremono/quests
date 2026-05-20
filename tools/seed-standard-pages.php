<?php
/**
 * 固定ページ（会社概要・サービスなど）とプライマリメニューを投入する単発スクリプト。
 *
 * 推奨: WordPress のルートで実行
 * wp eval-file wp-content/themes/portfolio-corporate/tools/seed-standard-pages.php
 *
 * 代替（wp-load を通す）の例を次行に。この場合もカレントを WP のルートに置くこと。
 * php -r 'require "./wp-load.php"; require "./wp-content/themes/portfolio-corporate/tools/seed-standard-pages.php";'
 *
 * @package Theme
 */

declare(strict_types=1);

// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- CLI script output only.
defined( 'ABSPATH' ) || exit( 'Bootstrap WordPress before running this script (wp eval-file or require wp-load.php first).' );

/**
 * Runs seed when loaded from WP bootstrap.
 */
function theme_seed_standard_pages_maybe_run(): void {
	if ( ! is_blog_installed() ) {
		return;
	}

	$definitions      = theme_seed_standard_pages_definitions();
	$page_ids_by_slug = array();

	foreach ( $definitions as $slug => $def ) {
		$existing = get_page_by_path( $slug, OBJECT, 'page' );
		if ( $existing instanceof WP_Post ) {
			$page_ids_by_slug[ $slug ] = (int) $existing->ID;
			continue;
		}

		$postarr = array(
			'post_title'   => $def['title'],
			'post_name'    => $slug,
			'post_content' => $def['content'],
			'post_status'  => 'publish',
			'post_type'    => 'page',
			'post_author'  => (int) get_current_user_id() ?: 1,
		);

		$page_id = wp_insert_post( wp_slash( $postarr ), true );
		if ( $page_id instanceof WP_Error || ! $page_id ) {
			continue;
		}

		$page_ids_by_slug[ $slug ] = (int) $page_id;

		if ( ! empty( $def['template'] ) ) {
			update_post_meta( (int) $page_id, '_wp_page_template', $def['template'] );
		}
	}

	foreach ( $definitions as $slug => $def ) {
		if ( empty( $def['template'] ) ) {
			continue;
		}
		$page = get_page_by_path( $slug, OBJECT, 'page' );
		if (
			$page instanceof WP_Post
			&& empty( get_post_meta( $page->ID, '_wp_page_template', true ) )
		) {
			update_post_meta( $page->ID, '_wp_page_template', $def['template'] );
		}
	}

	theme_seed_standard_pages_wire_primary_menu( $page_ids_by_slug );
}

/**
 * Page seeds: slug => meta.
 *
 * @return array<string, array{title: string, content: string, template?: string}>
 */
function theme_seed_standard_pages_definitions(): array {
	return array(
		'company'           => array(
			'title'    => '会社概要',
			'template' => 'page-templates/page-company.php',
			'content'  => "<!-- wp:paragraph -->\n<p>ここは会社概要のプレースホルダーです。沿革、代表メッセージ、組織図などをブロック編集画面から追記してください。</p>\n<!-- /wp:paragraph -->",
		),
		'concept'           => array(
			'title'    => 'コンセプト',
			'template' => 'page-templates/page-concept.php',
			'content'  => "<!-- wp:paragraph -->\n<p>ブランドストーリーや三本柱に続く詳細説明は、このブロックから追加してください。</p>\n<!-- /wp:paragraph -->",
		),
		'philosophy'        => array(
			'title'    => '設計理念',
			'template' => 'page-templates/page-philosophy.php',
			'content'  => "<!-- wp:paragraph -->\n<p>番号ステップやタイムライン以外の補足・事例はここから編集できます。</p>\n<!-- /wp:paragraph -->",
		),
		'faq'               => array(
			'title'    => 'よくある質問',
			'template' => 'page-templates/page-faq.php',
			'content'  => "<!-- wp:paragraph -->\n<p>テンプレート上部のアコーディオン以外の Q&A やお問い合わせ誘導をブロックで追加してください。</p>\n<!-- /wp:paragraph -->",
		),
		'services'          => array(
			'title'    => 'サービス',
			'template' => 'page-templates/page-services.php',
			'content'  => "<!-- wp:paragraph -->\n<p>提供サービスの説明プレースホルダーです。業務領域、強み、料金や流れについてブロックから編集してください。</p>\n<!-- /wp:paragraph -->",
		),
		'services-overview' => array(
			'title'    => 'サービス一覧',
			'template' => 'page-templates/page-services-overview.php',
			'content'  => "<!-- wp:paragraph -->\n<p>カードグリッド以外の詳細やダウンロード資料へのリンクは、この本文から追加してください。</p>\n<!-- /wp:paragraph -->",
		),
		'contact'           => array(
			'title'    => 'お問い合わせ',
			'template' => 'page-templates/page-contact.php',
			'content'  => "<!-- wp:paragraph -->\n<p>お問い合わせページの追加のご案内をこちらから編集できます（上部のレイアウトはテーマのテンプレートで出力されます）。</p>\n<!-- /wp:paragraph -->",
		),
		'privacy-policy'    => array(
			'title'    => 'プライバシーポリシー',
			'template' => 'page-templates/page-privacy-layout.php',
			'content'  => "<!-- wp:paragraph -->\n<p>目次下部のこのエリアから、フォームや改定履歴などをブロックで追記してください。</p>\n<!-- /wp:paragraph -->",
		),
		'careers'           => array(
			'title'    => '採用情報',
			'template' => 'page-templates/page-careers.php',
			'content'  => "<!-- wp:paragraph -->\n<p>採用の募集概要・応募方法のプレースホルダーです。職種や勤務条件をブロック編集してください。</p>\n<!-- /wp:paragraph -->",
		),
	);
}

/**
 * Adds seeded pages to the primary menu assignment when safe.
 *
 * If `primary` already has a menu, appends duplicate-free items there and does not reassign that location.
 * If unassigned, creates or finds a menu named Primary and attaches it only then.
 *
 * @param array<string, int> $page_ids_by_slug Slug => post ID for known pages (may omit missing).
 */
function theme_seed_standard_pages_wire_primary_menu( array $page_ids_by_slug ): void {
	$registered = get_registered_nav_menus();
	if ( ! isset( $registered['primary'] ) ) {
		return;
	}

	$locations        = get_nav_menu_locations();
	$already_assigned = isset( $locations['primary'] ) ? (int) $locations['primary'] : 0;

	if ( $already_assigned > 0 ) {
		$menu_id = $already_assigned;
	} else {
		$menu_name = 'Primary';
		$menu      = wp_get_nav_menu_object( $menu_name );

		if ( ! $menu ) {
			$created_id = wp_create_nav_menu( $menu_name );
			if ( $created_id instanceof WP_Error || ! $created_id ) {
				return;
			}
			$menu_id = (int) $created_id;
		} else {
			$menu_id = (int) $menu->term_id;
		}
	}

	// Build set of linked page IDs to avoid duplicates.
	$existing_ids = array();
	foreach ( (array) wp_get_nav_menu_items( $menu_id ) as $item ) {
		if ( ! $item instanceof WP_Post ) {
			continue;
		}
		if ( (string) $item->object === 'page' && isset( $item->object_id ) ) {
			$existing_ids[ (int) $item->object_id ] = true;
		}
	}

	$order_slug = array(
		'company',
		'concept',
		'philosophy',
		'services',
		'services-overview',
		'faq',
		'contact',
		'careers',
		'privacy-policy',
	);
	foreach ( $order_slug as $slug ) {
		if ( ! isset( $page_ids_by_slug[ $slug ] ) ) {
			continue;
		}

		$pid = (int) $page_ids_by_slug[ $slug ];

		if ( isset( $existing_ids[ $pid ] ) ) {
			continue;
		}

		wp_update_nav_menu_item(
			(int) $menu_id,
			0,
			array(
				'menu-item-title'     => get_the_title( $pid ),
				'menu-item-object-id' => $pid,
				'menu-item-object'    => 'page',
				'menu-item-type'      => 'post_type',
				'menu-item-status'    => 'publish',
			)
		);

		$existing_ids[ $pid ] = true;
	}

	if ( $already_assigned > 0 ) {
		return;
	}

	$locations_final            = get_nav_menu_locations();
	$locations_final['primary'] = $menu_id;
	set_theme_mod( 'nav_menu_locations', $locations_final );
}

theme_seed_standard_pages_maybe_run();
