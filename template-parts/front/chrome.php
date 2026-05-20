<?php
/**
 * Page chrome（ブラウザ UI 枠）: HeaderCylinder, pagetop, theme toggle.
 * Ported from Next.tsx (HeaderCylinder, HeaderPagetop, ThemeToggle).
 *
 * @package Theme
 */

declare(strict_types=1);
?>
<header id="Header" class="Header HeaderCylinder" data-nav-open="false">
	<div class="HeaderInner ">
		<button type="button" class="HeaderLogo HeaderCylinderLogo" aria-expanded="false" aria-controls="HeaderNav" aria-label="Open menu" data-menu-toggle>
			<div class="LogoCylinder" aria-hidden="true"></div>
			<span class="HeaderAnotation WTS text-[--BC] ">
				<span>Tap or Click</span>
				<span>Open Menu</span>
			</span>
		</button>
		<nav class="HeaderNav" id="HeaderNav" role="navigation" aria-label="main navigation" aria-hidden="true" inert>
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'primary',
					'container'      => false,
					'menu_class'     => 'NavUl',
					'fallback_cb'    => 'theme_header_nav_fallback_menu',
					'walker'         => new Theme_Header_Nav_Walker(),
				)
			);
			?>
			<div class="FocusTrap MenuToggle" tabindex="0"></div>
		</nav>
	</div>
</header>

<div class="HeaderPagetop mix-blend-difference text-WH">
	<a href="#" aria-label="Page top"><?php echo theme_phosphor_icon( 'caret-up' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></a>
</div>
<button type="button" class="ThemeToggle mix-blend-difference text-WH" aria-label="Toggle dark mode" data-theme-toggle>
	<?php echo theme_phosphor_icon( 'moon', array( 'class' => 'theme_icon theme_icon_moon' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
	<?php echo theme_phosphor_icon( 'sun', array( 'class' => 'theme_icon theme_icon_sun hidden' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
</button>
