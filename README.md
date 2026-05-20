# Portfolio Corporate

AI エージェントを活用して制作した WordPress 企業サイトテーマのデモです。

既存ポートフォリオの構成・見た目・インタラクションを WordPress テーマへ移植し、管理画面から主要な文言や一覧を更新できる状態にする学習用プロジェクトです。目的は WordPress 専門テーマを作り込むことではなく、受託制作でよく出るクラシックテーマ、ACF、カスタム投稿タイプ、固定ページテンプレート、フォーム、SEO、ローカルから公開までの基本運用を一通り確認することです。

## 要件

- WordPress 6.x
- PHP 8.0+
- Node.js / npm
- Composer
- Advanced Custom Fields
- Local WP などのローカル WordPress 環境

推奨確認プラグイン:

- Contact Form 7
- SEO SIMPLE PACK
- WP Multibyte Patch

## 主な実装

- `front-page.php` によるフロントページ実装
- `group_pc_front_page` の ACF ローカルフィールド登録
- `work` CPT による Other Works / RepulsionLists 管理
- `news` CPT によるお知らせ管理
- `primary` / `footer` のメニュー位置登録と `wp_nav_menu()` 出力
- 固定ページテンプレートとテンプレート別 ACF フィールド
- `assets/theme.scss` / `assets/tailwind.scss` から CSS を生成する SCSS ビルド
- `assets/src/mindmap-front.ts` から `assets/mindmap-runtime.js` を生成する JS ビルド
- 管理画面アクセス時の初期データ補完と、`tools/` 配下の明示実行スクリプト

## 実装済みの範囲

### フロントページ + ACF

フロントページは `front-page.php` と `template-parts/front/` の部品で構成しています。表示文言は `inc/acf-portfolio-front.php` の `group_pc_front_page` に登録した ACF フィールドから取得し、ACF が無効な場合も `get_post_meta()` の fallback で fatal error を避けます。

初期値は `inc/portfolio-defaults.php` と `inc/demo-content.php` に集約しています。管理画面で空欄の項目だけ補完し、既存編集を上書きしない方針です。

### work / news CPT

`inc/cpt.php` で以下の CPT を登録しています。

- `work`: 管理画面上の Works。Other Works / RepulsionLists のチップ、リンク、ポップアップ本文、表示順、追加 CSS クラスを管理します。公開アーカイブは持たず、フロントページ用の編集データとして扱います。
- `news`: お知らせ。公開アーカイブあり、タイトル・本文・アイキャッチ・抜粋を持つ通常のニュース投稿として扱います。

### メニュー

`inc/setup.php` で `primary` と `footer` のメニュー位置を登録しています。ヘッダーとフッターは `wp_nav_menu()` を使い、未割り当て時はデザイン確認用の fallback を表示します。

### 固定ページテンプレート

`page-templates/` に固定ページ用テンプレートを用意しています。テンプレートごとの入力欄は `inc/acf-page-templates.php` で `page_template` ルールに紐付けています。

主なテンプレート:

- 会社概要
- コンセプト
- サービス
- サービス一覧（概要）
- 設計理念
- FAQ
- 採用情報
- お問い合わせ
- お問い合わせ（構造化レイアウト）
- プライバシーポリシー（レイアウト）

### SCSS / JS ビルド

`package.json` にビルドスクリプトがあります。

- `npm run build:css`: `assets/theme.scss` と `assets/tailwind.scss` から CSS を生成
- `npm run build:js`: `assets/src/mindmap-front.ts` を bundle して `assets/mindmap-runtime.js` を生成
- `npm run build`: CSS と JS をまとめて生成
- `npm run watch`: SCSS の watch

## セットアップ

1.  `wp-content/themes/` に配置する。
2. 管理画面でテーマを有効化する。
3. Advanced Custom Fields を有効化する。
4. 固定ページを作成し、表示設定でホームページに指定する。
5. パーマリンク設定を保存する。

## Local WP での検証手順

1. Local WP で WordPress サイトを作成する。
2. このディレクトリをサイトの `app/public/wp-content/themes/` 配下に配置する。
3. WordPress 管理画面でテーマを有効化する。
4. ACF を有効化する。
5. 固定ページを作成し、設定 > 表示設定でホームページに指定する。
6. 外観 > メニューで `primary` と `footer` にメニューを割り当てる。
7. 設定 > パーマリンクで保存を押し、CPT の rewrite を更新する。
8. フロントページ、固定ページテンプレート、`work`、`news` の表示を確認する。
9. `npm install` 後に `npm run build` を実行し、生成済み CSS / JS で表示崩れがないか確認する。
10. 初回のみ `composer install` を実行し、`composer run phpcs` で PHP の静的チェックを確認する。

