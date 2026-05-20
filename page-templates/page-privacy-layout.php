<?php
/**
 * プライバシーポリシー向け：TOC 付き読みやすいレイアウト。
 *
 * Template Name: プライバシーポリシー（レイアウト）
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

	$privacy_hero_kicker    = (string) theme_page_meta( $page_id, 'privacy_hero_kicker', 'Privacy policy' );
	$privacy_hero_lead      = (string) theme_page_meta(
		$page_id,
		'privacy_hero_lead',
		'左（広い画面ではサイド）のナビから章へジャンプできます。エディタ側で追加した見出しとは別に、この枠は静的ガイドとして残せます。'
	);
	$privacy_body_heading   = (string) theme_page_meta( $page_id, 'privacy_body_heading', '規約本文' );
	$privacy_toc_title      = (string) theme_page_meta( $page_id, 'privacy_toc_title', '目次' );
	$privacy_editor_heading = (string) theme_page_meta( $page_id, 'privacy_editor_heading', 'エディタからの追加ブロック' );

	$privacy_sections = array(
		array(
			'id'    => (string) theme_page_meta( $page_id, 'privacy_section_1_id', 'privacy-about' ),
			'title' => (string) theme_page_meta( $page_id, 'privacy_section_1_title', 'はじめに' ),
			'text'  => (string) theme_page_meta(
				$page_id,
				'privacy_section_1_text',
				'本ページは個人情報の取り扱いについて告知するためのレイアウトデモです。実運用では法令および貴社ポリシーに沿って全文を差し替えてください。'
			),
		),
		array(
			'id'    => (string) theme_page_meta( $page_id, 'privacy_section_2_id', 'privacy-scope' ),
			'title' => (string) theme_page_meta( $page_id, 'privacy_section_2_title', '適用範囲' ),
			'text'  => (string) theme_page_meta(
				$page_id,
				'privacy_section_2_text',
				'ウェブサイト経由で取得する情報、対面・電話・メールで取得する情報など、収集チャネルごとに適用範囲を定義します（プレースホルダー）。'
			),
		),
		array(
			'id'    => (string) theme_page_meta( $page_id, 'privacy_section_3_id', 'privacy-purpose' ),
			'title' => (string) theme_page_meta( $page_id, 'privacy_section_3_title', '利用目的' ),
			'text'  => (string) theme_page_meta(
				$page_id,
				'privacy_section_3_text',
				'問い合わせ対応、資料送付、サービス向上のための分析など、目的別に列挙します。第三者提供の有無もこの付近で明示します（ダミー）。'
			),
		),
		array(
			'id'    => (string) theme_page_meta( $page_id, 'privacy_section_4_id', 'privacy-retention' ),
			'title' => (string) theme_page_meta( $page_id, 'privacy_section_4_title', '保管期間と安全管理' ),
			'text'  => (string) theme_page_meta(
				$page_id,
				'privacy_section_4_text',
				'法令で定める保存期間、アクセス権限、委託先の監督などを段落で説明するブロックの見本文言です。'
			),
		),
		array(
			'id'    => (string) theme_page_meta( $page_id, 'privacy_section_5_id', 'privacy-rights' ),
			'title' => (string) theme_page_meta( $page_id, 'privacy_section_5_title', '開示・訂正・削除の請求' ),
			'text'  => (string) theme_page_meta(
				$page_id,
				'privacy_section_5_text',
				'手続き方法、応答目安、認証に必要な情報などを記載するセクションのスターターテキストです。'
			),
		),
		array(
			'id'    => (string) theme_page_meta( $page_id, 'privacy_section_6_id', 'privacy-contact' ),
			'title' => (string) theme_page_meta( $page_id, 'privacy_section_6_title', 'お問い合わせ窓口' ),
			'text'  => (string) theme_page_meta(
				$page_id,
				'privacy_section_6_text',
				'個人情報保護管理者／連絡先メール・電話などを記載します。会社概要ページと表記を揃えると運用が楽になります（例）。'
			),
		),
	);
	?>
	<article <?php post_class( 'singular_article' ); ?>>

		<header class="page_hero" aria-labelledby="privacy-hero-heading">
			<div class="page_hero_inner">
				<p class="page_hero_kicker"><?php echo esc_html( $privacy_hero_kicker ); ?></p>
				<h1 id="privacy-hero-heading" class="page_hero_title"><?php echo esc_html( get_the_title() ); ?></h1>
				<?php if ( has_excerpt() ) : ?>
					<p class="page_hero_lead"><?php echo esc_html( wp_strip_all_tags( get_the_excerpt() ) ); ?></p>
				<?php else : ?>
					<p class="page_hero_lead"><?php echo nl2br( esc_html( $privacy_hero_lead ), false ); ?></p>
				<?php endif; ?>
			</div>
		</header>

		<section class="page_section" aria-labelledby="privacy-body-heading">
			<div class="wrap">
				<h2 id="privacy-body-heading" class="page_section_heading"><?php echo esc_html( $privacy_body_heading ); ?></h2>
				<div class="page_shell_privacy">
					<aside class="tpl_privacy_toc" aria-label="<?php echo esc_attr__( 'ページ内ナビゲーション', THEME_GETTEXT_DOMAIN ); ?>">
						<p class="tpl_privacy_toc_title"><?php echo esc_html( $privacy_toc_title ); ?></p>
						<ul class="tpl_privacy_toc_list">
							<?php foreach ( $privacy_sections as $privacy_section ) : ?>
								<?php
								$sec_id = sanitize_title( $privacy_section['id'] );
								if ( '' === $sec_id ) {
									continue;
								}
								?>
								<li>
									<a class="tpl_privacy_toc_link" href="#<?php echo esc_attr( $sec_id ); ?>">
										<?php echo esc_html( $privacy_section['title'] ); ?>
									</a>
								</li>
							<?php endforeach; ?>
						</ul>
					</aside>
					<div class="tpl_privacy_main">
						<?php foreach ( $privacy_sections as $privacy_section ) : ?>
							<?php
							$sec_id = sanitize_title( $privacy_section['id'] );
							if ( '' === $sec_id ) {
								continue;
							}
							?>
							<section class="tpl_privacy_section" id="<?php echo esc_attr( $sec_id ); ?>">
								<h3 class="tpl_privacy_section_title"><?php echo esc_html( $privacy_section['title'] ); ?></h3>
								<p class="tpl_privacy_section_text"><?php echo nl2br( esc_html( $privacy_section['text'] ), false ); ?></p>
							</section>
						<?php endforeach; ?>

						<div class="tpl_privacy_wp_content entry-content entry">
							<h3 class="tpl_privacy_section_title"><?php echo esc_html( $privacy_editor_heading ); ?></h3>
							<?php the_content(); ?>
						</div>
					</div>
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
