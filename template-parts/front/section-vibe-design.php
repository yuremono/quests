<?php
/**
 * Vibe Design / Burn Your Own Style section (Next.tsx Cards col2).
 *
 * @package Theme
 */

declare(strict_types=1);

$vibe_line_1        = (string) theme_portfolio_meta( 'pf_vibe_line_1', "Vibe\n  Design" );
$vibe_line_2        = (string) theme_portfolio_meta( 'pf_vibe_line_2', 'or' );
$vibe_line_3        = (string) theme_portfolio_meta( 'pf_vibe_line_3', "Vault \nDriven" );
$vibe_ready_heading = (string) theme_portfolio_meta( 'pf_vibe_ready_heading', 'AI Ready' );
$vibe_ready_body    = (string) theme_portfolio_meta( 'pf_vibe_ready_body', '<b>DESIGN.md</b> , <b>画像生成デザイン</b>を基点としたゼロからのページ作成の検証と、<b>自然言語でUIパーツを再利用</b>する為の環境構築を行っています。' );
$vibe_byos_heading  = (string) theme_portfolio_meta( 'pf_vibe_byos_heading', 'Burn Your Own Style' );
$vibe_byos_default  = '<details class="Toggle IsSmall font-normal mt-2">
	<summary class="Eng">Thinking...</summary>
	<div>
		- モデルの学習データに基づくwebデザイン・コーディングは平均的で、振れ幅が大きく、個人の理想とするマークアップ、スタイリングとかけ離れたものになる。<br>
		- 構造=既存クラス、装飾=Tailwindで手直ししやすい状態になるが、無駄な記述が多い。<br>
		考察：モデルのファインチューニングが民主化するまでは「完成品の再利用」を効率化する方が良い
	</div>
</details>';
$vibe_byos_body     = (string) theme_portfolio_meta( 'pf_vibe_byos_body', $vibe_byos_default );
$vibe_repo_url      = (string) theme_portfolio_meta( 'pf_vibe_repo_url', 'https://github.com/yuremono/BurnYourOwnStyle/tree/react' );
$vibe_preview_url   = (string) theme_portfolio_meta( 'pf_vibe_preview_url', '' );
$vibe_bar           = (string) theme_portfolio_meta( 'pf_vibe_bar', 'Typescript PhotoShop Figma Three.js Supabase GSAP' );

if ( '' === $vibe_preview_url ) {
	$vibe_preview_url = home_url( '/preview' );
}
?>
<section class="Cards col2 relative items-center into [--gap:0px]">
	<div class="item PX">
		<div class="text-center">
			<h2 class="font-thin grid content-center md:h-[100lvh]">
				<span class="mindWobble text-left leading-[0.7em] tracking-[-0.0em]" style="font-size: 2.5em;"><?php echo wp_kses_post( nl2br( esc_html( $vibe_line_1 ), false ) ); ?></span>
				<span class="mindWobble text-center leading-[1em] mt-[-0.25em] tracking-[-0.0em] font-normal text-GR/10" style="font-size: 6em;"><?php echo esc_html( $vibe_line_2 ); ?></span>
				<span class="mindWobble text-right leading-[0.57em] tracking-[0.08em]" style="font-size: 2.5em;"><?php echo wp_kses_post( nl2br( esc_html( $vibe_line_3 ), false ) ); ?></span>
			</h2>
		</div>
	</div>
	<div class="item content-center bg-background/80 p-4">
		<div class="leading-[2]">
			<h3 class="text-GR mb-2"><?php echo esc_html( $vibe_ready_heading ); ?></h3>
			<?php echo wp_kses_post( $vibe_ready_body ); ?>
			<h3 class="text-GR mt-10"><?php echo esc_html( $vibe_byos_heading ); ?></h3>
			<?php echo wp_kses( $vibe_byos_body, theme_portfolio_kses_allowed_html() ); ?>
			<div class="flex flex-wrap mt-4">
				<?php if ( '' !== $vibe_repo_url ) : ?>
					<a class="btn mt-[-1px] [--btnW:50%]" href="<?php echo esc_url( $vibe_repo_url ); ?>" target="_blank" rel="noopener noreferrer">Repository&nbsp;<?php echo theme_phosphor_icon( 'arrow-square-out' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></a>
				<?php endif; ?>
				<a class="btn mt-[-1px] ml-[-1px] [--btnW:50%]" href="<?php echo esc_url( $vibe_preview_url ); ?>">Preview</a>
			</div>
		</div>
	</div>
	<p class="bg-GR/70 text-xs md:text-xl absolute z-10 font-thin Eng text-[--WH] min-h-[2.5rem] content-center left-0 bottom-0 w-full text-align-last-justify px-2 md:px-16">
		<?php echo esc_html( $vibe_bar ); ?>
	</p>
</section>
