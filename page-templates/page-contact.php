<?php
/**
 * Optional layout for contact / inquiry page.
 *
 * Template Name: お問い合わせ
 *
 * @package Theme
 */

declare(strict_types=1);

get_header();

$contact_phone_raw = trim( (string) theme_front_meta( 'footer_phone', '072-736-2840' ) );
$digits_phone      = preg_replace( '/[^\d+]/', '', $contact_phone_raw );
if ( '' === $digits_phone ) {
	$digits_phone = '0727362840';
}

$contact_email_raw = trim( (string) theme_front_meta( 'footer_email', 'info@sakanoue-sekkei.example' ) );
$contact_email_ok  = sanitize_email( $contact_email_raw );
if ( '' === $contact_email_ok ) {
	$contact_email_ok = sanitize_email( 'info@sakanoue-sekkei.example' );
}
?>

<div class="page_main">
<?php
while ( have_posts() ) :
	the_post();
	$page_id = get_the_ID();

	$contact_hero_kicker    = (string) theme_page_meta( $page_id, 'contact_hero_kicker', 'Contact' );
	$contact_hero_lead      = (string) theme_page_meta(
		$page_id,
		'contact_hero_lead',
		'ご質問・ご相談は電話またはメールにてご連絡ください。入力フォームをお使いの際は、この下のご案内に沿って本文ブロックまたはショートコードをご利用いただけます。'
	);
	$contact_summary        = (string) theme_page_meta(
		$page_id,
		'contact_summary',
		'内容を確認のうえ担当より折り返しご連絡します。自動音声のみの時間帯を除き、日中は担当が対応する想定です。'
	);
	$contact_phone_heading  = (string) theme_page_meta( $page_id, 'contact_phone_heading', 'お電話' );
	$contact_phone_note     = (string) theme_page_meta(
		$page_id,
		'contact_phone_note',
		'平日のご案内時間帯のみ担当が対応いたします（例示文言）。'
	);
	$contact_mail_heading   = (string) theme_page_meta( $page_id, 'contact_mail_heading', 'メール' );
	$contact_mail_note      = (string) theme_page_meta(
		$page_id,
		'contact_mail_note',
		'折り返しまでに時間を要する場合があります。'
	);
	$contact_form_heading   = (string) theme_page_meta( $page_id, 'contact_form_heading', 'フォームでのお問い合わせ' );
	$contact_form_note      = (string) theme_page_meta(
		$page_id,
		'contact_form_note',
		'Contact Form 7 などのプラグインを導入する場合、この下のページ本文にショートコードやフォームブロックを追加してください。'
	);
	$contact_bottom_heading = (string) theme_page_meta( $page_id, 'contact_bottom_heading', '本文・詳細でのご案内' );
	?>
	<article <?php post_class( 'singular_article' ); ?>>

		<header class="page_hero" aria-labelledby="contact-hero-heading">
			<div class="page_hero_inner">
				<p class="page_hero_kicker"><?php echo esc_html( $contact_hero_kicker ); ?></p>
				<h1 id="contact-hero-heading" class="page_hero_title"><?php echo esc_html( get_the_title() ); ?></h1>
				<?php if ( has_excerpt() ) : ?>
					<p class="page_hero_lead"><?php echo esc_html( wp_strip_all_tags( get_the_excerpt() ) ); ?></p>
				<?php else : ?>
					<p class="page_hero_lead"><?php echo nl2br( esc_html( $contact_hero_lead ), false ); ?></p>
				<?php endif; ?>
			</div>
		</header>

		<div class="wrap">
			<p class="page_contact_summary entry">
				<?php echo nl2br( esc_html( $contact_summary ), false ); ?>
			</p>
		</div>

		<div class="page_contact_channels wrap">
			<section class="page_contact_section" aria-labelledby="page-contact-tel-heading">
				<h2 id="page-contact-tel-heading" class="page_contact_heading">
					<?php echo esc_html( $contact_phone_heading ); ?>
				</h2>
				<p class="page_contact_line">
					<a class="footer_link" href="<?php echo esc_url( 'tel:' . $digits_phone ); ?>">
						<?php echo esc_html( $contact_phone_raw ); ?>
					</a>
				</p>
				<p class="page_contact_note">
					<?php echo nl2br( esc_html( $contact_phone_note ), false ); ?>
				</p>
			</section>

			<section class="page_contact_section" aria-labelledby="page-contact-mail-heading">
				<h2 id="page-contact-mail-heading" class="page_contact_heading">
					<?php echo esc_html( $contact_mail_heading ); ?>
				</h2>
				<p class="page_contact_line">
					<a class="footer_link" href="<?php echo esc_url( 'mailto:' . $contact_email_ok ); ?>">
						<?php echo esc_html( $contact_email_ok ); ?>
					</a>
				</p>
				<p class="page_contact_note">
					<?php echo nl2br( esc_html( $contact_mail_note ), false ); ?>
				</p>
			</section>

			<section class="page_contact_section" aria-labelledby="page-contact-form-heading">
				<h2 id="page-contact-form-heading" class="page_contact_heading">
					<?php echo esc_html( $contact_form_heading ); ?>
				</h2>
				<p class="page_contact_note">
					<?php echo nl2br( esc_html( $contact_form_note ), false ); ?>
				</p>
			</section>
		</div>

		<section class="page_contact_bottom wrap" aria-label="<?php echo esc_attr__( '追加の本文・アンカー情報', THEME_GETTEXT_DOMAIN ); ?>">
			<h2 class="page_contact_bottom_title"><?php echo esc_html( $contact_bottom_heading ); ?></h2>
			<div class="entry-content entry">
				<?php the_content(); ?>
			</div>
		</section>

	</article>
	<?php
endwhile;
?>
</div>

<?php
get_footer();
