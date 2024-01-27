# Rese　 - 飲食店予約システム

# 概要

Reseは、Laravel Sailを基盤とした、直感的で使いやすい飲食店予約プラットフォームです。シンプルながらも強力な認証機能をLaravel Breezeで実装し、ユーザーが簡単にアカウントを作成し、お気に入りの飲食店を見つけて予約することができます。

![トップ画面の画像]()


## 主な機能　　
- 会員登録・ログイン: Laravel Breezeによる安全かつ迅速な認証システム。  
- 飲食店予約: 一覧から飲食店を選択し、希望の時間で簡単に予約。  
- お気に入り登録: お気に入りの店舗を保存し、後で素早くアクセス。
- レビュー投稿: 食事を楽しんだ後は、体験を共有するためのレビュー機能。
- マイページ: 自分の予約状況とお気に入り店舗を一目で確認。
- 管理者機能: 管理者専用のダッシュボードで、店舗代表者の管理やお知らせメールの送信。
- 店舗代表者機能: 店舗情報の詳細な管理と更新。

## インストール

1.プロジェクトのクローン  
`git clone https://github.com/yabe-shiori/`  
  
プロジェクトディレクトリに移動します。    
`cd rese`  

2.環境変数の設定
.env.exampleファイルをコピーして.envファイルを作成し、必要な環境変数を設定します。  
`cp .env.example .env`  

DB_CONNECTION=mysql  
DB_HOST=mysql  
DB_PORT=3306  
DB_DATABASE=rese 
DB_USERNAME=sail  
DB_PASSWORD=password  

3.Composerパッケージのインストール  
`composer install`

4.Docker環境のセットアップ  
laravelSailを使用してDocker環境をセットアップします。  
`./vendor/bin/sail up -d`    

5.アプリケーションキーの生成  
`./vendor/bin/sail artisan key:generate`    
  
6.NPMパッケージのインストール  
`./vendor/bin/sail npm install`    

7.データベースのセットアップと初期データの投入  
`./vendor/bin/sail artisan migrate:refresh --seed `  

8.アセットのコンパイル  
`./vendor/bin/sail npm run dev`        

9.アプリケーションの実行  
・Webブラウザで[http://localhost](http://localhost)にアクセスして、アプリケーションが正しく動作していることを確認します。  

  
  
**管理者** 
  
1.会員登録  
- 名前 ->  
- メールアドレス  
- パスワード ->   
  


注意事項:


**メール通知について**  
MailPitを利用しています。  
[http://localhost:8025](http://localhost:8025)にアクセスして通知メールを確認してください。  

## 機能一覧



<br />

## 使用技術

| Category          | Technology Stack                                     |
| ----------------- | --------------------------------------------------   |
| Frontend          | npm, Tailwind CSS                                    |
| Backend           | Laravel, PHP                                         |
| Infrastructure    | Amazon Web Services                                  |
| Database          | MySQL                                                |
| Environment setup | Docker, Laravel Sail                                 |
| etc.              | Git, GitHub                                          |

<br />

## ER図

![ER図]()

<br />

