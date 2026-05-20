<?php
/**
 * Portfolio front page (Next.tsx).
 *
 * @package Theme
 */

declare(strict_types=1);

get_header();
?>

<div class="PageRoot [--innerPX:--PX] [--Eng:--Jost] [--San:--Zen] [--h3FZ:1.5em] [--dropBG:--WH] [--dropC:--TC] [--WTS:var(--tsw)_var(--TC30)]" data-portfolio-page>
	<?php get_template_part( 'template-parts/front/chrome' ); ?>

	<main id="primary" class="site-main min-h-screen">
		<?php
		get_template_part( 'template-parts/front/section', 'hero-mindmap' );
		get_template_part( 'template-parts/front/section', 'scroll-x' );
		get_template_part( 'template-parts/front/section', 'bunmyaku-teaser' );
		get_template_part( 'template-parts/front/section', 'repulsion-lists' );
		get_template_part( 'template-parts/front/section', 'hidden' );
		?>
	</main>

	<?php get_template_part( 'template-parts/front/footer', 'portfolio' ); ?>
</div>

<?php
get_footer();
