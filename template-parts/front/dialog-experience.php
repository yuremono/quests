<?php
/**
 * Experience Details dialog (Next.tsx DialogFull + Cards).
 *
 * @package Theme
 */

declare(strict_types=1);

$dialog_kicker  = (string) theme_portfolio_meta( 'pf_exp_dialog_kicker', 'Details' );
$dialog_heading = (string) theme_portfolio_meta( 'pf_exp_dialog_heading', 'Experience and Dependencies' );
$dialog_lead    = (string) theme_portfolio_meta( 'pf_exp_dialog_lead', '経験とAI依存の詳細。' );
$dialog_body    = (string) theme_portfolio_meta( 'pf_exp_dialog_body', '' );
?>
<dialog id="experience-dialog" aria-label="<?php echo esc_attr( $dialog_heading ); ?>" aria-modal="true" class="min-h-lvh w-screen max-w-none overflow-y-auto overscroll-none bg-BC/90 outline-none">
	<article class="py-[--PX] into">
		<button type="button" class="textlink DS shrink-0 text-AC fixed top-[--PX] right-[--into] p-2" data-dialog-close aria-label="<?php echo esc_attr( $dialog_heading . 'を閉じる' ); ?>">Close<?php echo theme_phosphor_icon( 'x', array( 'class' => '[--btnIFZ:1.25em]' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></button>
		<header class="flex items-start justify-between gap BorderB pb-4">
			<div>
				<p class="text-sm font-bold text-AC"><?php echo esc_html( $dialog_kicker ); ?></p>
				<h2 class="font-medium text-GR"><?php echo esc_html( $dialog_heading ); ?></h2>
				<p class="mt-2 leading-[--LH]"><?php echo esc_html( $dialog_lead ); ?></p>
			</div>
		</header>
		<section class="mt-8" aria-label="<?php echo esc_attr( $dialog_heading ); ?>">
			<?php if ( '' !== $dialog_body ) : ?>
				<?php echo wp_kses( $dialog_body, theme_portfolio_kses_allowed_html() ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			<?php else : ?>
				<?php get_template_part( 'template-parts/front/dialog-experience', 'cards' ); ?>
			<?php endif; ?>
		</section>
	</article>
</dialog>
