# Quests

`https://yuremono.com/quests/` 用の WordPress テーマです。

既存の `https://yuremono.com/` 直下の WordPress とは分離し、サブディレクトリ `/quests/` 側の別 WordPress で運用します。テーマはクエストトップとサービスページの 2 ページ専用です。

## 現在の環境

- ローカル WordPress: `http://localhost:10014/`
- ローカルテーマ: `/Users/yanoseiji/Local Sites/quests/app/public/wp-content/themes/quests`
- テーマ実体: `/Users/yanoseiji/projects/0605quests`
- 本番 WordPress: `https://yuremono.com/quests/`
- 本番テーマ配置先: `~/yuremono.com/public_html/quests/wp-content/themes/quests/`
- GitHub: `git@github.com:yuremono/quests.git`

ローカルテーマパスは、テーマ実体へのシンボリックリンクです。コード編集と Git 操作は `/Users/yanoseiji/projects/0605quests` で行います。

## 要件

- WordPress 6.x
- PHP 8.x
- Advanced Custom Fields
- Local WP

このテーマには Node.js ビルド、CPT、XMLインポート運用はありません。`tools/` は Local WP / 本番 WordPress の環境初期化とデプロイ補助のために残しています。

## 管理画面の構成

固定ページ:

- `Front`
  - スラッグ: `front`
  - テンプレート: `Quests Top`
  - 表示設定のホームページに指定
- `Service`
  - スラッグ: `service`
  - テンプレート: `Quests Service`

ACFフィールドグループ:

- `Quests トップページ`
- `Quests サービスページ`

メニュー:

- メニュー位置: `Primary Navigation`
- メニュー名: `Quests Navigation`
- ヘッダーとフッターは同じ `primary` メニューを表示します。

## ローカル運用

1. Local WP で `quests` サイトを起動する。
2. `http://localhost:10014/` を確認する。
3. `Front` と `Service` の編集画面で ACF を編集する。
4. 外観 → メニューで `Quests Navigation` を編集する。
5. コード変更は `/Users/yanoseiji/projects/0605quests` で行う。

同じ WordPress 内で別テーマへ切り替えると、固定ページ、ACF入力値、メニューは同じDBを共有します。混乱を避けるため、クエストは専用Local WPサイトで管理します。

## 本番反映

本番反映は `https://yuremono.com/quests/` 側の WordPress だけを対象にします。ルートの `https://yuremono.com/` 側 WordPress は触りません。

詳細は [QUESTS_DEPLOYMENT.md](./QUESTS_DEPLOYMENT.md) を参照してください。

現在の反映先:

```txt
~/yuremono.com/public_html/quests/wp-content/themes/quests/
```

## tools/

[tools/](./tools/) には、汎用のデプロイ補助と、テーマ固有の初期化ツールを分けて置いています。

- `tools/deploy.sh`: 汎用の ZIP 作成と本番テーマ同期を行う。
- `tools/quests/run-bootstrap-quests-site.sh`: Local WP の `quests` サイトを `Front` / `Service` / ACF / メニュー構成へ整える。
- `tools/quests/bootstrap-quests-site.php`: WordPress 読み込み後に同じ初期化を行う。
- `tools/quests/deploy-quests.sh`: Quests テーマスラッグとZIP名を固定して `tools/deploy.sh` を実行する。

旧 `portfolio-wp` 用の `work` / `news` / 標準ページ seed は、このテーマでは使いません。

## 検証

実行できる範囲で以下を確認します。

```bash
find . -name '*.php' -not -path './vendor/*' -not -path './node_modules/*' -print0 | xargs -0 -n1 php -l
rtk git diff --check
```

Composer が使える環境では以下も実行します。

```bash
composer install
composer run phpcs
```

## 関連スキル

- `wp-admin`: ACF、固定ページテンプレート、メニュー管理を扱う。
- `wp-deploy`: Xserver の `/quests/` 側 WordPress へのテーマ反映を扱う。
