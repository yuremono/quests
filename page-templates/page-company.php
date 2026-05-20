<?php
/**
 * 会社概要向けレイアウト。
 *
 * Template Name: 会社概要
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

	$company_hero_kicker      = (string) theme_page_meta( $page_id, 'company_hero_kicker', 'Company profile' );
	$company_hero_lead        = (string) theme_page_meta(
		$page_id,
		'company_hero_lead',
		'理念・沿革・概要を一覧できるコーポレート向けのレイアウトです。ヒーロー下の項目は編集画面の抜粋で差し替えられます。'
	);
	$company_overview_heading = (string) theme_page_meta( $page_id, 'company_overview_heading', '会社概要' );
	$company_trade_name       = trim( (string) theme_page_meta( $page_id, 'company_trade_name', '' ) );
	$company_trade_display    = '' !== $company_trade_name ? $company_trade_name : theme_brand();

	$acf_addr   = trim( (string) theme_page_meta( $page_id, 'company_address', '' ) );
	$front_addr = wp_strip_all_tags( (string) theme_front_meta( 'footer_contact_body', '' ) );
	$addr_fb    = (string) theme_page_meta(
		$page_id,
		'company_address_fallback',
		'〒000-0000 サンプルの所在地／フロント設定の説明文と統一できます'
	);
	if ( '' !== $acf_addr ) {
		$raw_address = $acf_addr;
	} elseif ( '' !== $front_addr ) {
		$raw_address = $front_addr;
	} else {
		$raw_address = $addr_fb;
	}

	$company_message_heading = (string) theme_page_meta( $page_id, 'company_message_heading', '代表メッセージ' );
	$company_message_label   = (string) theme_page_meta( $page_id, 'company_message_label', '代表取締役 ─' );
	$company_message_body    = (string) theme_page_meta(
		$page_id,
		'company_message_body',
		'デモ構成では代表挨拶のプレースホルダーを表示しています。実運用ではここを本文側のページ冒頭へ移したり、この枠のみ固定で残す運用にもできます。お客様の課題に寄り添う姿勢を一言で伝えましょう。'
	);

	$company_history_heading = (string) theme_page_meta( $page_id, 'company_history_heading', '沿革' );
	$hist                    = array(
		array(
			'year' => (string) theme_page_meta( $page_id, 'company_history_1_year', '2009' ),
			'text' => (string) theme_page_meta( $page_id, 'company_history_1_text', '創業／地域に根ざした設計コンサルの立ち上げ' ),
		),
		array(
			'year' => (string) theme_page_meta( $page_id, 'company_history_2_year', '2016' ),
			'text' => (string) theme_page_meta( $page_id, 'company_history_2_text', '業務提携の拡大・ワークショップ型サービスの整備' ),
		),
		array(
			'year' => (string) theme_page_meta( $page_id, 'company_history_3_year', '現在' ),
			'text' => (string) theme_page_meta( $page_id, 'company_history_3_text', '住宅・複合プロジェクト両面での設計監修を実施（例示）' ),
		),
	);
	?>
	<article <?php post_class( 'singular_article' ); ?>>

		<header class="page_hero" aria-labelledby="company-hero-heading">
			<div class="page_hero_inner">
				<p class="page_hero_kicker"><?php echo esc_html( $company_hero_kicker ); ?></p>
				<h1 id="company-hero-heading" class="page_hero_title"><?php echo esc_html( get_the_title() ); ?></h1>
				<?php if ( has_excerpt() ) : ?>
					<p class="page_hero_lead"><?php echo esc_html( wp_strip_all_tags( get_the_excerpt() ) ); ?></p>
				<?php else : ?>
					<p class="page_hero_lead"><?php echo nl2br( esc_html( $company_hero_lead ), false ); ?></p>
				<?php endif; ?>
			</div>
		</header>

		<section class="section_alt" aria-labelledby="company-overview-heading">
			<div class="wrap">
				<h2 id="company-overview-heading" class="page_section_heading"><?php echo esc_html( $company_overview_heading ); ?></h2>
					<dl class="content_cols_outline">
						<dt class="content_cols_outline_term"><?php esc_html_e( '商号', THEME_GETTEXT_DOMAIN ); ?></dt>
						<dd class="content_cols_outline_def"><?php echo esc_html( $company_trade_display ); ?></dd>
						<dt class="content_cols_outline_term"><?php esc_html_e( '所在地', THEME_GETTEXT_DOMAIN ); ?></dt>
						<dd class="content_cols_outline_def">
							<?php echo nl2br( esc_html( wp_strip_all_tags( $raw_address ) ), false ); ?>
						</dd>
						<dt class="content_cols_outline_term"><?php esc_html_e( '連絡先', THEME_GETTEXT_DOMAIN ); ?></dt>
						<dd class="content_cols_outline_def">
							<?php
							$company_phone    = trim( (string) theme_front_meta( 'footer_phone', '072-736-2840' ) );
							$digits_phone_cmp = preg_replace( '/[^\d+]/', '', $company_phone );
							if ( '' === $digits_phone_cmp ) {
								$digits_phone_cmp = '0727362840';
							}
							$company_email    = trim( (string) theme_front_meta( 'footer_email', 'info@sakanoue-sekkei.example' ) );
							$company_email_ok = sanitize_email( $company_email );
							if ( '' === $company_email_ok ) {
								$company_email_ok = sanitize_email( 'info@sakanoue-sekkei.example' );
							}
							?>
							<a class="footer_link" href="<?php echo esc_url( 'tel:' . $digits_phone_cmp ); ?>">
								<?php echo esc_html( $company_phone ); ?>
							</a><br>
							<a class="footer_link" href="<?php echo esc_url( 'mailto:' . $company_email_ok ); ?>">
								<?php echo esc_html( $company_email_ok ); ?>
							</a>
						</dd>
					</dl>
			</div>
		</section>

		<section class="page_section" aria-labelledby="company-message-heading">
			<div class="wrap">
				<h2 id="company-message-heading" class="page_section_heading"><?php echo esc_html( $company_message_heading ); ?></h2>
				<div class="lead_emphasis">
					<span class="lead_emphasis_label"><?php echo esc_html( $company_message_label ); ?></span>
					<p><?php echo nl2br( esc_html( $company_message_body ), false ); ?></p>
				</div>
			</div>
		</section>

		<section class="section_alt" aria-labelledby="company-history-heading">
			<div class="wrap">
				<h2 id="company-history-heading" class="page_section_heading"><?php echo esc_html( $company_history_heading ); ?></h2>
				<ol class="timeline">
					<?php foreach ( $hist as $row ) : ?>
						<?php if ( '' === trim( $row['year'] . $row['text'] ) ) : ?>
							<?php continue; ?>
						<?php endif; ?>
					<li class="timeline_item">
						<p class="timeline_year"><?php echo esc_html( $row['year'] ); ?></p>
						<p class="timeline_desc"><?php echo nl2br( esc_html( $row['text'] ), false ); ?></p>
					</li>
					<?php endforeach; ?>
				</ol>
			</div>
		</section>

		<section class="page_section" aria-label="<?php echo esc_attr__( '本文・アーカイブ用ブロック', THEME_GETTEXT_DOMAIN ); ?>">
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
