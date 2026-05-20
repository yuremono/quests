<?php
/**
 * Blog posts index (投稿ページの URL)。front-page.php が無い環境で「最新の投稿」が
 * ホームのときはフロントと同じレイアウトを読み込む。
 *
 * @package Theme
 */

declare(strict_types=1);

if ( is_front_page() ) {
	require get_template_directory() . '/front-page.php';
	return;
}

get_header();

$posts_page_id = (int) get_option( 'page_for_posts' );
$archive_title = $posts_page_id > 0
	? get_the_title( $posts_page_id )
	: __( '最新の投稿', THEME_GETTEXT_DOMAIN );
?>

<section class="archive wrap">
	<h1 class="archive_title"><?php echo esc_html( is_string( $archive_title ) ? $archive_title : (string) $archive_title ); ?></h1>
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
		<p class="archive_empty"><?php esc_html_e( '投稿はまだありません。', THEME_GETTEXT_DOMAIN ); ?></p>
	<?php endif; ?>
</section>

<?php
get_footer();
