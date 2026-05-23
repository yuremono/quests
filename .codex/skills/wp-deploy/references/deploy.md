# WP Deploy Reference

## このスキルで扱うこと

- テーマの本番反映
- `npm run deploy` / `npm run deploy:prod`
- `tools/deploy.sh`
- `.env.deploy`
- `DEPLOY_PORT` と SSH config の扱い
- `exports/yuremono-wp-content.xml` の取り込み条件
- デプロイ関連ドキュメントの整理

## 1ページで見る判断

- コードだけ変わった: `npm run deploy -- --delete`
- テーマとコンテンツの両方が変わった: `npm run deploy:prod`
- ZIP だけ欲しい: `npm run deploy -- --zip-only --no-phpcs`
- SSH ポートに迷う: `DEPLOY_PORT` を見る。無ければ SSH config を読む
- XML の再実行が不安: まず更新元が本当に変わっているか確認する

### テーマのみ

1. `npm run deploy -- --delete`
2. 本番でテーマ反映を確認する

### テーマ + コンテンツ

1. `npm run deploy:prod`
2. メニュー、固定ページ、フォーム、SEO を確認する
3. `wp import` は同じ XML を何度も流さない

## ポート設定

- `DEPLOY_PORT` があればそれを優先する
- 未設定なら `ssh -G <host>` で SSH config の `port` を読む
- どちらもない場合は `22` を既定値にする
- 以前の `22` 固定は再発原因になりやすいので、運用メモでは書かない

## XML 取り込み

- 既定の XML は `exports/yuremono-wp-content.xml`
- `DEPLOY_IMPORT_XML` があればそれを優先する
- `DEPLOY_HOST` / `DEPLOY_USER` / `DEPLOY_PATH` が必要
- `DEPLOY_WP_PATH` を入れると WordPress ルートの推測失敗を避けられる
- リモートの `wp import` は `--authors=create` を付けている
- 失敗時は一時 XML が残ることがある

## ドキュメント整理の方針

- 詳細な手順はこの参照に集約する
- `README.md`、`DEPLOYMENT.md`、`UPDATE_TO_PROD.md`、`tools/AGENTS.md` は案内中心にする
- 具体的な実行コマンドは `tools/deploy.sh` とこの参照の整合を保つ
- 追加説明は `SKILL.md` に戻す
