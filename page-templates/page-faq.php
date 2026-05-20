<?php
/**
 * よくある質問レイアウト（ネイティブ disclosure）。
 *
 * Template Name: FAQ
 *
 * @package Theme
 */

declare(strict_types=1);

get_header();
?>

<div class="page_main">
<?php
while ( have_posts() ) :
	the_post();
	$page_id = get_the_ID();

	$faq_hero_kicker  = (string) theme_page_meta( $page_id, 'faq_hero_kicker', 'FAQ' );
	$faq_hero_lead    = (string) theme_page_meta(
		$page_id,
		'faq_hero_lead',
		'キーボードでも開閉しやすいよう summary にフォーカスリングを付けています。詳細は本文ブロック側にも追記できます。'
	);
	$faq_list_heading = (string) theme_page_meta( $page_id, 'faq_list_heading', 'よくあるご質問' );
	$faq_intro        = (string) theme_page_meta(
		$page_id,
		'faq_intro',
		'以下はデモ用の Q&A です。編集画面からブロックで追加した段落と併用できます。'
	);

	$faq_items = array(
		array(
			'q' => (string) theme_page_meta( $page_id, 'faq_item_1_question', '初回相談から提案までどのくらいかかりますか？' ),
			'a' => (string) theme_page_meta(
				$page_id,
				'faq_item_1_answer',
				'規模により異なりますが、デモ文言としては机上検討から概略プラン提示まで 3〜6 週間を目安に記載している例です。'
			),
		),
		array(
			'q' => (string) theme_page_meta( $page_id, 'faq_item_2_question', '対応エリアは限定されていますか？' ),
			'a' => (string) theme_page_meta(
				$page_id,
				'faq_item_2_answer',
				'関西圏を中心にオンサイト調査を行う想定のプレースホルダーです。リモートのみの支援可否は別途ご相談、という運用にもできます。'
			),
		),
		array(
			'q' => (string) theme_page_meta( $page_id, 'faq_item_3_question', '見積もりやコンサル費用の支払い条件は？' ),
			'a' => (string) theme_page_meta(
				$page_id,
				'faq_item_3_answer',
				'フェーズごとにミールストーン請求／実費精算など、契約書ベースで記載してください（ダミー）。'
			),
		),
		array(
			'q' => (string) theme_page_meta( $page_id, 'faq_item_4_question', '既存建築のリノベにも対応していますか？' ),
			'a' => (string) theme_page_meta(
				$page_id,
				'faq_item_4_answer',
				'構造診断や設備更新を含む全体計画から部分改修まで幅を持たせる説明文をここに置けます。'
			),
		),
	);
	?>
	<article <?php post_class( 'singular_article' ); ?>>

		<header class="page_hero" aria-labelledby="faq-hero-heading">
			<div class="page_hero_inner">
				<p class="page_hero_kicker"><?php echo esc_html( $faq_hero_kicker ); ?></p>
				<h1 id="faq-hero-heading" class="page_hero_title"><?php echo esc_html( get_the_title() ); ?></h1>
				<?php if ( has_excerpt() ) : ?>
					<p class="page_hero_lead"><?php echo esc_html( wp_strip_all_tags( get_the_excerpt() ) ); ?></p>
				<?php else : ?>
					<p class="page_hero_lead"><?php echo nl2br( esc_html( $faq_hero_lead ), false ); ?></p>
				<?php endif; ?>
			</div>
		</header>

		<section class="page_section" aria-labelledby="faq-list-heading">
			<div class="wrap">
				<h2 id="faq-list-heading" class="page_section_heading"><?php echo esc_html( $faq_list_heading ); ?></h2>
				<p class="tpl_faq_intro"><?php echo nl2br( esc_html( $faq_intro ), false ); ?></p>
				<div class="tpl_faq">
					<?php foreach ( $faq_items as $faq_item ) : ?>
						<?php if ( '' === trim( $faq_item['q'] ) ) : ?>
							<?php continue; ?>
						<?php endif; ?>
					<details class="tpl_faq_item">
						<summary class="tpl_faq_summary"><?php echo esc_html( $faq_item['q'] ); ?></summary>
						<div class="tpl_faq_panel">
							<p><?php echo nl2br( esc_html( $faq_item['a'] ), false ); ?></p>
						</div>
					</details>
					<?php endforeach; ?>
				</div>
			</div>
		</section>

		<section class="section_alt" aria-label="<?php echo esc_attr__( '本文コンテンツ', THEME_GETTEXT_DOMAIN ); ?>">
			<div class="wrap">
				<div class="entry-content entry">
					<?php the_content(); ?>
				</div>
			</div>
		</section>

	</article>
	<?php
endwhile;
?>
</div>

<?php
get_footer();
