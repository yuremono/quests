<?php
/**
 * 採用情報ページ向けレイアウト。
 *
 * Template Name: 採用情報
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

	$careers_hero_kicker       = (string) theme_page_meta( $page_id, 'careers_hero_kicker', 'Careers' );
	$careers_hero_lead         = (string) theme_page_meta(
		$page_id,
		'careers_hero_lead',
		'働き方を左右するトーンを先に示し、詳細ページ本文は続きへ。左右のリストは一覧性を高めるデモ構成です。'
	);
	$careers_intro_heading     = (string) theme_page_meta( $page_id, 'careers_intro_heading', '採用のハイライト' );
	$careers_intro_body        = (string) theme_page_meta(
		$page_id,
		'careers_intro_body',
		'少数精鋭で案件に深く入り込むコースと、制作体制を支えるコースの両輪でチームが回っています。まずは下の共通前提を読みいただいたうえで、本文で募集職種の詳細を更新してください。'
	);
	$careers_col_left_heading  = (string) theme_page_meta( $page_id, 'careers_col_left_heading', '共通の前提（例）' );
	$careers_col_right_heading = (string) theme_page_meta( $page_id, 'careers_col_right_heading', '応募時のチェックリスト' );
	$careers_roles_heading     = (string) theme_page_meta(
		$page_id,
		'careers_roles_heading',
		'募集職種・追加情報（本文編集領域）'
	);

	$left_items  = array(
		(string) theme_page_meta( $page_id, 'careers_col_left_item_1', 'リモート＋出社のハイブリッド（チーム協議により調整）' ),
		(string) theme_page_meta( $page_id, 'careers_col_left_item_2', '社会・健康保険、労働環境での安全衛生教育の実施' ),
		(string) theme_page_meta( $page_id, 'careers_col_left_item_3', '学会・イベント参加への補助制度（デモ説明文案）' ),
	);
	$right_items = array(
		(string) theme_page_meta( $page_id, 'careers_col_right_item_1', 'ポートフォリオもしくは直近事例の資料' ),
		(string) theme_page_meta( $page_id, 'careers_col_right_item_2', '勤務開始希望／選考での連絡先' ),
		(string) theme_page_meta( $page_id, 'careers_col_right_item_3', '自己紹介（200〜400 文字目安・プレイスホルダー）' ),
	);
	?>
	<article <?php post_class( 'singular_article' ); ?>>

		<header class="page_hero" aria-labelledby="careers-hero-heading">
			<div class="page_hero_inner">
				<p class="page_hero_kicker"><?php echo esc_html( $careers_hero_kicker ); ?></p>
				<h1 id="careers-hero-heading" class="page_hero_title"><?php echo esc_html( get_the_title() ); ?></h1>
				<?php if ( has_excerpt() ) : ?>
					<p class="page_hero_lead"><?php echo esc_html( wp_strip_all_tags( get_the_excerpt() ) ); ?></p>
				<?php else : ?>
					<p class="page_hero_lead"><?php echo nl2br( esc_html( $careers_hero_lead ), false ); ?></p>
				<?php endif; ?>
			</div>
		</header>

		<section class="page_section" aria-labelledby="careers-intro-heading">
			<div class="wrap careers_split">
				<div class="careers_intro">
					<h2 id="careers-intro-heading" class="page_section_heading"><?php echo esc_html( $careers_intro_heading ); ?></h2>
					<div class="lead_emphasis">
						<p><?php echo nl2br( esc_html( $careers_intro_body ), false ); ?></p>
					</div>
				</div>
				<div class="bullet_columns">
					<div class="bullet_block">
						<h3 class="bullet_block_title"><?php echo esc_html( $careers_col_left_heading ); ?></h3>
						<ul class="bullet_block_list entry">
							<?php foreach ( $left_items as $item ) : ?>
								<?php if ( '' !== trim( $item ) ) : ?>
							<li><?php echo esc_html( $item ); ?></li>
								<?php endif; ?>
							<?php endforeach; ?>
						</ul>
					</div>
					<div class="bullet_block">
						<h3 class="bullet_block_title"><?php echo esc_html( $careers_col_right_heading ); ?></h3>
						<ul class="bullet_block_list entry">
							<?php foreach ( $right_items as $item ) : ?>
								<?php if ( '' !== trim( $item ) ) : ?>
							<li><?php echo esc_html( $item ); ?></li>
								<?php endif; ?>
							<?php endforeach; ?>
						</ul>
					</div>
				</div>
			</div>
		</section>

		<section class="section_alt">
			<div class="wrap">
				<h2 class="page_section_heading"><?php echo esc_html( $careers_roles_heading ); ?></h2>
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
