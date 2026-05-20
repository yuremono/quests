# Deployment Notes

Local WP からレンタルサーバーへ移す前に確認するメモ。

## 生成済みファイル

- `dist/0520portfolio-wp-theme.zip`: テーマアップロード用 ZIP。
- `exports/yuremono-wp-content.xml`: WordPress インポーター用の投稿・固定ページ・CPT エクスポート。
- `exports/yuremono-wp-db.sql`: Local WP の DB エクスポート。

`dist/` と `exports/` はローカル生成物なので Git 管理しない。

## 本番側でやること

1. WordPress をインストールする。
2. ACF、Contact Form 7、SEO SIMPLE PACK、WP Multibyte Patch、UpdraftPlus を入れる。
3. `dist/0520portfolio-wp-theme.zip` をテーマとしてアップロードする。
4. テーマを有効化する。
5. `exports/yuremono-wp-content.xml` を WordPress インポーターで取り込む。
6. メディア、固定ページ、Works、お知らせ、メニューを確認する。
7. 表示設定でホームページを固定ページにする。
8. パーマリンクを保存する。
9. Contact Form 7 の送信先・送信元を本番ドメイン用に直す。
10. SEO SIMPLE PACK のトップページ description、OGP画像、各ページのメタ情報を確認する。
11. SSL、バックアップ、スマホ表示、フォーム送信を確認する。

## 注意

- `exports/yuremono-wp-db.sql` は丸ごと移行や復元確認用。既存本番 DB に直接流すと上書き事故につながるため、通常は WXR インポートを優先する。
- Local URL は `http://localhost:10008`。本番移行後は URL 置換や画像URLを必ず確認する。
- 本番公開前に、デモ文言、仮メールアドレス、仮住所、不要な固定ページを確認する。
