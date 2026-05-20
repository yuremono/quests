<?php
/**
 * Admin-side initial demo content seeding.
 *
 * @package Theme
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Portfolio front page default meta rows.
 *
 * @return array<int, array{meta: string, ref: string, value: string}>
 */
function theme_portfolio_default_meta_rows(): array {
	return array(
		array(
			'meta'  => 'pf_hero_brand',
			'ref'   => 'field_pc_pf_hero_brand',
			'value' => "yuremono\nworks",
		),
		array(
			'meta'  => 'pf_hero_heading',
			'ref'   => 'field_pc_pf_hero_heading',
			'value' => "2025/05からAI駆動開発を開始\nヴィジュアル表現をAIでブーストし\nコンテキストエンジニアリングに注力しています",
		),
		array(
			'meta'  => 'pf_hero_node_1',
			'ref'   => 'field_pc_pf_hero_node_1',
			'value' => 'Context',
		),
		array(
			'meta'  => 'pf_hero_node_2',
			'ref'   => 'field_pc_pf_hero_node_2',
			'value' => 'Development',
		),
		array(
			'meta'  => 'pf_hero_node_3',
			'ref'   => 'field_pc_pf_hero_node_3',
			'value' => 'Web',
		),
		array(
			'meta'  => 'pf_exp_heading',
			'ref'   => 'field_pc_pf_exp_heading',
			'value' => "Experience and\nDependencies",
		),
		array(
			'meta'  => 'pf_exp_subheading',
			'ref'   => 'field_pc_pf_exp_subheading',
			'value' => '経験と依存性',
		),
		array(
			'meta'  => 'pf_exp_about_heading',
			'ref'   => 'field_pc_pf_exp_about_heading',
			'value' => 'About This Site',
		),
		array(
			'meta'  => 'pf_exp_about_body',
			'ref'   => 'field_pc_pf_exp_about_body',
			'value' => "個人制作ページ、ツールをまとめています。\nこれまではNextJS CMS、AIチャット共有拡張機能、\nAI前提のweb開発を行なってきました。",
		),
		array(
			'meta'  => 'pf_exp_node_1',
			'ref'   => 'field_pc_pf_exp_node_1',
			'value' => 'Cursor',
		),
		array(
			'meta'  => 'pf_exp_node_2',
			'ref'   => 'field_pc_pf_exp_node_2',
			'value' => 'Claude Code',
		),
		array(
			'meta'  => 'pf_exp_node_3',
			'ref'   => 'field_pc_pf_exp_node_3',
			'value' => 'TailwindCSS',
		),
		array(
			'meta'  => 'pf_exp_node_4',
			'ref'   => 'field_pc_pf_exp_node_4',
			'value' => 'WebGL',
		),
		array(
			'meta'  => 'pf_exp_node_5',
			'ref'   => 'field_pc_pf_exp_node_5',
			'value' => 'Codex',
		),
		array(
			'meta'  => 'pf_exp_node_6',
			'ref'   => 'field_pc_pf_exp_node_6',
			'value' => 'Pencil.dev',
		),
		array(
			'meta'  => 'pf_exp_bar',
			'ref'   => 'field_pc_pf_exp_bar',
			'value' => 'Typescript PhotoShop Figma Three.js Supabase GSAP',
		),
		array(
			'meta'  => 'pf_exp_dialog_kicker',
			'ref'   => 'field_pc_pf_exp_dialog_kicker',
			'value' => 'Details',
		),
		array(
			'meta'  => 'pf_exp_dialog_heading',
			'ref'   => 'field_pc_pf_exp_dialog_heading',
			'value' => 'Experience and Dependencies',
		),
		array(
			'meta'  => 'pf_exp_dialog_lead',
			'ref'   => 'field_pc_pf_exp_dialog_lead',
			'value' => '経験とAI依存の詳細。',
		),
		array(
			'meta'  => 'pf_exp_dialog_body',
			'ref'   => 'field_pc_pf_exp_dialog_body',
			'value' => theme_default_experience_dialog_body(),
		),
		array(
			'meta'  => 'pf_vibe_line_1',
			'ref'   => 'field_pc_pf_vibe_line_1',
			'value' => "Vibe\n  Design",
		),
		array(
			'meta'  => 'pf_vibe_line_2',
			'ref'   => 'field_pc_pf_vibe_line_2',
			'value' => 'or',
		),
		array(
			'meta'  => 'pf_vibe_line_3',
			'ref'   => 'field_pc_pf_vibe_line_3',
			'value' => "Vault \nDriven",
		),
		array(
			'meta'  => 'pf_vibe_ready_heading',
			'ref'   => 'field_pc_pf_vibe_ready_heading',
			'value' => 'AI Ready',
		),
		array(
			'meta'  => 'pf_vibe_ready_body',
			'ref'   => 'field_pc_pf_vibe_ready_body',
			'value' => '<b>DESIGN.md</b> , <b>画像生成デザイン</b>を基点としたゼロからのページ作成の検証と、<b>自然言語でUIパーツを再利用</b>する為の環境構築を行っています。',
		),
		array(
			'meta'  => 'pf_vibe_byos_heading',
			'ref'   => 'field_pc_pf_vibe_byos_heading',
			'value' => 'Burn Your Own Style',
		),
		array(
			'meta'  => 'pf_vibe_byos_body',
			'ref'   => 'field_pc_pf_vibe_byos_body',
			'value' => '<details class="Toggle IsSmall font-normal mt-2"><summary class="Eng">Thinking...</summary><div>- モデルの学習データに基づくwebデザイン・コーディングは平均的で、振れ幅が大きく、個人の理想とするマークアップ、スタイリングとかけ離れたものになる。<br>- 構造=既存クラス、装飾=Tailwindで手直ししやすい状態になるが、無駄な記述が多い。<br>考察：モデルのファインチューニングが民主化するまでは「完成品の再利用」を効率化する方が良い</div></details>',
		),
		array(
			'meta'  => 'pf_vibe_repo_url',
			'ref'   => 'field_pc_pf_vibe_repo_url',
			'value' => 'https://github.com/yuremono/BurnYourOwnStyle/tree/react',
		),
		array(
			'meta'  => 'pf_vibe_preview_url',
			'ref'   => 'field_pc_pf_vibe_preview_url',
			'value' => home_url( '/preview' ),
		),
		array(
			'meta'  => 'pf_vibe_bar',
			'ref'   => 'field_pc_pf_vibe_bar',
			'value' => 'Typescript PhotoShop Figma Three.js Supabase GSAP',
		),
		array(
			'meta'  => 'pf_bunmyaku_heading',
			'ref'   => 'field_pc_pf_bunmyaku_heading',
			'value' => '## 文脈.app',
		),
		array(
			'meta'  => 'pf_bunmyaku_body',
			'ref'   => 'field_pc_pf_bunmyaku_body',
			'value' => '### SPEC.md, DESIGN.md, AGENTS.md をGUIで作成するツール<br><br>DESIGN.mdはフロントエンドの要件定義書と言えます。公開サイトURLから作成するツールが多く出回っており、一定の効率化につながりますが、Sticthの公式テンプレートの情報量でも不十分であり、結局テンプレート出力になります。<br><br>一方ClaudeDesignでは詳細を問いかける設計が従来のAIビルダーとの差別化でありますが、最先端モデルのテンプレートであることに変わりはありません。<br><br>このツールではClaudeやモデル性能に依存せずに仕様書を作成すること。GUIで認知コストを下げることでどこまで実用に耐えられるかを試すMVP未満のものです。実際には出力品質を担保するための質問を用意することが最先端モデルでも困難で、時間がかかります。<br><br>AGENTS.md(CLAUDE.md)では文章量を少なくすることが推奨されており、定型的なデータを使う場合が多いので最低水準が低いように思いますが、頻繁に更新するものではありません。AIツールを使い始める人のため、またはプロンプト保存、SKILL保管庫の機能を統合することでチーム内ツールとして活用できる可能性はあります。<br>またcodex app-serverなどでGUI上から文書をプロンプトとしてあらためてmdファイルの作成をリクエストするという実装も検討できます。',
		),
		array(
			'meta'  => 'pf_bunmyaku_link_label',
			'ref'   => 'field_pc_pf_bunmyaku_link_label',
			'value' => 'Bunmyaku',
		),
		array(
			'meta'  => 'pf_bunmyaku_link_url',
			'ref'   => 'field_pc_pf_bunmyaku_link_url',
			'value' => home_url( '/bunmyaku' ),
		),
		array(
			'meta'  => 'pf_footer_name',
			'ref'   => 'field_pc_pf_footer_name',
			'value' => 'Yano Seiji',
		),
		array(
			'meta'  => 'pf_footer_hobby',
			'ref'   => 'field_pc_pf_footer_hobby',
			'value' => "Manga I love\nAnime I love\nLight Novel I love\nMusic I love",
		),
		array(
			'meta'  => 'pf_footer_specialty',
			'ref'   => 'field_pc_pf_footer_specialty',
			'value' => "CSS Styling\nContext Engineering",
		),
		array(
			'meta'  => 'pf_footer_brand',
			'ref'   => 'field_pc_pf_footer_brand',
			'value' => 'yuremono works',
		),
	);
}

