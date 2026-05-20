<?php
/**
 * Experience mindMap + Details dialog (Next.tsx ScrollXSection / DialogFull).
 *
 * @package Theme
 */

declare(strict_types=1);

$exp_heading       = (string) theme_portfolio_meta( 'pf_exp_heading', "Experience and\nDependencies" );
$exp_subheading    = (string) theme_portfolio_meta( 'pf_exp_subheading', '経験と依存性' );
$exp_about_heading = (string) theme_portfolio_meta( 'pf_exp_about_heading', 'About This Site' );
$exp_about_body    = (string) theme_portfolio_meta( 'pf_exp_about_body', "個人制作ページ、ツールをまとめています。\nこれまではNextJS CMS、AIチャット共有拡張機能、\nAI前提のweb開発を行なってきました。" );
$exp_bar           = (string) theme_portfolio_meta( 'pf_exp_bar', 'Typescript PhotoShop Figma Three.js Supabase GSAP' );
$exp_nodes         = array();
for ( $i = 1; $i <= 6; $i++ ) {
	$defaults    = array( 'Cursor', 'Claude Code', 'TailwindCSS', 'WebGL', 'Codex', 'Pencil.dev' );
	$exp_nodes[] = (string) theme_portfolio_meta( 'pf_exp_node_' . $i, $defaults[ $i - 1 ] ?? '' );
}
$dialog_heading = (string) theme_portfolio_meta( 'pf_exp_dialog_heading', 'Experience and Dependencies' );
?>
<div class="DialogWrapper">
	<div class="mindMap text-center experience font-thin">
		<h2 class="mm1-3 text-[--GR] font-light text-left tracking-[-0.025em]" style="font-size: 3em;">
			<?php echo wp_kses_post( nl2br( esc_html( $exp_heading ), false ) ); ?>
		</h2>
		<div class="text-base mmPin mmStatic max-w-[calc(var(--wid)/2)] experience_tx text-left San font-light leading-[2em] static lg:absolute left-1/2 top-[--MY] z-10 p-4 bg-background/80">
			<h3 class="text-GR text-[1.25em] inline-block mr-4"><?php echo esc_html( $exp_subheading ); ?></h3>
			<button type="button" class="textlink mt-6" aria-haspopup="dialog" aria-controls="experience-dialog" data-dialog-open="experience-dialog">
				<?php echo esc_html( (string) theme_portfolio_meta( 'pf_exp_dialog_kicker', 'Details' ) ); ?><?php echo theme_phosphor_icon( 'list-plus', array( 'class' => '[--btnIFZ:1.5em] align-text-bottom' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			</button>
			<br>
			<div class="text-left">
				<h3 class="text-GR mt-10 mb-2"><?php echo esc_html( $exp_about_heading ); ?></h3>
				<span class="budoux">
					<?php echo wp_kses_post( nl2br( esc_html( $exp_about_body ), false ) ); ?>
				</span>
			</div>
		</div>
		<?php foreach ( $exp_nodes as $node ) : ?>
			<?php if ( '' !== $node ) : ?>
				<p class="hidden lg:inline-block" style="font-size: <?php echo esc_attr( strlen( $node ) > 10 ? '2em' : '2.5em' ); ?>;"><?php echo esc_html( $node ); ?></p>
			<?php endif; ?>
		<?php endforeach; ?>
		<p class="mmPin bg-GR/70 text-xs md:text-xl absolute z-10 text-[--WH] min-h-[2.5rem] content-center left-0 bottom-0 w-full text-align-last-justify px-2 md:px-16">
			<?php echo esc_html( $exp_bar ); ?>
		</p>
	</div>
	<?php get_template_part( 'template-parts/front/dialog', 'experience' ); ?>
</div>
