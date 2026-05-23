---
name: wp-deploy
description: WordPress テーマの本番反映、SSH 同期、配布 ZIP、XML 取り込み、関連ドキュメントの整合を扱う。`DEPLOY_PORT` や SSH config の前提差分、`npm run deploy` / `npm run deploy:prod` / `tools/deploy.sh` の更新、デプロイ手順の案内整理に使う。
---

# WP Deploy

WordPress テーマの本番反映を扱うスキル。テーマだけの同期、XML を含む反映、SSH ポート設定の確認、デプロイ手順の更新をまとめて扱う。
このスキルを読めば、デプロイの判断、必要な環境変数、実行コマンド、失敗しやすい点をひと通り追える状態を目標にする。

## 使う場面

- `npm run deploy` / `npm run deploy:prod` の実行や見直し
- `tools/deploy.sh` の修正
- `.env.deploy`、`DEPLOY_PORT`、SSH config の整合確認
- `DEPLOYMENT.md`、`UPDATE_TO_PROD.md`、`README.md`、`tools/AGENTS.md` の案内整理
- 本番反映手順の再発防止やドキュメント統合
- `exports/yuremono-wp-content.xml` の取り込み条件や再実行可否の整理

## 最短手順

1. `git status --short` で既存変更を確認する。
2. テーマだけなら `npm run deploy -- --delete` を使う。
3. テーマと XML をまとめるなら `npm run deploy:prod` を使う。
4. 反映後は、本番で影響がある項目だけを確認する。

## 実行前の前提

- `DEPLOY_HOST` / `DEPLOY_USER` / `DEPLOY_PATH` は `.env.deploy` か環境変数で渡す。
- `DEPLOY_PORT` があればそれを使う。無ければ `ssh -G <host>` で SSH config の `port` を読む。
- `DEPLOY_PATH` は `wp-content/themes/` 配下でなければならない。
- `exports/yuremono-wp-content.xml` が存在しないと XML 取り込みはスキップされる。
- `DEPLOY_WP_PATH` が無ければ、`DEPLOY_PATH` から WordPress ルートを推測する。
- 既存本番 DB に直接 SQL を流す前提ではない。通常は WXR/XML 取り込みを使う。

## コマンドの意味

- `npm run deploy`
  - `assets/theme.css`、`assets/tailwind.css`、`assets/mindmap-runtime.js` をビルドする
  - ZIP を作る
  - `DEPLOY_HOST` などがある場合は本番テーマを同期する
- `npm run deploy -- --delete`
  - 同期先からローカルに無いファイルを削除する
  - 本番の不要ファイルを残したくないときに使う
- `npm run deploy -- --zip-only --no-phpcs`
  - ZIP だけ作る
  - 本番同期しない
- `npm run deploy:prod`
  - テーマ同期のあとに `exports/yuremono-wp-content.xml` を本番へ取り込む
  - つまり「テーマ + コンテンツ」を一度に反映する
- `--import-xml`
  - `tools/deploy.sh` へ明示的に XML 取り込みを指示する
- `--no-phpcs`
  - PHP 静的チェックを飛ばす

## XML 取り込み補足

XML 取り込みは、このスキルで必ず整理する。

1. `exports/yuremono-wp-content.xml` が更新されているか確認する。
2. `DEPLOY_HOST` / `DEPLOY_USER` / `DEPLOY_PATH` が揃っているか確認する。
3. `DEPLOY_WP_PATH` を設定できるなら設定する。推測に頼るより安全。
4. `npm run deploy:prod` を使うと、テーマ同期のあとに `wp import --authors=create` が走る。
5. `wp import` は同じ XML を何度も流すと投稿や固定ページが増えることがあるので、更新が本当にあるときだけ使う。
6. 取り込み後は、固定ページ、メニュー、`work`、`news`、フォーム、SEO、画像 URL を確認する。
7. 取り込みに使った一時 XML は、`tools/deploy.sh` が削除する前提だが、失敗時は残ることがある。

## 失敗しやすい点

- SSH ポートを `22` 固定にすると再発するので、`DEPLOY_PORT` か SSH config のどちらかを必ず読む。
- `DEPLOY_PATH` が `wp-content/themes/` 配下でないと同期を止める。
- `DEPLOY_PATH` から WordPress ルートを推測できないときは `DEPLOY_WP_PATH` を入れる。
- リモート側に `wp` が無い場合は `DEPLOY_REMOTE_WP_CLI` でコマンド名を上書きする。
- XML が古いのに `npm run deploy:prod` を流すと、コンテンツが意図せず増える。
- テーマだけ変わったのに `deploy:prod` を使うと、余計な取り込みまで走る。

## 変更時の判断

- 本番同期の前提が変わったら、`tools/deploy.sh` を先に直す。
- その前提を説明している文書が複数ある場合は、本文を増やしすぎず、このスキルへの参照に寄せる。
- `DEPLOY_PORT` のような環境差分は、ドキュメントと `.env.deploy` の両方で矛盾しないようにする。
- デプロイ関連の説明を追加するときは、まずこのスキルに追記し、他の文書は短い案内に留める。

## 参照

- [deployment workflow](references/deploy.md)
