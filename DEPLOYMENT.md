# Deployment Notes

Local WP からレンタルサーバーへ移すときのメモ。日常更新の手順は [UPDATE_TO_PROD.md](./UPDATE_TO_PROD.md) を参照する。
本番反映の詳細手順は [.codex/skills/wp-deploy/SKILL.md](./.codex/skills/wp-deploy/SKILL.md) に集約する。
迷ったら、まず `wp-deploy` スキルを読む。

## 最低限の流れ

1. 変更がテーマだけか、XML も更新したかを決める。
2. テーマだけなら `npm run deploy -- --delete`。
3. XML も更新したなら `npm run deploy:prod`。
4. 迷ったら [`wp-deploy` スキル](./.codex/skills/wp-deploy/SKILL.md) を読む。

## 生成物と前提

- `dist/0520portfolio-wp-theme.zip`: テーマアップロード用 ZIP
- `exports/yuremono-wp-content.xml`: WordPress インポーター用 XML
- `exports/yuremono-wp-db.sql`: Local WP の DB エクスポート
- `dist/` と `exports/` はローカル生成物なので Git 管理しない
- `DEPLOY_PORT`、`DEPLOY_PATH`、`DEPLOY_WP_PATH` の詳細はスキル側に集約する
