<?php
/**
 * Portfolio front page default strings (0413portfolio / Next.tsx).
 *
 * @package Theme
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Legacy repulsion items for fallback when CPT work is empty.
 *
 * @return array<int, array<string, mixed>>
 */
function theme_legacy_repulsion_items(): array {
	return array(
		array(
			'title'      => 'Other Works',
			'to'         => '',
			'href'       => '',
			'class'      => 'is-initial pointer-events-none mr-4 -mt-4 bg-transparent',
			'is_initial' => true,
		),
		array(
			'title'   => 'Random Generator',
			'to'      => '/rects',
			'content' => '
				<p>コントローラー付きのランダム図形配置ジェネレーター</p>
				<details class="Toggle IsSmall font-normal ">
					<summary class="Eng">SVG...</summary>
					<div>
						セル数、コンテナを埋める方向性、図形の種類(正方形、三角形、星、十字)、角度などを調整。rect,circle等SVGタグのスニペットをコピペできる。
					</div>
				</details>
				<details class="Toggle IsSmall font-normal ">
					<summary class="Eng">Rects...</summary>
					<div>
						divタグの大きさ、個数、角丸、重なり可否などを指定。いいバランスの時にコピーして画像配置などでそのまま使う想定。SVG出力も可。
					</div>
				</details>
			',
			'class'   => 'mt-4',
		),
		array(
			'title'   => 'Agent Driven CMS',
			'to'      => '/donut',
			'content' => '
				<p>Codex または Claude Code を Next.js Node runtimeで中継。ローカルブラウザでエージェントに直接ソースコードを編集させるCMS</p>
				<details class="Toggle IsSmall font-normal ">
					<summary class="Eng">Detail...</summary>
					<div>
						- AI時代では「チャットで編集できるwebサイト」が求められると仮定する<br>
						- ローカル完結ならモデル性能依存を解消できる<br>
						- フロントエンド以外は全て仕様駆動。<br>
						考察：リテラシーの高いクライアント＆十分な初期サポートという条件は必須と考えていたし、体験としては有意義であるが、エージェントの行動への責任は「サポート」ではカバーできないことを実感した。ここまでやるならCursor、Codex等の使い方自体をサポートした方が無難。と考えました。
					</div>
				</details>
			',
		),
		array(
			'title'   => 'Shuffle Divide',
			'to'      => '/shuffleDivide',
			'content' => '<p>制作サイトの部分再現です。</p>',
		),
		array(
			'title'   => 'Glitch',
			'to'      => '/glitch',
			'content' => '<p>制作サイトの部分再現です。</p>',
		),
		array(
			'title'   => 'Grid Carousel',
			'to'      => '/grid-carousel',
			'content' => '<p>グリッドカルーセルです。</p>',
		),
		array(
			'title'   => 'Bounding Box On Design',
			'to'      => '/bbox',
			'class'   => '-mb-4',
			'content' => '<p>AI生成のLPデザインにバウンディングボックスを配置し、画像+構造化データをエージェントに渡すツールです。</p>',
		),
		array(
			'title'   => 'Activity',
			'to'      => '/activity',
			'content' => '<p>職務要約と活動記録を書いています。</p>',
		),
		array(
			'title'   => 'Chat Canban',
			'href'    => 'https://chat-kanban.vercel.app/',
			'class'   => 'mb-4',
			'content' => '
				<p>
					ローカル環境の特定ブラウザ(Chromium系)に拡張機能をインストールし、ChatGPTやGeminiにチャット履歴を送信するためのUIを設置。特定のurlでまとめて閲覧。ムーバブルサイドバー機能付き。<br>
					＊デモページ。当サイトに統合していません。
				</p>
			',
		),
		array(
			'title'   => 'NextJs CMS',
			'href'    => 'https://cms0505.vercel.app/editor',
			'content' => '<p>AI駆動開発最初の制作物。実務で経験できないシステム設計、データ管理、React、TypeScriptを学ぶため、単一ページ専用CMSを作成。閲覧pass: view</p>',
		),
	);
}

/**
 * Default Experience dialog Cards markup for editable ACF body.
 */
