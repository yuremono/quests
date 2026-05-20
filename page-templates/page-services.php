<?php
/**
 * サービス紹介向けレイアウト。
 *
 * Template Name: サービス
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

	$services_hero_kicker  = (string) theme_page_meta( $page_id, 'services_hero_kicker', 'Services' );
	$services_hero_lead    = (string) theme_page_meta(
		$page_id,
		'services_hero_lead',
		'主なサービス領域をカードで示す構成例です。下の説明は編集画面の本文との併せ持ちにもかかわらず、この枠のみ静的なデモにできます。'
	);
	$services_grid_heading = (string) theme_page_meta( $page_id, 'services_grid_heading', 'サービス一覧' );

	$cards = array(
		array(
			'title' => (string) theme_page_meta( $page_id, 'services_card_1_title', '企画／コンセプト' ),
			'body'  => (string) theme_page_meta(
				$page_id,
				'services_card_1_body',
				'敷地や用途に応じて初期ロジックから整理し、合意ベースでの方向性宣言までをご支援します。'
			),
		),
		array(
			'title' => (string) theme_page_meta( $page_id, 'services_card_2_title', '基本計画〜実施設計' ),
			'body'  => (string) theme_page_meta(
				$page_id,
				'services_card_2_body',
				'法規適合だけでなく、暮らす人の視線まで含めてプランを細かく検討します。'
			),
		),
		array(
			'title' => (string) theme_page_meta( $page_id, 'services_card_3_title', 'ワークショップ／伴走支援' ),
			'body'  => (string) theme_page_meta(
				$page_id,
				'services_card_3_body',
				'関係者が同じ言葉を共有できるよう、場づくりとファシリテーションを組み込みます。'
			),
		),
		array(
			'title' => (string) theme_page_meta( $page_id, 'services_card_4_title', '維持管理・定期点検' ),
			'body'  => (string) theme_page_meta(
				$page_id,
				'services_card_4_body',
				'運用フェーズにも橋渡しできる体制を一例として掲載（プレースホルダー）します。'
			),
		),
	);
	?>
	<article <?php post_class( 'singular_article' ); ?>>

		<header class="page_hero" aria-labelledby="services-hero-heading">
			<div class="page_hero_inner">
				<p class="page_hero_kicker"><?php echo esc_html( $services_hero_kicker ); ?></p>
				<h1 id="services-hero-heading" class="page_hero_title"><?php echo esc_html( get_the_title() ); ?></h1>
				<?php if ( has_excerpt() ) : ?>
					<p class="page_hero_lead"><?php echo esc_html( wp_strip_all_tags( get_the_excerpt() ) ); ?></p>
				<?php else : ?>
					<p class="page_hero_lead"><?php echo nl2br( esc_html( $services_hero_lead ), false ); ?></p>
				<?php endif; ?>
			</div>
		</header>

		<section class="page_section" aria-labelledby="services-grid-heading">
			<div class="wrap">
				<h2 id="services-grid-heading" class="page_section_heading"><?php echo esc_html( $services_grid_heading ); ?></h2>
				<div class="info_cards">
					<?php foreach ( $cards as $card ) : ?>
						<?php if ( '' === trim( $card['title'] . $card['body'] ) ) : ?>
							<?php continue; ?>
						<?php endif; ?>
					<div class="info_card">
						<h3 class="info_card_title"><?php echo esc_html( $card['title'] ); ?></h3>
						<p class="info_card_text"><?php echo nl2br( esc_html( $card['body'] ), false ); ?></p>
					</div>
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
