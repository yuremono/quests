<?php
/**
 * Generic page template.
 *
 * @package Theme
 */

declare(strict_types=1);

get_header();
?>

<main id="primary" class="site-main page_main">
<?php
while ( have_posts() ) :
	the_post();
	?>
	<section class="singular">
		<article <?php post_class( 'singular_article' ); ?>>

			<header class="page_hero">
				<div class="page_hero_inner">
					<h1 class="page_hero_title"><?php echo esc_html( get_the_title() ); ?></h1>
					<?php if ( has_excerpt() ) : ?>
						<p class="page_hero_lead"><?php echo esc_html( wp_strip_all_tags( get_the_excerpt() ) ); ?></p>
					<?php endif; ?>
				</div>
			</header>

			<div class="wrap page_body_wrap">
				<div class="entry-content entry">
					<?php the_content(); ?>
				</div>
			</div>

		</article>
	</section>
	<?php
endwhile;
?>
</main>

<?php
get_footer();
