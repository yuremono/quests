# tools-domain/

`tools-domain/` は、Quests テーマと `https://yuremono.com/quests/` 用 WordPress に固有の補助ツールを置く場所です。

## 対象

- ローカル WordPress: `http://localhost:10014/`
- ローカル `wp-load.php`: `~/Local Sites/quests/app/public/wp-load.php`
- 本番 WordPress: `https://yuremono.com/quests/`
- 本番テーマ: `~/yuremono.com/public_html/quests/wp-content/themes/quests/`

同じ WordPress 内では固定ページ、メニュー、ACF入力値が共有されます。Quests の初期化ツールは、Quests 専用 WordPress にだけ実行します。

## ファイル

- `bootstrap-quests-site.php`
  - `quests` テーマを有効化する。
  - ACF が配置済みなら有効化する。
  - `Front` / `Service` 固定ページを作成または更新する。
  - `Front` をホームページに設定する。
  - `Quests Navigation` を作成し、`primary` に割り当てる。
- `run-bootstrap-quests-site.sh`
  - Local 付属 PHP と実行中の Local `php.ini` を探して `bootstrap-quests-site.php` を実行する。
- `sync-quests-nav.php`
  - Quests 用ナビゲーションを同期する。実体は `bootstrap-quests-site.php` と同じ処理。
- `deploy-quests.sh`
  - 汎用 `tools/deploy.sh` に `DEPLOY_THEME_SLUG=quests` と `DEPLOY_ZIP_NAME=quests-theme.zip` を渡す Quests 専用ラッパー。

## 実行例

ローカル:

```bash
tools-domain/run-bootstrap-quests-site.sh
```

Quests テーマとして ZIP 作成または本番同期する場合:

```bash
tools-domain/deploy-quests.sh --zip-only
```

本番で WP-CLI から実行する場合:

```bash
cd ~/yuremono.com/public_html/quests
wp eval-file wp-content/themes/quests/tools-domain/bootstrap-quests-site.php
```

通常の `tools/deploy.sh` は `tools/` を本番テーマに同期しません。本番初期化は、必要な場合だけ SSH + WP-CLI で明示的に実行します。

## 注意

- 旧 `portfolio-wp` 用の `work` / `news` / 標準ページ seed は使用しない。
- ルート `https://yuremono.com/` 側 WordPress には実行しない。
- 既存編集を強制上書きする処理を追加する場合は、別スクリプトまたは明示的なオプションに分ける。