`tools/` 配下のスクリプトはブラウザ表示だけでは実行されません。実行する場合は、対象の Local WP サイトと `wp-load.php` のパスが意図した環境を指していることを確認してください。

## プラグインの位置づけ

### Advanced Custom Fields

このテーマの管理画面編集の中心です。フロントページ、固定ページテンプレート、`work` CPT の補助フィールドを PHP でローカル登録しています。管理画面でフィールドグループを手作業で作る運用ではなく、テーマコードを正として扱います。

### Contact Form 7

お問い合わせフォームの検証対象です。テーマ側ではお問い合わせ用テンプレートと案内文を用意していますが、フォーム本体はテーマに同梱していません。導入する場合は Contact Form 7 でフォームを作成し、お問い合わせページの本文にショートコードまたはブロックを配置します。

### SEO SIMPLE PACK

title、description、OGP などの基本 SEO 設定を管理画面から確認するための検証対象です。テーマは `title-tag` を有効化しています。SEO SIMPLE PACK 側でトップページ、固定ページ、投稿、CPT のメタ情報が意図通り出るか確認します。

### WP Multibyte Patch

日本語環境の文字列処理、検索、メール、ファイル名まわりの補助として導入を確認するプラグインです。テーマ固有機能ではありませんが、日本語サイトの基本環境として有効化して動作確認します。

## 管理画面チェックリスト

- ACF が有効化されている。
- 表示設定でホームページが固定ページに設定されている。
- ホームページ編集画面に「ポートフォリオ TOP」の入力欄が表示される。
- 各固定ページで適切なテンプレートを選ぶと、対応する ACF 入力欄が表示される。
- Works 管理画面で `work` 投稿を追加・並び替えできる。
- お知らせ管理画面で `news` 投稿を追加できる。
- 外観 > メニューで `primary` と `footer` にメニューが割り当てられている。
- お問い合わせページ本文に Contact Form 7 のショートコードまたはフォームブロックを配置できる。
- SEO SIMPLE PACK でトップページ、固定ページ、投稿、`news` のメタ情報を設定できる。
- パーマリンクを保存し、`news` のアーカイブと詳細が 404 にならない。

## レンタルサーバー公開前チェックリスト

- 本番側 WordPress、PHP、MySQL のバージョンが要件を満たしている。
- テーマ、ACF、Contact Form 7、SEO SIMPLE PACK、WP Multibyte Patch を本番側に導入している。
- `npm run build` 済みの CSS / JS がテーマに含まれている。
- Local WP から移行した固定ページ、`work`、`news`、メディア、メニューが本番側で確認できる。
- 表示設定、パーマリンク、メニュー位置、SEO 設定を本番側で保存し直している。
- Contact Form 7 の送信先、送信元、確認メール、迷惑メール判定を本番ドメインで確認している。
- SSL が有効で、管理画面とフロントが HTTPS で表示される。
- `WP_DEBUG` が本番向けの設定になっている。
- 不要なデモ文言、サンプルメールアドレス、仮の住所、ダミー URL が残っていない。
- スマートフォン、タブレット、PC の主要幅で表示を確認している。
- フォーム送信、メニュー、ポップアップ、MindMap、RepulsionLists の JS 動作を確認している。
- バックアップと復元手順を確認している。
- Basic 認証や検索エンジン非公開設定を、公開タイミングに合わせて解除している。

## よく使うコマンド

```bash
npm install
npm run build
npm run build:css
npm run build:js
npm run watch
composer install
composer run phpcs
composer run phpcbf
```

Local WP の `wp-load.php` を明示してスクリプトを実行する例:

```bash
WP_LOAD_PATH="$HOME/Local Sites/site-name/app/public/wp-load.php" php tools/set-portfolio-demo-meta.php
WP_LOAD_PATH="$HOME/Local Sites/site-name/app/public/wp-load.php" php tools/seed-works.php
```

実行前に `site-name` と対象 DB が意図した Local WP サイトであることを確認してください。

## ACF / 初期データ

ACF フィールドは `functions.php` から読み込まれる `inc/acf-portfolio-front.php`、`inc/acf-page-templates.php`、`inc/cpt.php` で登録しています。管理画面での手動作成は不要です。

初期データは既存編集を上書きしない方針です。フロントページの空欄補完と `work` の初期投稿は `inc/demo-content.php` にあります。明示的に投入する補助スクリプトは `tools/` にあります。

## 開発用ファイル

`tools/` はローカル開発用スクリプトです。実行対象の WordPress 環境は `WP_LOAD_PATH` や実行場所に依存するため、意図していないサイトに対してデモ投入しないよう注意してください。

ライセンスは各サービスの規約に従います。
