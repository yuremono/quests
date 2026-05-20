<?php
/**
 * コンセプト／ブランドストーリー向けレイアウト。
 *
 * Template Name: コンセプト
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

	$concept_hero_kicker     = (string) theme_page_meta( $page_id, 'concept_hero_kicker', 'Concept' );
	$concept_hero_lead       = (string) theme_page_meta(
		$page_id,
		'concept_hero_lead',
		'ブランドの芯となるメッセージをリードとピラーで整理する構成です。本文ブロックでは詳細ケーススタディやギャラリーを続けられます。'
	);
	$concept_lead_heading    = (string) theme_page_meta( $page_id, 'concept_lead_heading', 'リード' );
	$concept_lead_body       = (string) theme_page_meta(
		$page_id,
		'concept_lead_body',
		'暮らしと土地のあいだを設計するとき、まず問うのは「誰にとっての心地よさか」。法令や効率だけでは届かない距離感まで含めて、合意に耐えるストーリーを組み立てます（デモ文言）。'
	);
	$concept_pillars_heading = (string) theme_page_meta( $page_id, 'concept_pillars_heading', '三本柱' );

	$pillars = array(
		array(
			'tag'   => (string) theme_page_meta( $page_id, 'concept_pillar_1_tag', 'Pillar 01' ),
			'title' => (string) theme_page_meta( $page_id, 'concept_pillar_1_title', '対話からの設計' ),
			'body'  => (string) theme_page_meta(
				$page_id,
				'concept_pillar_1_body',
				'ステークホルダーの語りを構造化し、図面に埋め込むまでの過程を透明にします（プレースホルダー）。'
			),
		),
		array(
			'tag'   => (string) theme_page_meta( $page_id, 'concept_pillar_2_tag', 'Pillar 02' ),
			'title' => (string) theme_page_meta( $page_id, 'concept_pillar_2_title', '耐久と手触りの両立' ),
			'body'  => (string) theme_page_meta(
				$page_id,
				'concept_pillar_2_body',
				'構造や設備の合理性と、日々の触感・光の質とのバランスを同じテーブルで検討します。'
			),
		),
		array(
			'tag'   => (string) theme_page_meta( $page_id, 'concept_pillar_3_tag', 'Pillar 03' ),
			'title' => (string) theme_page_meta( $page_id, 'concept_pillar_3_title', '運用まで見据える' ),
			'body'  => (string) theme_page_meta(
				$page_id,
				'concept_pillar_3_body',
				'開いてからの保守動線やリニューアル余地まで視野に入れた提案をめざします（例示）。'
			),
		),
	);
	?>
	<article <?php post_class( 'singular_article' ); ?>>

		<header class="page_hero" aria-labelledby="concept-hero-heading">
			<div class="page_hero_inner">
				<p class="page_hero_kicker"><?php echo esc_html( $concept_hero_kicker ); ?></p>
				<h1 id="concept-hero-heading" class="page_hero_title"><?php echo esc_html( get_the_title() ); ?></h1>
				<?php if ( has_excerpt() ) : ?>
					<p class="page_hero_lead"><?php echo esc_html( wp_strip_all_tags( get_the_excerpt() ) ); ?></p>
				<?php else : ?>
					<p class="page_hero_lead"><?php echo nl2br( esc_html( $concept_hero_lead ), false ); ?></p>
				<?php endif; ?>
			</div>
		</header>

		<section class="page_section" aria-labelledby="concept-lead-heading">
			<div class="wrap">
				<h2 id="concept-lead-heading" class="page_section_heading"><?php echo esc_html( $concept_lead_heading ); ?></h2>
				<div class="tpl_concept_lead">
					<p class="tpl_concept_lead_text"><?php echo nl2br( esc_html( $concept_lead_body ), false ); ?></p>
				</div>
			</div>
		</section>

		<section class="section_alt" aria-labelledby="concept-pillars-heading">
			<div class="wrap">
				<h2 id="concept-pillars-heading" class="page_section_heading"><?php echo esc_html( $concept_pillars_heading ); ?></h2>
				<div class="info_cards">
					<?php foreach ( $pillars as $pillar ) : ?>
					<div class="info_card tpl_pillar">
						<p class="tpl_pillar_tag"><?php echo esc_html( $pillar['tag'] ); ?></p>
						<h3 class="info_card_title"><?php echo esc_html( $pillar['title'] ); ?></h3>
						<p class="info_card_text"><?php echo nl2br( esc_html( $pillar['body'] ), false ); ?></p>
					</div>
					<?php endforeach; ?>
				</div>
			</div>
		</section>

		<section class="page_section" aria-label="<?php echo esc_attr__( '本文コンテンツ', THEME_GETTEXT_DOMAIN ); ?>">
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
