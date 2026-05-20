<?php
/**
 * News archive (post type news).
 *
 * @package Theme
 */

declare(strict_types=1);

get_header();
?>

<section class="archive wrap">
	<h1 class="archive_title"><?php esc_html_e( 'お知らせ一覧', THEME_GETTEXT_DOMAIN ); ?></h1>
	<?php if ( have_posts() ) : ?>
		<ul class="news_list">
			<?php
			while ( have_posts() ) :
				the_post();
				?>
				<li class="news_list_item">
					<p class="news_meta">
						<time class="news_meta_time" datetime="<?php echo esc_attr( get_the_date( DATE_W3C ) ); ?>">
							<?php echo esc_html( get_the_date() ); ?>
						</time>
					</p>
					<a class="news_list_link" href="<?php echo esc_url( get_permalink() ); ?>">
						<?php echo esc_html( get_the_title() ); ?>
					</a>
				</li>
				<?php
			endwhile;
			?>
		</ul>
		<?php the_posts_navigation(); ?>
	<?php else : ?>
		<p class="archive_empty"><?php esc_html_e( 'まだお知らせがありません。', THEME_GETTEXT_DOMAIN ); ?></p>
	<?php endif; ?>
</section>

<?php
get_footer();
