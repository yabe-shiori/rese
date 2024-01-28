# Rese　 - 飲食店予約システム

# 概要

Reseは、Laravel Sailを基盤とした、直感的で使いやすい飲食店予約プラットフォームです。シンプルながらも強力な認証機能をLaravel Breezeで実装し、ユーザーが簡単にアカウントを作成し、お気に入りの飲食店を見つけて予約することができます。

![rese-top](https://github.com/yabe-shiori/rese/assets/142664073/afa3d6e6-0883-4050-b7a0-c663e1febd99)


## 主な機能　　
- 会員登録・ログイン: Laravel Breezeによる安全かつ迅速な認証システム。
- 認証 : より安全に使用するためのメール認証機能。
- 飲食店検索: エリア、ジャンル、店名での店舗検索が可能。
- 飲食店予約: 一覧から飲食店を選択し、希望の時間で簡単に予約。
- 予約確認: 予約が完了したら予約確認メールが自動送信。
- 決済: stripeを利用した決済機能の搭載。
- QRコード認証: 来店時に店舗が照合するQRコードを予約時に送信。
- リマインダーメール: 当日の朝にリマインダーメールが自動送信。
- お気に入り登録: お気に入りの店舗を保存し、後で素早くアクセス。
- レビュー投稿: 食事を楽しんだ後は、体験を共有するためのレビュー機能。
- マイページ: 自分の予約状況とお気に入り店舗を一目で確認、予約の削除や変更も可能。
- 管理者機能: 管理者専用のダッシュボードで、店舗代表者の作成やお知らせメールの送信。
- 店舗代表者機能: 店舗情報の作成と更新。予約状況の確認。

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

  
  
**管理者について** 

 ログイン画面にて、
- メールアドレス-> amdmin@example.com
- パスワード ->  password
を入力し、ログイン。メニューから管理者用のダッシュボードを選択する。

**店舗代表者について**　　

初期データで各店舗に紐づいた店舗代表者を作成しています。  

- メールアドレス-> manager(店舗id)@example.com  
- パスワード-> "password"(全店舗代表者で共通)  
  
店舗id1(仙人)、
メールアドレス-> manager1@example.com  
パスワード-> password  

店舗id2(牛助)
メールアドレス-> manager2@example.com  
パスワード-> password  

のように、店舗id順に設定してあります。
店舗代表者画面では、ログインしている店舗代表者の店舗情報が表示されます。


  


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

