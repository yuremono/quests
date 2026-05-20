<?php
/**
 * Bunmyaku teaser section (BunmyakuTeaserSection.tsx).
 *
 * @package Theme
 */

declare(strict_types=1);

$bunmyaku_heading = (string) theme_portfolio_meta( 'pf_bunmyaku_heading', '## 文脈.app' );
$bunmyaku_body    = (string) theme_portfolio_meta(
	'pf_bunmyaku_body',
	'### SPEC.md, DESIGN.md, AGENTS.md をGUIで作成するツール<br><br>DESIGN.mdはフロントエンドの要件定義書と言えます。公開サイトURLから作成するツールが多く出回っており、一定の効率化につながりますが、Sticthの公式テンプレートの情報量でも不十分であり、結局テンプレート出力になります。<br><br>一方ClaudeDesignでは詳細を問いかける設計が従来のAIビルダーとの差別化でありますが、最先端モデルのテンプレートであることに変わりはありません。<br><br>このツールではClaudeやモデル性能に依存せずに仕様書を作成すること。GUIで認知コストを下げることでどこまで実用に耐えられるかを試すMVP未満のものです。実際には出力品質を担保するための質問を用意することが最先端モデルでも困難で、時間がかかります。<br><br>AGENTS.md(CLAUDE.md)では文章量を少なくすることが推奨されており、定型的なデータを使う場合が多いので最低水準が低いように思いますが、頻繁に更新するものではありません。AIツールを使い始める人のため、またはプロンプト保存、SKILL保管庫の機能を統合することでチーム内ツールとして活用できる可能性はあります。<br>またcodex app-serverなどでGUI上から文書をプロンプトとしてあらためてmdファイルの作成をリクエストするという実装も検討できます。'
);
$bunmyaku_label   = (string) theme_portfolio_meta( 'pf_bunmyaku_link_label', 'Bunmyaku' );
$bunmyaku_url     = (string) theme_portfolio_meta( 'pf_bunmyaku_link_url', '' );

if ( '' === $bunmyaku_url ) {
	$bunmyaku_url = home_url( '/bunmyaku' );
}

$bunmyaku_body_html = wp_kses( $bunmyaku_body, theme_portfolio_kses_allowed_html() );
if ( false !== stripos( $bunmyaku_body_html, '<p' ) ) {
	$bunmyaku_body_html = preg_replace( '~</p>\s*<p[^>]*>~i', '<br><br>', $bunmyaku_body_html );
	$bunmyaku_body_html = preg_replace( '~^<p[^>]*>|</p>$~i', '', $bunmyaku_body_html );
}
?>
<section data-l="BunmyakuTeaser" class="out relative mt-0 grid" data-bunmyaku-teaser>
	<div class="relative min-h-[112.5vw] [grid-area:1/1] max-w-[1620px] w-full mx-auto">
		<div class="sticky h-100lvh top-0 xl:top-[-30%] grid place-items-center">
			<canvas class="block w-full aspect-square" aria-hidden="true"></canvas>
		</div>
	</div>
	<div class="WTS [--WTS:var(--tsw)_var(--BC50)] relative z-10 PX [grid-area:1/1] [font-family:--Ship] max-w-[48em] mx-auto">
		<div class="[--LS:0.1em] py-[50lvh]">
			<h2 class="h2FZ HFF BarAF JsRight"><?php echo esc_html( $bunmyaku_heading ); ?></h2>
			<p class="BudouxFade mx-auto my-[3rem] md:text-xl">
				<?php echo wp_kses_post( $bunmyaku_body_html ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			</p>
			<div class="JsLeft">
				<a href="<?php echo esc_url( $bunmyaku_url ); ?>" class="mt-6 BarBF md:text-xl hover:text-AC inline-flex items-center gap-1">
					<?php echo esc_html( $bunmyaku_label ); ?>
					<?php echo theme_phosphor_icon( 'caret-right', array( 'class' => 'shrink-0 [--btnIFZ:1em]' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				</a>
			</div>
		</div>
	</div>
</section>
