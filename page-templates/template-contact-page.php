<?php
/**
 * Template Name: お問い合わせ（構造化レイアウト）
 * Description: 電話・メール・概要のブロックレイアウト。
 *
 * @package Theme
 */

declare(strict_types=1);

get_header();

$contact_phone_raw = trim( (string) theme_front_meta( 'footer_phone', '072-736-2840' ) );
$contact_email_raw = trim( (string) theme_front_meta( 'footer_email', 'info@sakanoue-sekkei.example' ) );
$digits_phone      = preg_replace( '/[^\d+]/', '', $contact_phone_raw );
if ( '' === $digits_phone ) {
	$digits_phone = preg_replace( '/[^\d+]/', '', '0727362840' );
}
$contact_email_safe = sanitize_email( $contact_email_raw );
if ( '' === $contact_email_safe ) {
	$contact_email_safe = sanitize_email( 'info@sakanoue-sekkei.example' );
}
?>

<section class="singular wrap">
	<?php
	while ( have_posts() ) :
		the_post();
		$page_id = get_the_ID();

		$struct_addr     = trim( (string) theme_page_meta( $page_id, 'contact_struct_address_body', '' ) );
		$contact_address = '' !== $struct_addr
			? $struct_addr
			: trim(
				(string) theme_front_meta(
					'footer_contact_body',
					"〒562-0001 大阪府箕面市小野原東 4-12-1 坂ノ上ビル 3F\n平日 9:30–18:30｜見学会・オンライン相談は事前予約制です"
				)
			);

		$contact_struct_phone_heading   = (string) theme_page_meta( $page_id, 'contact_struct_phone_heading', 'お電話' );
		$contact_struct_phone_hint      = (string) theme_page_meta(
			$page_id,
			'contact_struct_phone_hint',
			'自動音声のみの時間帯を除き、日中に担当が対応します。'
		);
		$contact_struct_mail_heading    = (string) theme_page_meta( $page_id, 'contact_struct_mail_heading', 'メールフォームについて' );
		$contact_struct_mail_body       = (string) theme_page_meta(
			$page_id,
			'contact_struct_mail_body',
			'Contact Form 7 などのプラグインを導入する場合、このブロック直下にショートコードやブロックを追加してください（デモ環境では未接続です）。'
		);
		$contact_struct_address_heading = (string) theme_page_meta( $page_id, 'contact_struct_address_heading', '所在地・受付時間' );
		?>
		<article <?php post_class( 'singular_article singular_article_contact' ); ?>>
			<h1 class="singular_title"><?php echo esc_html( get_the_title() ); ?></h1>

			<div class="contact_intro entry">
				<?php the_content(); ?>
			</div>

			<div class="contact_blocks" aria-label="<?php echo esc_attr__( '連絡方法', THEME_GETTEXT_DOMAIN ); ?>">
				<section class="contact_block">
					<h2 class="contact_block_title"><?php echo esc_html( $contact_struct_phone_heading ); ?></h2>
					<p class="contact_block_body">
						<a class="contact_block_link" href="<?php echo esc_url( 'tel:' . $digits_phone ); ?>">
							<?php echo esc_html( $contact_phone_raw ); ?>
						</a><br>
						<span class="contact_block_hint"><?php echo nl2br( esc_html( $contact_struct_phone_hint ), false ); ?></span>
					</p>
				</section>
				<section class="contact_block">
					<h2 class="contact_block_title"><?php echo esc_html( $contact_struct_mail_heading ); ?></h2>
					<p class="contact_block_body">
						<?php echo nl2br( esc_html( $contact_struct_mail_body ), false ); ?>
					</p>
				</section>
				<section class="contact_block">
					<h2 class="contact_block_title"><?php echo esc_html( $contact_struct_address_heading ); ?></h2>
					<p class="contact_block_body"><?php echo nl2br( esc_html( $contact_address ), false ); ?></p>
					<p class="contact_block_body">
						<a class="contact_block_link" href="<?php echo esc_url( 'mailto:' . $contact_email_safe ); ?>">
							<?php echo esc_html( $contact_email_safe ); ?>
						</a>
					</p>
				</section>
			</div>
		</article>
		<?php
	endwhile;
	?>
</section>

<?php
get_footer();
