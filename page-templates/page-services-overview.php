<?php
/**
 * サービス一覧（概要カードグリッド）。
 *
 * Template Name: サービス一覧（概要）
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

	$sv_kicker       = (string) theme_page_meta( $page_id, 'sv_overview_hero_kicker', 'Services overview' );
	$sv_lead         = (string) theme_page_meta(
		$page_id,
		'sv_overview_hero_lead',
		'一覧性を優先したカードグリッドです。「サービス」テンプレより粒度を荒くし、 LP や資料への誘導を想定したダミー構成にしています。'
	);
	$sv_grid_heading = (string) theme_page_meta( $page_id, 'sv_overview_grid_heading', 'サービスカード（静的ダミー）' );

	$cards = array(
		array(
			'kicker' => (string) theme_page_meta( $page_id, 'sv_overview_card_1_kicker', 'Consult' ),
			'title'  => (string) theme_page_meta( $page_id, 'sv_overview_card_1_title', '計画コンサルティング' ),
			'text'   => (string) theme_page_meta(
				$page_id,
				'sv_overview_card_1_text',
				'プロジェクト初期の論点整理、ステークホルダー調整、スケジュールラインのたたき台をご用意します（デモ）。'
			),
			'meta'   => (string) theme_page_meta( $page_id, 'sv_overview_card_1_meta', '期間の目安：2〜8 週' ),
		),
		array(
			'kicker' => (string) theme_page_meta( $page_id, 'sv_overview_card_2_kicker', 'Design' ),
			'title'  => (string) theme_page_meta( $page_id, 'sv_overview_card_2_title', '設計・監理' ),
			'text'   => (string) theme_page_meta(
				$page_id,
				'sv_overview_card_2_text',
				'基本〜実施設計、工事監理までの一連業務をワンストップで記載する例です。実際の許認可関与範囲は脚注で補足できます。'
			),
			'meta'   => (string) theme_page_meta( $page_id, 'sv_overview_card_2_meta', '対応：新築／増改築（例）' ),
		),
		array(
			'kicker' => (string) theme_page_meta( $page_id, 'sv_overview_card_3_kicker', 'Workshop' ),
			'title'  => (string) theme_page_meta( $page_id, 'sv_overview_card_3_title', '参加型ワークショップ' ),
			'text'   => (string) theme_page_meta(
				$page_id,
				'sv_overview_card_3_text',
				'模型や写真を用いた短時間セッションで、方向性の早期共有を狙うサービスカードのダミー文言です。'
			),
			'meta'   => (string) theme_page_meta( $page_id, 'sv_overview_card_3_meta', '開催形式：オンサイト／オンライン' ),
		),
		array(
			'kicker' => (string) theme_page_meta( $page_id, 'sv_overview_card_4_kicker', 'Aftercare' ),
			'title'  => (string) theme_page_meta( $page_id, 'sv_overview_card_4_title', '竣工後フォロー' ),
			'text'   => (string) theme_page_meta(
				$page_id,
				'sv_overview_card_4_text',
				'定期点検プランや簡易リニューアル相談など、運用フェーズに寄り添う行を別カードとして提示できます。'
			),
			'meta'   => (string) theme_page_meta( $page_id, 'sv_overview_card_4_meta', '契約プラン別（ダミー）' ),
		),
		array(
			'kicker' => (string) theme_page_meta( $page_id, 'sv_overview_card_5_kicker', 'Partners' ),
			'title'  => (string) theme_page_meta( $page_id, 'sv_overview_card_5_title', '協働ネットワーク' ),
			'text'   => (string) theme_page_meta(
				$page_id,
				'sv_overview_card_5_text',
				'構造・設備・植栽など、パートナー事務所との連携体制を一覧で見せるカードのサンプルです。'
			),
			'meta'   => (string) theme_page_meta( $page_id, 'sv_overview_card_5_meta', 'ご紹介は個別にお問い合わせ' ),
		),
		array(
			'kicker' => (string) theme_page_meta( $page_id, 'sv_overview_card_6_kicker', 'Contact' ),
			'title'  => (string) theme_page_meta( $page_id, 'sv_overview_card_6_title', 'お問い合わせ・資料請求' ),
			'text'   => (string) theme_page_meta(
				$page_id,
				'sv_overview_card_6_text',
				'詳細ページへ誘導するクロージング用カードとしても利用できます。リンクはメニューやボタンブロックで後から追加してください。'
			),
			'meta'   => (string) theme_page_meta( $page_id, 'sv_overview_card_6_meta', 'メール／電話／フォーム' ),
		),
	);
	?>
	<article <?php post_class( 'singular_article' ); ?>>

		<header class="page_hero" aria-labelledby="services-overview-hero-heading">
			<div class="page_hero_inner">
				<p class="page_hero_kicker"><?php echo esc_html( $sv_kicker ); ?></p>
				<h1 id="services-overview-hero-heading" class="page_hero_title"><?php echo esc_html( get_the_title() ); ?></h1>
				<?php if ( has_excerpt() ) : ?>
					<p class="page_hero_lead"><?php echo esc_html( wp_strip_all_tags( get_the_excerpt() ) ); ?></p>
				<?php else : ?>
					<p class="page_hero_lead"><?php echo nl2br( esc_html( $sv_lead ), false ); ?></p>
				<?php endif; ?>
			</div>
		</header>

		<section class="page_section" aria-labelledby="services-overview-grid-heading">
			<div class="wrap">
				<h2 id="services-overview-grid-heading" class="page_section_heading"><?php echo esc_html( $sv_grid_heading ); ?></h2>
				<div class="tpl_services_overview_grid">
					<?php foreach ( $cards as $card ) : ?>
						<?php if ( '' === trim( $card['title'] . $card['text'] ) ) : ?>
							<?php continue; ?>
						<?php endif; ?>
					<article class="tpl_services_overview_card">
						<p class="tpl_services_overview_card_kicker"><?php echo esc_html( $card['kicker'] ); ?></p>
						<h3 class="tpl_services_overview_card_title"><?php echo esc_html( $card['title'] ); ?></h3>
						<p class="tpl_services_overview_card_text"><?php echo nl2br( esc_html( $card['text'] ), false ); ?></p>
						<p class="tpl_services_overview_card_meta"><?php echo esc_html( $card['meta'] ); ?></p>
					</article>
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
