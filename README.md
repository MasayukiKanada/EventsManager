# EventsManager

## ダウンロード方法

git clone
git clone https://github.com/MasayukiKanada/EventsManager


## インストール方法
- cd EventsManager
- composer install
- npm install
- npm run dev

.env.example をコピーして .envファイルを作成し、ご利用の環境に合わせて変更してください。

XAMPP/MAMPまたは他の開発環境でDBを起動した後に、
php artisan migrate:fresh --seed
を実行してください。

最後に
php artisan key:generate
と入力して、キーを生成後、
php artisan serve
でローカルサーバーを立ち上げ、表示確認してください。


## インストール後の実施事項

画像のリンク
php artisan storage:link

プロフィールページで画像アップロード機能を使う場合は、.envファイルのAPP_URLを下記に変更してください。
APP_URL=http://127.0.0.1:8000

Tailwindcss 3.xの、JustInTime機能により、 使ったHTML内クラスのみ反映されるようになっていますので、 HTMLを編集する際は、 npm run dev も実行しながら編集するようにしてください。
