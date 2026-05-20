<?php
/**
 * Portfolio front page.
 *
 * @package Theme
 */

declare(strict_types=1);

get_header();

$repulsion_items = array(
	array( 'Other Works', '', '', 'is-initial pointer-events-none mr-4 -mt-4 bg-transparent', '' ),
	array( 'Random Generator', home_url( '/rects' ), '', 'mt-4', 'コントローラー付きのランダム図形配置ジェネレーター' ),
	array( 'Agent Driven CMS', home_url( '/donut' ), '', '', 'Codex または Claude Code を Next.js Node runtimeで中継。ローカルブラウザでエージェントに直接ソースコードを編集させるCMS' ),
	array( 'Shuffle Divide', home_url( '/shuffleDivide' ), '', '', '制作サイトの部分再現です。' ),
	array( 'Glitch', home_url( '/glitch' ), '', '', '制作サイトの部分再現です。' ),
	array( 'Grid Carousel', home_url( '/grid-carousel' ), '', '', 'グリッドカルーセルです。' ),
	array( 'Bounding Box On Design', home_url( '/bbox' ), '', '-mb-4', 'AI生成のLPデザインにバウンディングボックスを配置し、画像+構造化データをエージェントに渡すツールです。' ),
	array( 'Activity', home_url( '/activity' ), '', '', '職務要約と活動記録を書いています。' ),
	array( 'Chat Canban', '', 'https://chat-kanban.vercel.app/', 'mb-4', 'ローカル環境の特定ブラウザに拡張機能をインストールし、ChatGPTやGeminiにチャット履歴を送信するためのUIを設置。' ),
	array( 'NextJs CMS', '', 'https://cms0505.vercel.app/editor', '', 'AI駆動開発最初の制作物。単一ページ専用CMSを作成。閲覧pass: view' ),
);
?>

