<?php
/**
 * Portfolio footer (Footer.tsx).
 *
 * @package Theme
 */

declare(strict_types=1);

$footer_name      = (string) theme_portfolio_meta( 'pf_footer_name', 'Yano Seiji' );
$footer_hobby     = (string) theme_portfolio_meta( 'pf_footer_hobby', "Manga I love\nAnime I love\nLight Novel I love\nMusic I love" );
$footer_specialty = (string) theme_portfolio_meta( 'pf_footer_specialty', "CSS Styling\nContext Engineering" );
$footer_brand     = (string) theme_portfolio_meta( 'pf_footer_brand', 'yuremono works' );
?>
<footer class="Eng Wrap into bg-[--foreground] text-[--background] bg-no-repeat bg-contain bg-left-bottom">
	<div class="DescList IsCenter">
		<div>
			<dl>
				<dt>Name</dt>
				<dd><?php echo esc_html( $footer_name ); ?></dd>
				<dt>Hobby</dt>
				<dd><?php echo wp_kses_post( nl2br( esc_html( $footer_hobby ), false ) ); ?></dd>
				<dt>Specialty</dt>
				<dd><?php echo wp_kses_post( nl2br( esc_html( $footer_specialty ), false ) ); ?></dd>
			</dl>
		</div>
	</div>
	<div class="text-center">
		<p class="mb-0 text-[length:var(--logoFZ)]"><?php echo esc_html( $footer_brand ); ?></p>
		<?php
		wp_nav_menu(
			array(
				'theme_location' => 'footer',
				'container'      => false,
				'menu_class'     => 'flex flex-wrap gap md:justify-center mt-6',
				'fallback_cb'    => 'theme_portfolio_footer_fallback_menu',
				'depth'          => 1,
			)
		);
		?>
	</div>
</footer>
