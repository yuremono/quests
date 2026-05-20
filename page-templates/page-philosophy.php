<?php
/**
 * 設計理念・進め方の提示向けレイアウト。
 *
 * Template Name: 設計理念
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

	$philosophy_hero_kicker   = (string) theme_page_meta( $page_id, 'philosophy_hero_kicker', 'Philosophy' );
	$philosophy_hero_lead     = (string) theme_page_meta(
		$page_id,
		'philosophy_hero_lead',
		'プロセスを番号付きステップで示し、タイムラインと異なる「順序」の読みやすさを狙ったレイアウトです。'
	);
	$philosophy_steps_heading = (string) theme_page_meta( $page_id, 'philosophy_steps_heading', '進め方の考え方' );

	$steps = array(
		array(
			'title' => (string) theme_page_meta( $page_id, 'philosophy_step_1_title', '現場と制度の両面調査' ),
			'body'  => (string) theme_page_meta(
				$page_id,
				'philosophy_step_1_body',
				'敷地の気候・動線・既存資産と、適用法規・協議要件を並列で棚卸しします（ダミー説明）。'
			),
		),
		array(
			'title' => (string) theme_page_meta( $page_id, 'philosophy_step_2_title', 'シナリオの並列検討' ),
			'body'  => (string) theme_page_meta(
				$page_id,
				'philosophy_step_2_body',
				'単一案に縛らず、コスト・工期・将来的な拡張性を軸に複数パターンを比較します。'
			),
		),
		array(
			'title' => (string) theme_page_meta( $page_id, 'philosophy_step_3_title', '合意の文書化と伴走' ),
			'body'  => (string) theme_page_meta(
				$page_id,
				'philosophy_step_3_body',
				'決定理由と保留事項をセットで記録し、施行・運用フェーズでも参照できる状態にします（例）。'
			),
		),
	);

	$philosophy_timeline_heading = (string) theme_page_meta( $page_id, 'philosophy_timeline_heading', 'ミニタイムライン' );
	$philosophy_timeline_note    = (string) theme_page_meta(
		$page_id,
		'philosophy_timeline_note',
		'設計会社側の変遷を会社概要とは別角度でサブに載せる例です（実データに差し替えください）。'
	);
	$timeline                    = array(
		array(
			'label' => (string) theme_page_meta( $page_id, 'philosophy_timeline_1_label', '試行期' ),
			'desc'  => (string) theme_page_meta( $page_id, 'philosophy_timeline_1_desc', '地域プロジェクトでの実証とレビューのサイクル確立' ),
		),
		array(
			'label' => (string) theme_page_meta( $page_id, 'philosophy_timeline_2_label', '拡張期' ),
			'desc'  => (string) theme_page_meta( $page_id, 'philosophy_timeline_2_desc', '複合用途・中大規模への設計監査ノウハウ蓄積（ダミー）' ),
		),
	);
	?>
	<article <?php post_class( 'singular_article' ); ?>>

		<header class="page_hero" aria-labelledby="philosophy-hero-heading">
			<div class="page_hero_inner">
				<p class="page_hero_kicker"><?php echo esc_html( $philosophy_hero_kicker ); ?></p>
				<h1 id="philosophy-hero-heading" class="page_hero_title"><?php echo esc_html( get_the_title() ); ?></h1>
				<?php if ( has_excerpt() ) : ?>
					<p class="page_hero_lead"><?php echo esc_html( wp_strip_all_tags( get_the_excerpt() ) ); ?></p>
				<?php else : ?>
					<p class="page_hero_lead"><?php echo nl2br( esc_html( $philosophy_hero_lead ), false ); ?></p>
				<?php endif; ?>
			</div>
		</header>

		<section class="page_section" aria-labelledby="philosophy-steps-heading">
			<div class="wrap">
				<h2 id="philosophy-steps-heading" class="page_section_heading"><?php echo esc_html( $philosophy_steps_heading ); ?></h2>
				<ol class="tpl_philosophy_steps">
					<?php foreach ( $steps as $step ) : ?>
						<?php if ( '' === trim( $step['title'] . $step['body'] ) ) : ?>
							<?php continue; ?>
						<?php endif; ?>
					<li class="tpl_philosophy_steps_item">
						<span class="tpl_philosophy_steps_num" aria-hidden="true"></span>
						<div class="tpl_philosophy_steps_body">
							<h3 class="tpl_philosophy_steps_title"><?php echo esc_html( $step['title'] ); ?></h3>
							<p class="tpl_philosophy_steps_text"><?php echo nl2br( esc_html( $step['body'] ), false ); ?></p>
						</div>
					</li>
					<?php endforeach; ?>
				</ol>
			</div>
		</section>

		<section class="section_alt" aria-labelledby="philosophy-timeline-heading">
			<div class="wrap">
				<h2 id="philosophy-timeline-heading" class="page_section_heading"><?php echo esc_html( $philosophy_timeline_heading ); ?></h2>
				<p class="tpl_section_note"><?php echo nl2br( esc_html( $philosophy_timeline_note ), false ); ?></p>
				<ol class="timeline">
					<?php foreach ( $timeline as $row ) : ?>
						<?php if ( '' === trim( $row['label'] . $row['desc'] ) ) : ?>
							<?php continue; ?>
						<?php endif; ?>
					<li class="timeline_item">
						<p class="timeline_year"><?php echo esc_html( $row['label'] ); ?></p>
						<p class="timeline_desc"><?php echo nl2br( esc_html( $row['desc'] ), false ); ?></p>
					</li>
					<?php endforeach; ?>
				</ol>
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