<div class="PageRoot [--innerPX:--PX] [--Eng:--Jost] [--San:--Zen] [--h3FZ:1.5em] [--dropBG:--WH] [--dropC:--TC] [--WTS:var(--tsw)_var(--TC30)]" data-portfolio-page>
	<header id="Header" class="Header HeaderCylinder" data-nav-open="false">
		<div class="HeaderInner ">
			<button type="button" class="HeaderLogo HeaderCylinderLogo" aria-expanded="false" aria-controls="HeaderNav" aria-label="Open menu" data-menu-toggle>
				<span class="LogoLoading" aria-hidden="true"></span>
				<span class="HeaderAnotation WTS text-[--BC] ">
					<span>Tap or Click</span>
					<span>Open Menu</span>
				</span>
			</button>
			<nav class="HeaderNav" id="HeaderNav" role="navigation" aria-label="main navigation" aria-hidden="true" inert>
				<ul class="NavUl">
					<li class="NavLi"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">HOME</a></li>
					<li class="NavLi [font-family:--Ship]"><a href="<?php echo esc_url( home_url( '/bunmyaku' ) ); ?>">文脈</a></li>
					<li class="NavLi NavDrop">
						<button type="button" class="DropA DropToggle" popovertarget="HeaderRepositoriesMenu-cylinder">Repositories<span class="DropIcon">⌄</span></button>
						<button type="button" class="DropBtn DropToggle" popovertarget="HeaderRepositoriesMenu-cylinder" aria-label="Toggle repositories submenu"></button>
						<ul id="HeaderRepositoriesMenu-cylinder" class="DropUl" popover="auto" aria-label="Repositories">
							<li class="DropLi"><a href="https://github.com/yuremono/portfolio" class=" " target="_blank" rel="noopener noreferrer">Portfolio<span class="icon-arrow-square-out" aria-hidden="true">↗</span></a></li>
							<li class="DropLi"><a href="https://github.com/yuremono/wp-local-demo" class=" " target="_blank" rel="noopener noreferrer">wp-local-demo<span class="icon-arrow-square-out" aria-hidden="true">↗</span></a></li>
							<li class="DropLi"><a href="https://github.com/yuremono/BurnYourOwnStyle/tree/react" class=" " target="_blank" rel="noopener noreferrer">BurnYourOwnStyle<span class="icon-arrow-square-out" aria-hidden="true">↗</span></a></li>
							<li class="DropLi"><a href="https://github.com/yuremono/agent-driven-CMS" class=" " target="_blank" rel="noopener noreferrer">AgentDrivenCMS<span class="icon-arrow-square-out" aria-hidden="true">↗</span></a></li>
							<li class="DropLi"><a href="https://github.com/yuremono/agent-relay" class=" " target="_blank" rel="noopener noreferrer">AgentRelay<span class="icon-arrow-square-out" aria-hidden="true">↗</span></a></li>
							<li class="DropLi"><a href="https://github.com/yuremono/creative-demos" class=" " target="_blank" rel="noopener noreferrer">CreativeDemos<span class="icon-arrow-square-out" aria-hidden="true">↗</span></a></li>
							<li class="DropLi"><a href="https://github.com/yuremono/chatKanban" class=" " target="_blank" rel="noopener noreferrer">ChatCanban<span class="icon-arrow-square-out" aria-hidden="true">↗</span></a></li>
							<li class="DropLi"><a href="https://github.com/yuremono/portfolio" class=" " target="_blank" rel="noopener noreferrer">NextJsCMS<span class="icon-arrow-square-out" aria-hidden="true">↗</span></a></li>
						</ul>
					</li>
					<li class="NavLi NavDrop">
						<button type="button" class="DropA DropToggle" popovertarget="HeaderPagesMenu-cylinder">Pages<span class="DropIcon">⌄</span></button>
						<button type="button" class="DropBtn DropToggle" popovertarget="HeaderPagesMenu-cylinder" aria-label="Toggle pages submenu"></button>
						<ul id="HeaderPagesMenu-cylinder" class="DropUl" popover="auto" aria-label="Pages">
							<li class="DropLi"><a href="<?php echo esc_url( home_url( '/preview' ) ); ?>">BurnYourOwnStyle</a></li>
							<li class="DropLi [font-family:--Ship]"><a href="<?php echo esc_url( home_url( '/bunmyaku' ) ); ?>">文脈</a></li>
							<li class="DropLi"><a href="<?php echo esc_url( home_url( '/donut' ) ); ?>">Donut<small>(ADCMS)</small></a></li>
							<li class="DropLi"><a href="<?php echo esc_url( home_url( '/rects' ) ); ?>">RandomGenerator</a></li>
							<li class="DropLi"><a href="<?php echo esc_url( home_url( '/shuffleDivide' ) ); ?>">ShuffleDivide</a></li>
							<li class="DropLi"><a href="<?php echo esc_url( home_url( '/glitch' ) ); ?>">Glitch</a></li>
							<li class="DropLi"><a href="<?php echo esc_url( home_url( '/grid-carousel' ) ); ?>">GridCarousel</a></li>
							<li class="DropLi"><a href="<?php echo esc_url( home_url( '/bbox' ) ); ?>">BBox</a></li>
							<li class="DropLi"><a href="<?php echo esc_url( home_url( '/activity' ) ); ?>">Activity</a></li>
							<li class="DropLi"><a href="https://chat-kanban.vercel.app/" class=" " target="_blank" rel="noopener noreferrer">ChatCanban<span class="icon-arrow-square-out" aria-hidden="true">↗</span></a></li>
							<li class="DropLi"><a href="https://cms0505.vercel.app/" class=" " target="_blank" rel="noopener noreferrer">NextJsCMS<span class="icon-arrow-square-out" aria-hidden="true">↗</span></a></li>
						</ul>
					</li>
				</ul>
				<div class="FocusTrap MenuToggle" tabindex="0"></div>
			</nav>
		</div>
	</header>

	<div class="HeaderPagetop mix-blend-difference text-WH">
		<a href="#">⌃</a>
	</div>
	<button type="button" class="ThemeToggle mix-blend-difference text-WH" aria-label="Toggle dark mode" data-theme-toggle>☾</button>

	<main class="min-h-screen">
		<section class="out mindMap text-center font-thin">
			<p class="mmPin about_p lg:w-[calc(var(--wid)/2)] text-[--GR] font-light text-center p-4 px-6 right-1/2 top-1/2 lg:translateYH static lg:absolute" style="font-size: 3em;">
				yuremono<br>works
			</p>
			<h1 class="JsLetter text-lg font-normal budoux mmPin about_tx static lg:absolute lg:translateYH leading-[2em] left-1/2 top-1/2 z-10 text-left p-4 bg-background/80">
				2025/05からAI駆動開発を開始<br>
				ヴィジュアル表現をAIでブーストし<br>
				コンテキストエンジニアリングに注力しています
			</h1>
			<p class="mm2-2" style="font-size: 4em;">Context</p>
			<p class="mm9-6" style="font-size: 4em;">Development</p>
			<p class="hidden lg:inline-block mm3-9" style="font-size: 5em;">Web</p>
		</section>

		<section class="ScrollX relative mt-0" data-scroll-x>
			<div class="ScrollTrack">
				<div class="DialogWrapper">
					<div class="mindMap text-center experience font-thin">
						<h2 class="mm1-3 text-[--GR] font-light text-left tracking-[-0.025em]" style="font-size: 3em;">
							Experience and<br>Dependencies
						</h2>
						<div class="text-base mmPin mmStatic max-w-[calc(var(--wid)/2)] experience_tx text-left San font-light leading-[2em] static lg:absolute left-1/2 top-[--MY] z-10 p-4 bg-background/80">
							<h3 class="text-GR text-[1.25em] inline-block mr-4">経験と依存性</h3>
							<button type="button" class="textlink mt-6" aria-haspopup="dialog" aria-controls="experience-dialog" data-dialog-open="experience-dialog">
								Details<span class="[--btnIFZ:1.5em] align-text-bottom">＋</span>
							</button>
							<br>
							<div class="text-left">
								<h3 class="text-GR mt-10 mb-2">About This Site</h3>
								<span class="budoux">
									個人制作ページ、ツールをまとめています。<br>
									これまではNextJS CMS、AIチャット共有拡張機能、<br>
									AI前提のweb開発を行なってきました。
								</span>
							</div>
						</div>
						<p class="hidden lg:inline-block" style="font-size: 2.5em;">Cursor</p>
						<p class="hidden lg:inline-block" style="font-size: 2em;">Claude Code</p>
						<p class="hidden lg:inline-block" style="font-size: 2.5em;">TailwindCSS</p>
						<p class="hidden lg:inline-block" style="font-size: 2em;">WebGL</p>
						<p class="hidden lg:inline-block" style="font-size: 2.5em;">Codex</p>
						<p class="hidden lg:inline-block" style="font-size: 2em;">Pencil.dev</p>
						<p class="mmPin bg-GR/70 text-xs md:text-xl absolute z-10 text-[--WH] min-h-[2.5rem] content-center left-0 bottom-0 w-full text-align-last-justify px-2 md:px-16">
							Typescript PhotoShop Figma Three.js Supabase GSAP
						</p>
					</div>
					<dialog id="experience-dialog" aria-label="Experience and Dependencies" aria-modal="true" class="min-h-lvh w-screen max-w-none overflow-y-auto overscroll-none bg-BC/90 outline-none">
						<article class="py-[--PX] into">
							<button type="button" class="textlink DS shrink-0 text-AC fixed top-[--PX] right-[--into] p-2" data-dialog-close>Close ×</button>
							<header class="flex items-start justify-between gap BorderB pb-4">
								<div>
									<p class="text-sm font-bold text-AC">Details</p>
									<h2 class="font-medium text-GR">Experience and Dependencies</h2>
									<p class="mt-2 leading-[--LH]">経験とAI依存の詳細。</p>
								</div>
							</header>
							<section class="mt-8" aria-label="Experience and Dependencies">
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
													<dt>WordPress</dt><dd class="[--ddW:100%]">`Local`で学習中&nbsp;<a href="https://github.com/yuremono/wp-local-demo" class="align-top leading-[1.8]" target="_blank" rel="noopener noreferrer">wp-local-demo<span class="icon-arrow-square-out" aria-hidden="true">↗</span></a></dd>
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
							</section>
						</article>
					</dialog>
				</div>

				<section class="Cards col2 relative items-center into [--gap:0px]">
					<div class="item PX">
						<div class="text-center">
							<h2 class="font-thin grid content-center md:h-[100lvh]">
								<span class="mindWobble text-left leading-[0.7em] tracking-[-0.0em]" style="font-size: 2.5em;">Vibe<br>&nbsp;&nbsp;Design</span>
								<span class="mindWobble text-center leading-[1em] mt-[-0.25em] tracking-[-0.0em] font-normal text-GR/10" style="font-size: 6em;">or</span>
								<span class="mindWobble text-right leading-[0.57em] tracking-[0.08em]" style="font-size: 2.5em;">Vault&nbsp;<br>Driven</span>
							</h2>
						</div>
					</div>
					<div class="item content-center bg-background/80 p-4">
						<div class="leading-[2]">
							<h3 class="text-GR mb-2">AI Ready</h3>
							<b>DESIGN.md</b> , <b>画像生成デザイン</b>を基点としたゼロからのページ作成の検証と、<b>自然言語でUIパーツを再利用</b>する為の環境構築を行っています。
							<h3 class="text-GR mt-10">Burn Your Own Style</h3>
							<details class="Toggle IsSmall font-normal mt-2">
								<summary class="Eng">Thinking...</summary>
								<div>
									- モデルの学習データに基づくwebデザイン・コーディングは平均的で、振れ幅が大きく、個人の理想とするマークアップ、スタイリングとかけ離れたものになる。<br>
									- 構造=既存クラス、装飾=Tailwindで手直ししやすい状態になるが、無駄な記述が多い。<br>
									考察：モデルのファインチューニングが民主化するまでは「完成品の再利用」を効率化する方が良い
								</div>
							</details>
							<div class="flex flex-wrap mt-4">
								<a class="btn mt-[-1px] [--btnW:50%]" href="https://github.com/yuremono/BurnYourOwnStyle/tree/react" target="_blank" rel="noopener noreferrer">Repository&nbsp;↗</a>
								<a class="btn mt-[-1px] ml-[-1px] [--btnW:50%]" href="<?php echo esc_url( home_url( '/preview' ) ); ?>">Preview</a>
							</div>
						</div>
					</div>
					<p class="bg-GR/70 text-xs md:text-xl absolute z-10 font-thin Eng text-[--WH] min-h-[2.5rem] content-center left-0 bottom-0 w-full text-align-last-justify px-2 md:px-16">
						Typescript PhotoShop Figma Three.js Supabase GSAP
					</p>
				</section>
			</div>
			<div class="ScrollSpacer" aria-hidden="true"></div>
		</section>

		<section data-l="BunmyakuTeaser" class="out relative mt-0 grid BunmyakuTeaserSection">
			<div class="relative min-h-[112.5vw] [grid-area:1/1] max-w-[1620px] w-full mx-auto">
				<div class="sticky h-100lvh top-0 xl:top-[-30%] grid place-items-center">
					<div class="BunmyakuTeaserCanvasPlaceholder block w-full aspect-square" aria-hidden="true">文</div>
				</div>
			</div>
			<div class="WTS [--WTS:var(--tsw)_var(--BC50)] relative z-10 PX [grid-area:1/1] [font-family:--Ship] max-w-[48em] mx-auto">
				<div class="[--LS:0.1em] py-[50lvh]">
					<h2 class="h2FZ HFF BarAF JsRight">## 文脈.app</h2>
					<p class="BudouxFade mx-auto my-[3rem] md:text-xl">
						### SPEC.md, DESIGN.md, AGENTS.md をGUIで作成するツール<br>
						<br>
						DESIGN.mdはフロントエンドの要件定義書と言えます。公開サイトURLから作成するツールが多く出回っており、一定の効率化につながりますが、Sticthの公式テンプレートの情報量でも不十分であり、結局テンプレート出力になります。<br>
						<br>
						一方ClaudeDesignでは詳細を問いかける設計が従来のAIビルダーとの差別化でありますが、最先端モデルのテンプレートであることに変わりはありません。<br>
						<br>
						このツールではClaudeやモデル性能に依存せずに仕様書を作成すること。GUIで認知コストを下げることでどこまで実用に耐えられるかを試すMVP未満のものです。実際には出力品質を担保するための質問を用意することが最先端モデルでも困難で、時間がかかります。<br>
						<br>
						AGENTS.md(CLAUDE.md)では文章量を少なくすることが推奨されており、定型的なデータを使う場合が多いので最低水準が低いように思いますが、頻繁に更新するものではありません。AIツールを使い始める人のため、またはプロンプト保存、SKILL保管庫の機能を統合することでチーム内ツールとして活用できる可能性はあります。
						<br>またcodex app-serverなどでGUI上から文書をプロンプトとしてあらためてmdファイルの作成をリクエストするという実装も検討できます。
					</p>
					<div class="JsLeft">
						<a href="<?php echo esc_url( home_url( '/bunmyaku' ) ); ?>" class="mt-6 BarBF md:text-xl hover:text-AC">
							Bunmyaku
							<span class="align-middle ml-0" aria-hidden="true">›</span>
						</a>
					</div>
				</div>
			</div>
		</section>

		<div class="repulsion-lists-module mt-[-25lvh] z-10">
			<section class="out px-[calc(var(--into)/3*2)] MY Eng font-light">
				<div id="repulsion-lists-horizontal-scroll-container" class="repulsion-lists-viewport">
					<div id="repulsion-lists-card-container">
						<svg class="repulsion-lists-lines" viewBox="0 0 0 0" preserveAspectRatio="none" data-connection-lines="true" aria-hidden="true"></svg>
						<ul class="repulsion-lists-list" aria-label="Repulsion list">
							<?php foreach ( $repulsion_items as $index => $item ) : ?>
								<?php
								$title = $item[0];
								$to    = $item[1];
								$href  = $item[2];
								$class = $item[3];
								$body  = $item[4];
								?>
								<li data-repulsion-list-chip="true" data-repulsion-list-item-id="repulsion-list-item-<?php echo esc_attr( (string) $index ); ?>" data-state="idle" class="repulsion-list-chip relative list-none bg-WH <?php echo esc_attr( $class ); ?>">
									<div class="repulsion-list-chip-control">
										<?php if ( '' !== $to || '' !== $href ) : ?>
											<a href="<?php echo esc_url( '' !== $to ? $to : $href ); ?>"<?php echo '' !== $href ? ' target="_blank" rel="noopener noreferrer"' : ''; ?>>
												<div class="repulsion-list-chip-content [font-size:clamp(2rem,_5vw,_5rem)] font-light">
													<span class="repulsion-list-chip-label block mx-auto p-4 whitespace-nowrap text-center bg-[repultion-list-light]"><?php echo esc_html( $title ); ?></span>
												</div>
											</a>
										<?php else : ?>
											<span class="font-thin z-10 leading-[1.25em] [font-size:calc(var(--mmFZ)*4.5)]"><?php echo esc_html( $title ); ?></span>
										<?php endif; ?>
										<div class="repulsion-list-chip-popup">
											<?php if ( '' !== $body ) : ?>
												<p><?php echo esc_html( $body ); ?></p>
											<?php endif; ?>
										</div>
									</div>
								</li>
							<?php endforeach; ?>
						</ul>
					</div>
				</div>
			</section>
		</div>

		<div class="ImgText grid-cols-1 items-center gap-8 md:grid-cols-2 ImgText hidden">
			<div>
				<div class="h-full">
					<p>ここにテキストを入力します</p>
				</div>
			</div>
		</div>

		<section class="Form Form hidden" style="--base: 1200px;">
			<div class="mb-8">
				<h2>お問い合わせ</h2>
				<p>以下のフォームよりおください。</p>
			</div>
			<form class="mx-auto max-w-2xl">
				<div class="mb-4">
					<label for="nc-name" class="mb-2 block font-medium">お名前</label>
					<input type="text" id="nc-name" class="w-full rounded border border-[var(--border)] bg-[var(--background)] p-2 text-[var(--foreground)]" required name="name">
				</div>
				<div class="mb-4">
					<label for="nc-email" class="mb-2 block font-medium">メールアドレス</label>
					<input type="email" id="nc-email" class="w-full rounded border border-[var(--border)] bg-[var(--background)] p-2 text-[var(--foreground)]" required name="email">
				</div>
				<div class="mb-4">
					<label for="nc-message" class="mb-2 block font-medium">メッセージ</label>
					<textarea id="nc-message" name="message" rows="4" class="w-full rounded border border-[var(--border)] bg-[var(--background)] p-2 text-[var(--foreground)]" required></textarea>
				</div>
				<div class="mb-4">
					<label class="flex items-center gap-2">
						<input type="checkbox" class="mr-0" required name="privacy">
						<span>プライバシーポリシーに同意する</span>
					</label>
				</div>
				<button type="submit" class="rounded bg-slate-700 px-4 py-2 font-medium text-white">送信</button>
			</form>
		</section>
	</main>

	<footer class="Eng Wrap into bg-[--foreground] text-[--background] bg-no-repeat bg-contain bg-left-bottom Footer" style="background-image: url(<?php echo esc_url( get_template_directory_uri() . '/images/fff2.svg' ); ?>);">
		<div class="DescList IsCenter">
			<div>
				<dl>
					<dt>Name</dt>
					<dd>Yano Seiji</dd>
					<dt>Hobby</dt>
					<dd>Manga I love<br>Anime I love<br>Light Novel I love<br>Music I love</dd>
					<dt>Specialty</dt>
					<dd>CSS Styling<br>Context Engineering</dd>
				</dl>
			</div>
		</div>
		<div class="text-center">
			<p class="mb-0 text-[length:var(--logoFZ)]">yuremono works</p>
			<ul class="flex flex-wrap gap md:justify-center mt-6">
				<li><a href="<?php echo esc_url( home_url( '/preview' ) ); ?>">BurnYourOwnStyle</a></li>
				<li class="[font-family:--Ship]"><a href="<?php echo esc_url( home_url( '/bunmyaku' ) ); ?>">文脈</a></li>
				<li><a href="<?php echo esc_url( home_url( '/donut' ) ); ?>">Donut<small>(ADCMS)</small></a></li>
				<li><a href="<?php echo esc_url( home_url( '/rects' ) ); ?>">RandomGenerator</a></li>
				<li><a href="<?php echo esc_url( home_url( '/shuffleDivide' ) ); ?>">ShuffleDivide</a></li>
				<li><a href="<?php echo esc_url( home_url( '/glitch' ) ); ?>">Glitch</a></li>
				<li><a href="<?php echo esc_url( home_url( '/grid-carousel' ) ); ?>">GridCarousel</a></li>
				<li><a href="<?php echo esc_url( home_url( '/bbox' ) ); ?>">BBox</a></li>
				<li><a href="<?php echo esc_url( home_url( '/activity' ) ); ?>">Activity</a></li>
				<li><a href="https://chat-kanban.vercel.app/" target="_blank" rel="noopener noreferrer">ChatCanban&nbsp;↗</a></li>
				<li><a href="https://cms0505.vercel.app/" target="_blank" rel="noopener noreferrer">NextJsCMS&nbsp;↗</a></li>
			</ul>
		</div>
	</footer>
</div>

<?php
get_footer();