function theme_default_experience_dialog_body(): string {
	return <<<'HTML'
<div class="Cards col3 [--gap:1rem]">
	<div class="item space-y-4">
		<article class="BorderXY px-4 py-5 text-xs bg-AC/10">
			<h3 class="text-[1rem] BorderB pb-4 flex items-baseline justify-between gap-4 ">職種・スキル概要<span class="text-GR tracking-[0.1em] ">4 lists</span></h3>
			<div class="DescList [--dtW:50%] [--PY:0.25em] [--PX:0.25em] mt-4 IsDdright">
				<dl class="items-center">
					<dt class="">Web デザイナー</dt><dd><span class="px-2 bg-WH font-medium">3.5 Year</span></dd>
					<dt class="">Web コーダー</dt><dd><span class="px-2 bg-WH font-medium">3.5 Year</span></dd>
					<dt class="">フロントエンドエンジニア</dt><dd><span class="px-2 bg-WH font-medium">実務未経験</span></dd>
					<dt class="">AI駆動開発</dt><dd><span class="px-2 bg-WH font-medium">1 Year</span></dd>
				</dl>
			</div>
		</article>
		<article class="BorderXY px-4 py-5 text-xs bg-WH/70">
			<h3 class="text-[1rem] BorderB pb-4 flex items-baseline justify-between gap-4 ">エージェント / web<span class="text-GR tracking-[0.1em] ">4 lists</span></h3>
			<div class="DescList [--dtW:50%] [--PY:0.25em] [--PX:0.25em] mt-4 IsDdright">
				<dl class="items-center">
					<dt class="">Cursor</dt><dd><span class="px-2 bg-AC/30 font-medium">1 Year</span></dd>
					<dt class="">Claude Code (GLM, OpenRouter)</dt><dd><span class="">4 Month</span></dd>
					<dt class="">Codex / web</dt><dd><span class="px-2 bg-AC/30 font-medium">1 Month / 1 Year</span></dd>
					<dt class="">Gemini / NanoBanana</dt><dd>1 Year / 6 Month</dd>
				</dl>
			</div>
		</article>
		<article class="BorderXY px-4 py-5 text-xs bg-WH/70">
			<h3 class="text-[1rem] BorderB pb-4 flex items-baseline justify-between gap-4 ">言語 + ライブラリ<span class="text-GR tracking-[0.1em] ">5 lists</span></h3>
			<div class="DescList [--dtW:50%] [--PY:0.25em] [--PX:0.25em] mt-4 IsDdright">
				<dl class="items-center">
					<dt>WEB SCSS+JavaScript+HTML</dt><dd><span class="px-2 bg-AC/30 font-medium">4 Years</span></dd>
					<dt>TypeScript</dt><dd><span class="px-2 bg-AC/30 font-medium">AI 1 Year</span></dd>
					<dt>Python</dt><dd>AI 6 Month</dd>
					<dt>React/Next.Js/Vite</dt><dd><span class="px-2 bg-AC/30 font-medium">AI 1 Year</span></dd>
					<dt>vue/astro/svelte</dt><dd>AI 4 Month</dd>
					<dt>WordPress</dt><dd class="[--ddW:100%]">`Local`で学習中 <a href="https://github.com/yuremono/wp-local-demo" class="align-top leading-[1.8]" target="_blank" rel="noopener noreferrer">wp-local-demo</a></dd>
				</dl>
			</div>
		</article>
	</div>
	<div class="item space-y-4">
		<article class="BorderXY px-4 py-5 text-xs bg-WH/70">
			<h3 class="text-[1rem] BorderB pb-4 flex items-baseline justify-between gap-4 ">デザインツール<span class="text-GR tracking-[0.1em] ">7 lists</span></h3>
			<div class="DescList [--dtW:50%] [--PY:0.25em] [--PX:0.25em] mt-4 IsDdright">
				<dl class="items-center">
					<dt class="">PhotoShop</dt><dd><span class="">4 Year</span></dd>
					<dt class="">Illustrator</dt><dd><span class="">4 Year</span></dd>
					<dt class="">Figma</dt><dd>HtmlToFigmaなど補助利用</dd>
					<dt class="">Pencil.dev</dt><dd><span class="">数回</span></dd>
					<dt class="">Stitch</dt><dd><span class="">数回</span></dd>
					<dt class="[--dtW:100%] ">GPT Image-2.0</dt><dd class="[--ddW:100%]"><span class="px-2 bg-AC/30 font-medium">LPデザイン・アセット作成の実運用を研究</span></dd>
					<dt class="">Claude Design</dt><dd><span class="">情報収集</span></dd>
				</dl>
			</div>
		</article>
		<article class="BorderXY px-4 py-5 text-xs bg-WH/70">
			<h3 class="text-[1rem] BorderB pb-4 flex items-baseline justify-between gap-4 ">環境<span class="text-GR tracking-[0.1em] ">4 lists</span></h3>
			<div class="DescList [--dtW:40%] [--PY:0.25em] [--PX:0.25em] mt-4 IsDdright">
				<dl class="items-center">
					<dt class="">MacOS</dt><dd><span class="px-2 bg-AC/30 font-medium">4 年</span></dd>
					<dt class="">Windows</dt><dd><span class="">社内利用 3.5 年</span></dd>
					<dt class="[--dtW:100%] ">情報収集</dt><dd class="[--ddW:100%]"><span class="px-2 bg-AC/30 font-medium">主にX,Zenn,+webAI ディスカバー</span></dd>
					<dt class="[--dtW:100%] ">制作環境</dt><dd class="[--ddW:100%]"><span class="px-2 bg-AC/30 font-medium">自作のtask系,memory系,実装系スキルを使用</span></dd>
				</dl>
			</div>
		</article>
		<article class="BorderXY px-4 py-5 text-xs bg-WH/70">
			<h3 class="text-[1rem] BorderB pb-4 flex items-baseline justify-between gap-4 ">インフラ / データベース<span class="text-GR tracking-[0.1em] ">4 lists</span></h3>
			<div class="DescList [--dtW:50%] [--PY:0.25em] [--PX:0.25em] mt-4 IsDdright">
				<dl class="items-center">
					<dt class="">Vercel</dt><dd><span class="px-2 bg-AC/30 font-medium">AI 1 Year</span></dd>
					<dt class="">Supabase</dt><dd><span class="">AI 1 Year</span></dd>
					<dt class="">Github</dt><dd>AI 1 Year</dd>
					<dt class="">Xserver+MySQL</dt><dd><span class="">実務 4 Year</span></dd>
				</dl>
			</div>
		</article>
	</div>
	<div class="item">
		<article class="BorderXY px-4 py-5 text-xs bg-WH/70">
			<h3 class="text-[1rem] BorderB pb-4 flex items-baseline justify-between gap-4 ">その他利用履歴</h3>
			<div class="DescList [--dtW:50%] [--PY:0.25em] [--PX:0.25em] mt-4 IsDdright">
				<dl class="items-center">
					<dt class="">Tailwind CSS</dt><dd><span class="px-2 bg-AC/30 font-medium">6 Month,AI 1 Year</span></dd>
					<dt class="">canvas API</dt><dd><span class="px-2 bg-AC/30 font-medium">AI 1 Year</span></dd>
					<dt class="">Three.js</dt><dd>AI 1 Year</dd>
					<dt class="">D3.js</dt><dd>AI 6 Month</dd>
					<dt class="">GSAP</dt><dd>3.5 Year</dd>
					<dt class="">VScode/Chrome Extentions</dt><dd>1~2回作成</dd>
					<dt class="">NanoBanana </dt><dd>スキルで頻繁に利用</dd>
					<dt class="">Quiver.ai/arrow-1</dt><dd class="[--ddW:100%]">BYOS demoのsvg生成で使用</dd>
					<dt class="[--dtW:100%] ">Recraft</dt><dd class="[--ddW:100%]"><span class="">高度な画像生成、SVG作成</span></dd>
					<dt class="">LottieAnimation</dt><dd>webツール試用</dd>
					<dt class="">memsearch</dt><dd>claude/codexで常用</dd>
					<dt class="">superpowers/oh-my-claudecode</dt><dd class=""><span>試用</span></dd>
					<dt class="">tweekpane</dt><dd class="">`/Generator`で使用</dd>
					<dt class="">Z.ai Coding Plan</dt><dd class="">Claude Codeで使用</dd>
					<dt class="">Open Router</dt><dd class="">モデル比較</dd>
					<dt class="">Fal AI</dt><dd class="">動画生成で使用</dd>
					<dt class="">OpenClaw</dt><dd class="">試用</dd>
					<dt class="">tailscale</dt><dd class="">スマホターミナル操作試用</dd>
				</dl>
			</div>
		</article>
	</div>
	<div class="item"></div>
</div>
HTML;
}

/**
 * Resolve repulsion chip link URL.
 *
 * @param array<string, mixed> $item Item data.
 */
function theme_repulsion_item_url( array $item ): string {
	if ( ! empty( $item['href'] ) ) {
		return (string) $item['href'];
	}
	if ( ! empty( $item['to'] ) ) {
		$path = (string) $item['to'];
		if ( str_starts_with( $path, 'http' ) ) {
			return $path;
		}
		return home_url( $path );
	}
	return '';
}
