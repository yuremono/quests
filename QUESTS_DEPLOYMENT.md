# Quests サブディレクトリ公開手順

このテーマは、既存の `https://yuremono.com/` 直下の WordPress とは分離し、サブディレクトリ側の別 WordPress で使う前提です。

## 推奨URL

```txt
https://yuremono.com/quests/
https://yuremono.com/quests/service/
```

## Xserver側で行うこと

1. Xserver サーバーパネルで `yuremono.com` を選択する。
2. WordPress簡単インストールで、サイトURLの入力欄に `quests` を指定する。
3. インストール先が `https://yuremono.com/quests/` になることを確認してから実行する。
4. 既存の `https://yuremono.com/` 直下の WordPress には上書きインストールしない。

## テーマ反映

1. このリポジトリを ZIP 化するか、SSH/SFTP でサーバーへアップロードする。
2. 配置先は、サブディレクトリ側 WordPress のテーマディレクトリにする。

```txt
yuremono.com/public_html/quests/wp-content/themes/quests/
```

3. サブディレクトリ側 WordPress 管理画面で、外観 → テーマから `Quests` を有効化する。
4. 固定ページ `Service` を作成し、スラッグを `service`、テンプレートを `Quests Service` に指定する。
5. 表示設定で、トップページは固定ページを使わず、テーマの `front-page.php` を表示させる。固定ページ運用にしたい場合は、トップ用固定ページにテンプレート `Quests Top` を指定する。

## ルートWordPressへの影響

`https://yuremono.com/` 直下の WordPress はそのまま残す。サブディレクトリに別 WordPress を入れる構成であれば、テーマファイル、プラグイン、管理画面、CSS は分離される。

注意点は、サブディレクトリ名 `quests` と同名の固定ページやリライトルールがルート側 WordPress にある場合です。その場合でも、実ディレクトリ `quests/` に WordPress を配置すれば通常は実ディレクトリが優先されますが、公開前に `https://yuremono.com/quests/` がサブディレクトリ側の管理画面・サイトを指していることを確認してください。
