<?php
/**
 * Portfolio front page ACF field group.
 *
 * @package Theme
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register portfolio front page ACF fields.
 */
function theme_register_portfolio_front_acf(): void {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	$td          = THEME_GETTEXT_DOMAIN;
	$field_group = array(
		'key'                   => 'group_pc_front_page',
		'title'                 => __( 'ポートフォリオ TOP', $td ),
		'fields'                => array(
			array(
				'key'     => 'field_pc_pf_intro',
				'label'   => __( 'について', $td ),
				'name'    => '',
				'type'    => 'message',
				'message' => __( 'React 移植ポートフォリオ TOP の文言・画像。フロントページ用 group_pc_front_page として登録します。', $td ),
			),
			array(
				'key'   => 'field_pc_pf_tab_hero',
				'label' => __( 'Hero', $td ),
				'name'  => '',
				'type'  => 'tab',
			),
			array(
				'key'           => 'field_pc_pf_hero_brand',
				'label'         => __( 'ブランド名', $td ),
				'name'          => 'pf_hero_brand',
				'type'          => 'textarea',
				'rows'          => 2,
				'default_value' => "yuremono\nworks",
			),
			array(
				'key'           => 'field_pc_pf_hero_heading',
				'label'         => __( 'ヒーロー見出し', $td ),
				'name'          => 'pf_hero_heading',
				'type'          => 'textarea',
				'rows'          => 4,
				'default_value' => "2025/05からAI駆動開発を開始\nヴィジュアル表現をAIでブーストし\nコンテキストエンジニアリングに注力しています",
			),
			array(
				'key'           => 'field_pc_pf_hero_node_1',
				'label'         => __( 'MindMap ラベル 1', $td ),
				'name'          => 'pf_hero_node_1',
				'type'          => 'text',
				'default_value' => 'Context',
			),
			array(
				'key'           => 'field_pc_pf_hero_node_2',
				'label'         => __( 'MindMap ラベル 2', $td ),
				'name'          => 'pf_hero_node_2',
				'type'          => 'text',
				'default_value' => 'Development',
			),
			array(
				'key'           => 'field_pc_pf_hero_node_3',
				'label'         => __( 'MindMap ラベル 3', $td ),
				'name'          => 'pf_hero_node_3',
				'type'          => 'text',
				'default_value' => 'Web',
			),
			array(
				'key'   => 'field_pc_pf_tab_exp',
				'label' => __( 'Experience', $td ),
				'name'  => '',
				'type'  => 'tab',
			),
			array(
				'key'           => 'field_pc_pf_exp_heading',
				'label'         => __( '見出し（英語）', $td ),
				'name'          => 'pf_exp_heading',
				'type'          => 'textarea',
				'rows'          => 2,
				'default_value' => "Experience and\nDependencies",
			),
			array(
				'key'           => 'field_pc_pf_exp_subheading',
				'label'         => __( '小見出し', $td ),
				'name'          => 'pf_exp_subheading',
				'type'          => 'text',
				'default_value' => '経験と依存性',
			),
			array(
				'key'           => 'field_pc_pf_exp_about_heading',
				'label'         => __( 'About 見出し', $td ),
				'name'          => 'pf_exp_about_heading',
				'type'          => 'text',
				'default_value' => 'About This Site',
			),
			array(
				'key'           => 'field_pc_pf_exp_about_body',
				'label'         => __( 'About 本文', $td ),
				'name'          => 'pf_exp_about_body',
				'type'          => 'textarea',
				'rows'          => 4,
				'default_value' => "個人制作ページ、ツールをまとめています。\nこれまではNextJS CMS、AIチャット共有拡張機能、\nAI前提のweb開発を行なってきました。",
			),
			array(
				'key'           => 'field_pc_pf_exp_node_1',
				'label'         => __( 'MindMap ノード 1', $td ),
				'name'          => 'pf_exp_node_1',
				'type'          => 'text',
				'default_value' => 'Cursor',
			),
			array(
				'key'           => 'field_pc_pf_exp_node_2',
				'label'         => __( 'MindMap ノード 2', $td ),
				'name'          => 'pf_exp_node_2',
				'type'          => 'text',
				'default_value' => 'Claude Code',
			),
			array(
				'key'           => 'field_pc_pf_exp_node_3',
				'label'         => __( 'MindMap ノード 3', $td ),
				'name'          => 'pf_exp_node_3',
				'type'          => 'text',
				'default_value' => 'TailwindCSS',
			),
			array(
				'key'           => 'field_pc_pf_exp_node_4',
				'label'         => __( 'MindMap ノード 4', $td ),
				'name'          => 'pf_exp_node_4',
				'type'          => 'text',
				'default_value' => 'WebGL',
			),
			array(
				'key'           => 'field_pc_pf_exp_node_5',
				'label'         => __( 'MindMap ノード 5', $td ),
				'name'          => 'pf_exp_node_5',
				'type'          => 'text',
				'default_value' => 'Codex',
			),
			array(
				'key'           => 'field_pc_pf_exp_node_6',
				'label'         => __( 'MindMap ノード 6', $td ),
				'name'          => 'pf_exp_node_6',
				'type'          => 'text',
				'default_value' => 'Pencil.dev',
			),
			array(
				'key'           => 'field_pc_pf_exp_bar',
				'label'         => __( '下部バー文言', $td ),
				'name'          => 'pf_exp_bar',
				'type'          => 'text',
				'default_value' => 'Typescript PhotoShop Figma Three.js Supabase GSAP',
			),
			array(
				'key'           => 'field_pc_pf_exp_dialog_kicker',
				'label'         => __( 'Dialog キッカー', $td ),
				'name'          => 'pf_exp_dialog_kicker',
				'type'          => 'text',
				'default_value' => 'Details',
			),
			array(
				'key'           => 'field_pc_pf_exp_dialog_heading',
				'label'         => __( 'Dialog 見出し', $td ),
				'name'          => 'pf_exp_dialog_heading',
				'type'          => 'text',
				'default_value' => 'Experience and Dependencies',
			),
			array(
				'key'           => 'field_pc_pf_exp_dialog_lead',
				'label'         => __( 'Dialog リード', $td ),
				'name'          => 'pf_exp_dialog_lead',
				'type'          => 'text',
				'default_value' => '経験とAI依存の詳細。',
			),
			array(
				'key'           => 'field_pc_pf_exp_dialog_body',
				'label'         => __( 'Dialog 本文（Cards）', $td ),
				'name'          => 'pf_exp_dialog_body',
				'type'          => 'wysiwyg',
				'tabs'          => 'all',
				'toolbar'       => 'full',
				'media_upload'  => 0,
				'default_value' => theme_default_experience_dialog_body(),
				'instructions'  => __( '空の場合はテンプレート既定の Cards を表示します。', $td ),
			),
			array(
				'key'   => 'field_pc_pf_tab_vibe',
				'label' => __( 'Vibe Design', $td ),
				'name'  => '',
				'type'  => 'tab',
			),
			array(
				'key'           => 'field_pc_pf_vibe_line_1',
				'label'         => __( '左見出し行 1', $td ),
				'name'          => 'pf_vibe_line_1',
				'type'          => 'textarea',
				'rows'          => 2,
				'default_value' => "Vibe\n  Design",
			),
			array(
				'key'           => 'field_pc_pf_vibe_line_2',
				'label'         => __( '左見出し行 2', $td ),
				'name'          => 'pf_vibe_line_2',
				'type'          => 'text',
				'default_value' => 'or',
			),
			array(
				'key'           => 'field_pc_pf_vibe_line_3',
				'label'         => __( '左見出し行 3', $td ),
				'name'          => 'pf_vibe_line_3',
				'type'          => 'textarea',
				'rows'          => 2,
				'default_value' => "Vault \nDriven",
			),
			array(
				'key'           => 'field_pc_pf_vibe_ready_heading',
				'label'         => __( 'AI Ready 見出し', $td ),
				'name'          => 'pf_vibe_ready_heading',
				'type'          => 'text',
				'default_value' => 'AI Ready',
			),
			array(
				'key'           => 'field_pc_pf_vibe_ready_body',
				'label'         => __( 'AI Ready 本文', $td ),
				'name'          => 'pf_vibe_ready_body',
				'type'          => 'wysiwyg',
				'toolbar'       => 'basic',
				'media_upload'  => 0,
				'default_value' => '<b>DESIGN.md</b> , <b>画像生成デザイン</b>を基点としたゼロからのページ作成の検証と、<b>自然言語でUIパーツを再利用</b>する為の環境構築を行っています。',
			),
			array(
				'key'           => 'field_pc_pf_vibe_byos_heading',
				'label'         => __( 'BYOS 見出し', $td ),
				'name'          => 'pf_vibe_byos_heading',
				'type'          => 'text',
				'default_value' => 'Burn Your Own Style',
			),
			array(
				'key'          => 'field_pc_pf_vibe_byos_body',
				'label'        => __( 'BYOS 本文（details 含む）', $td ),
				'name'         => 'pf_vibe_byos_body',
				'type'         => 'wysiwyg',
				'toolbar'      => 'basic',
				'media_upload' => 0,
			),
			array(
				'key'           => 'field_pc_pf_vibe_repo_url',
				'label'         => __( 'Repository URL', $td ),
				'name'          => 'pf_vibe_repo_url',
				'type'          => 'url',
				'default_value' => 'https://github.com/yuremono/BurnYourOwnStyle/tree/react',
			),
			array(
				'key'           => 'field_pc_pf_vibe_preview_url',
				'label'         => __( 'Preview URL', $td ),
				'name'          => 'pf_vibe_preview_url',
				'type'          => 'url',
				'default_value' => '',
			),
			array(
				'key'           => 'field_pc_pf_vibe_bar',
				'label'         => __( '下部バー文言', $td ),
				'name'          => 'pf_vibe_bar',
				'type'          => 'text',
				'default_value' => 'Typescript PhotoShop Figma Three.js Supabase GSAP',
			),
			array(
				'key'   => 'field_pc_pf_tab_bunmyaku',
				'label' => __( 'Bunmyaku', $td ),
				'name'  => '',
				'type'  => 'tab',
			),
			array(
				'key'           => 'field_pc_pf_bunmyaku_heading',
				'label'         => __( '見出し', $td ),
				'name'          => 'pf_bunmyaku_heading',
				'type'          => 'text',
				'default_value' => '## 文脈.app',
			),
			array(
				'key'           => 'field_pc_pf_bunmyaku_body',
				'label'         => __( '本文', $td ),
				'name'          => 'pf_bunmyaku_body',
				'type'          => 'wysiwyg',
				'toolbar'       => 'full',
				'media_upload'  => 0,
				'default_value' => '### SPEC.md, DESIGN.md, AGENTS.md をGUIで作成するツール<br><br>DESIGN.mdはフロントエンドの要件定義書と言えます。公開サイトURLから作成するツールが多く出回っており、一定の効率化につながりますが、Sticthの公式テンプレートの情報量でも不十分であり、結局テンプレート出力になります。<br><br>一方ClaudeDesignでは詳細を問いかける設計が従来のAIビルダーとの差別化でありますが、最先端モデルのテンプレートであることに変わりはありません。<br><br>このツールではClaudeやモデル性能に依存せずに仕様書を作成すること。GUIで認知コストを下げることでどこまで実用に耐えられるかを試すMVP未満のものです。実際には出力品質を担保するための質問を用意することが最先端モデルでも困難で、時間がかかります。<br><br>AGENTS.md(CLAUDE.md)では文章量を少なくすることが推奨されており、定型的なデータを使う場合が多いので最低水準が低いように思いますが、頻繁に更新するものではありません。AIツールを使い始める人のため、またはプロンプト保存、SKILL保管庫の機能を統合することでチーム内ツールとして活用できる可能性はあります。<br>またcodex app-serverなどでGUI上から文書をプロンプトとしてあらためてmdファイルの作成をリクエストするという実装も検討できます。',
				'instructions'  => __( '見出し、段落、強調、リンクを編集できます。改行は段落として保存されます。', $td ),
			),
			array(
				'key'           => 'field_pc_pf_bunmyaku_link_label',
				'label'         => __( 'リンク文言', $td ),
				'name'          => 'pf_bunmyaku_link_label',
				'type'          => 'text',
				'default_value' => 'Bunmyaku',
			),
			array(
				'key'           => 'field_pc_pf_bunmyaku_link_url',
				'label'         => __( 'リンク URL', $td ),
				'name'          => 'pf_bunmyaku_link_url',
				'type'          => 'url',
				'default_value' => '',
			),
			array(
				'key'   => 'field_pc_pf_tab_footer',
				'label' => __( 'Footer', $td ),
				'name'  => '',
				'type'  => 'tab',
			),
			array(
				'key'           => 'field_pc_pf_footer_name',
				'label'         => __( 'Name', $td ),
				'name'          => 'pf_footer_name',
				'type'          => 'text',
				'default_value' => 'Yano Seiji',
			),
			array(
				'key'           => 'field_pc_pf_footer_hobby',
				'label'         => __( 'Hobby', $td ),
				'name'          => 'pf_footer_hobby',
				'type'          => 'textarea',
				'rows'          => 4,
				'default_value' => "Manga I love\nAnime I love\nLight Novel I love\nMusic I love",
			),
			array(
				'key'           => 'field_pc_pf_footer_specialty',
				'label'         => __( 'Specialty', $td ),
				'name'          => 'pf_footer_specialty',
				'type'          => 'textarea',
				'rows'          => 2,
				'default_value' => "CSS Styling\nContext Engineering",
			),
			array(
				'key'           => 'field_pc_pf_footer_brand',
				'label'         => __( 'ブランド名', $td ),
				'name'          => 'pf_footer_brand',
				'type'          => 'text',
				'default_value' => 'yuremono works',
			),
		),
		'location'              => array(
			array(
				array(
					'param'    => 'page_type',
					'operator' => '==',
					'value'    => 'front_page',
				),
			),
		),
		'position'              => 'acf_after_title',
		'style'                 => 'default',
		'label_placement'       => 'top',
		'instruction_placement' => 'label',
		'active'                => true,
	);

	if (
		function_exists( 'acf_get_local_field_group' )
		&& function_exists( 'acf_add_local_field' )
		&& acf_get_local_field_group( 'group_pc_front_page' )
	) {
		foreach ( $field_group['fields'] as $field ) {
			$field['parent'] = 'group_pc_front_page';
			acf_add_local_field( $field );
		}
		return;
	}

	acf_add_local_field_group( $field_group );
}
add_action( 'acf/init', 'theme_register_portfolio_front_acf', 20 );
