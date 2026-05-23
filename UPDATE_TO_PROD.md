# 日常更新の本番反映フロー

このプロジェクトで、管理画面の編集やテーマ修正を本番へ反映するときの標準手順。
詳細な反映手順や `DEPLOY_PORT` / SSH config の扱いは [.codex/skills/wp-deploy/SKILL.md](./.codex/skills/wp-deploy/SKILL.md) を参照する。
この文書は入口だけにして、詰まりやすい手順はスキルへ寄せる。

## 使い分け

- テーマだけ変わった: `npm run deploy -- --delete`
- XML も更新した: `npm run deploy:prod`
- どちらを使うか迷う: `wp-deploy` スキルを読む

## 本番確認

- トップページが想定どおり出る
- 固定ページ、`work`、`news` が見える
- メニューが正しい位置に入っている
- フォーム送信が通る
- HTTPS で開く
- スマホ表示で崩れていない
- mixed content が出ていない

## 触る前の注意

- `DEPLOY_PATH` と `DEPLOY_PORT` はスキルと `tools/deploy.sh` に合わせる
- `exports/yuremono-wp-db.sql` は通常の本番反映では使わない
- ローカル用の `wp-load.php` パスやデモ投入スクリプトは対象サイトを確認してから使う
