<?php
/**
 * Quests page header.
 *
 * @package Theme
 */

declare( strict_types=1 );

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<header id="global_header">
<div id="header" class="h">
		<div class="h_inner">
			<a class="h_logo  h_logotext sawa" href="#" style="color: var(--tx);background-color: var(--un);">
				Page<br>Logo
			</a>
			<button class="h_menu menu_toggle dots" aria-expanded="false" aria-controls="nav">
				<span class="bar2"></span><span class="bar2 tate"></span><span class="dot1"></span><span class="dot2"></span><span class="dot3"></span>
			</button>
			<div class="h_items ">
				<a class="btn LINE" style="background: #05c554;border-radius: 1vmin" href="#"><img class="h_logoimg" src="<?php echo esc_url( theme_quests_source_uri( 'images/home/line-logo.png' ) ); ?>" alt="">CONTACT</a>
			</div>
			<nav class="h_nav " id="nav">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'primary',
						'container'      => false,
						'fallback_cb'    => 'theme_quests_primary_menu_fallback',
						'items_wrap'     => '<ul>%3$s</ul>',
					)
				);
				?>
				<div class="focus_trap menu_toggle" tabindex="0"></div>
			</nav>
		</div>
	</div>
	<!-- #global_header --></header>
