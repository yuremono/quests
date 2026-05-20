<?php
/**
 * Horizontal scroll section (ScrollXSection.tsx).
 *
 * @package Theme
 */

declare(strict_types=1);
?>
<section class="ScrollX relative mt-0" data-scroll-x>
	<div class="ScrollTrack">
		<?php get_template_part( 'template-parts/front/section', 'experience' ); ?>
		<?php get_template_part( 'template-parts/front/section', 'vibe-design' ); ?>
	</div>
	<div class="ScrollSpacer" aria-hidden="true"></div>
</section>
