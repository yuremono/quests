# Tools Directory

`tools/` は、テーマやドメインに依存しない補助コマンドを置く場所です。ブラウザを開いただけでは動かず、ターミナルから明示的に実行します。

## 汎用ツール

- `deploy.sh`
  - WordPress テーマを ZIP 化する。
  - `.env.deploy` または環境変数があれば、SSH + rsync でリモートの `wp-content/themes/` 配下へ同期する。
  - `DEPLOY_THEME_SLUG` 未指定時はリポジトリディレクトリ名をテーマスラッグとして使う。
  - `DEPLOY_ZIP_NAME` 未指定時は `${DEPLOY_THEME_SLUG}-theme.zip` を作る。
  - `DEPLOY_PATH` は必ず `wp-content/themes/` 配下を指す必要がある。
- `local-wp-load.path.example`
  - Local WP などの `wp-load.php` パスを指定するためのサンプル。
- `local-wp-load.path`
  - ローカル環境固有の実パス。`.gitignore` 対象なのでコミットしない。

## 固有ツールの置き方

テーマ名、ドメイン、固定ページ名、ACFキー、メニュー名、CPT、特定URLなどに依存するツールは `tools/` 直下へ置かず、固有ディレクトリに分けます。

例:

```txt
tools/quests/
tools/example-theme/
```

固有ディレクトリには必ず `AGENTS.md` を置き、以下を明記します。

- 何のためのツール群か
- 対象のローカル / 本番 WordPress
- 実行してよいタイミング
- 変更または上書きするDB項目
- 本番実行時の注意点

## 安全上の注意

- DBを書き換えるスクリプトは、対象 WordPress を確認してから実行する。
- 本番同期前に `DEPLOY_PATH` が意図したテーマディレクトリか確認する。
- ルートサイトとサブディレクトリサイトなど、複数 WordPress がある場合は混同しない。
- 固有ツールを汎用ツールとして扱わない。