/**
 * Seed portfolio front page ACF fields when empty.
 */
function theme_seed_portfolio_front_meta_if_empty(): void {
	$post_id = theme_front_page_id();
	if ( $post_id < 1 ) {
		return;
	}

	foreach ( theme_portfolio_default_meta_rows() as $row ) {
		if ( ! metadata_exists( 'post', $post_id, $row['meta'] ) || theme_acf_value_absent( get_post_meta( $post_id, $row['meta'], true ) ) ) {
			update_post_meta( $post_id, $row['meta'], $row['value'] );
			update_post_meta( $post_id, '_' . $row['meta'], $row['ref'] );
		}
	}
}

/**
 * Seed editable Work posts without overwriting filled fields.
 */
function theme_seed_work_posts_if_empty(): void {
	$order = 0;
	foreach ( theme_legacy_repulsion_items() as $item ) {
		$title = (string) ( $item['title'] ?? '' );
		if ( '' === $title ) {
			continue;
		}

		$existing_posts = get_posts(
			array(
				'post_type'              => 'work',
				'title'                  => $title,
				'post_status'            => 'any',
				'posts_per_page'         => 1,
				'no_found_rows'          => true,
				'update_post_meta_cache' => false,
				'update_post_term_cache' => false,
			)
		);
		$existing       = $existing_posts[0] ?? null;
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
			++$order;
			continue;
		}

		$post_id    = (int) $post_id;
		$is_initial = ! empty( $item['is_initial'] );
		$rows       = array(
			array(
				'meta'  => 'work_is_initial',
				'ref'   => 'field_pc_work_is_initial',
				'value' => $is_initial ? '1' : '0',
			),
			array(
				'meta'  => 'work_url',
				'ref'   => 'field_pc_work_url',
				'value' => (string) ( $item['href'] ?? '' ),
			),
			array(
				'meta'  => 'work_path',
				'ref'   => 'field_pc_work_path',
				'value' => (string) ( $item['to'] ?? '' ),
			),
			array(
				'meta'  => 'work_css_class',
				'ref'   => 'field_pc_work_css_class',
				'value' => (string) ( $item['class'] ?? '' ),
			),
			array(
				'meta'  => 'work_popup',
				'ref'   => 'field_pc_work_popup',
				'value' => (string) ( $item['content'] ?? '' ),
			),
		);

		foreach ( $rows as $row ) {
			if ( ! metadata_exists( 'post', $post_id, $row['meta'] ) || theme_acf_value_absent( get_post_meta( $post_id, $row['meta'], true ) ) ) {
				update_post_meta( $post_id, $row['meta'], $row['value'] );
				update_post_meta( $post_id, '_' . $row['meta'], $row['ref'] );
			}
		}
		++$order;
	}
}

/**
 * Populate missing demo content from wp-admin without overwriting edits.
 */
function theme_seed_admin_demo_content(): void {
	if ( ! is_admin() || wp_doing_ajax() || ! current_user_can( 'manage_options' ) ) {
		return;
	}

	theme_seed_portfolio_front_meta_if_empty();
	theme_seed_work_posts_if_empty();
}
add_action( 'admin_init', 'theme_seed_admin_demo_content' );
