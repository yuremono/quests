<?php
/**
 * Repulsion lists module (RepulsionLists.tsx).
 *
 * @package Theme
 */

declare(strict_types=1);

$repulsion_items = theme_front_page_repulsion_items();
$allowed_html    = theme_portfolio_kses_allowed_html();
?>
<div class="repulsion-lists-module mt-[-25lvh] z-10">
	<section class="out px-[calc(var(--into)/3*2)] MY Eng font-light">
		<div id="repulsion-lists-horizontal-scroll-container" class="repulsion-lists-viewport">
			<div id="repulsion-lists-card-container">
				<svg class="repulsion-lists-lines" viewBox="0 0 0 0" preserveAspectRatio="none" data-connection-lines="true" aria-hidden="true"></svg>
				<ul class="repulsion-lists-list" aria-label="Repulsion list">
					<?php foreach ( $repulsion_items as $index => $item ) : ?>
						<?php
							$item_title = (string) ( $item['title'] ?? '' );
							$url        = theme_repulsion_item_url( $item );
							$href       = ! empty( $item['href'] ) ? (string) $item['href'] : '';
							$class      = (string) ( $item['class'] ?? '' );
							$content    = (string) ( $item['content'] ?? '' );
							$jitter     = theme_repulsion_chip_jitter( $index );
							$item_id    = 'repulsion-list-item-' . $index;
						?>
						<li
							data-repulsion-list-chip="true"
							data-repulsion-list-item-id="<?php echo esc_attr( $item_id ); ?>"
							data-jitter-x="<?php echo esc_attr( number_format( $jitter['x'], 2, '.', '' ) ); ?>"
							data-jitter-y="<?php echo esc_attr( number_format( $jitter['y'], 2, '.', '' ) ); ?>"
							data-state="idle"
							class="repulsion-list-chip relative list-none bg-WH <?php echo esc_attr( $class ); ?>"
							style="transform: translate(<?php echo esc_attr( number_format( $jitter['x'] * 10, 2, '.', '' ) ); ?>px, <?php echo esc_attr( number_format( $jitter['y'] * 0, 2, '.', '' ) ); ?>px);"
						>
							<div class="repulsion-list-chip-control">
								<?php if ( '' !== $url ) : ?>
									<a
										href="<?php echo esc_url( $url ); ?>"
										<?php echo '' !== $href ? ' target="_blank" rel="noopener noreferrer"' : ''; ?>
									>
										<div class="repulsion-list-chip-content [font-size:clamp(2rem,_5vw,_5rem)] font-light">
												<span class="repulsion-list-chip-label block mx-auto p-4 whitespace-nowrap text-center bg-[repultion-list-light]"><?php echo esc_html( $item_title ); ?></span>
										</div>
									</a>
								<?php else : ?>
										<span class="font-thin z-10 leading-[1.25em] [font-size:calc(var(--mmFZ)*4.5)]"><?php echo esc_html( $item_title ); ?></span>
								<?php endif; ?>
								<?php if ( '' !== $content ) : ?>
									<div class="repulsion-list-chip-popup">
										<?php echo wp_kses( $content, $allowed_html ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
									</div>
								<?php endif; ?>
							</div>
						</li>
					<?php endforeach; ?>
				</ul>
			</div>
		</div>
	</section>
</div>
