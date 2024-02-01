# Rese　 - 飲食店予約システム

# 概要
**はじめに - このプロジェクトのビジョン**　　

食は、生命を維持する基本的な行為を超え、私たちの文化の核を成し、人生の最も豊かな瞬間を彩るものです。家族や友人との絆を深め、新たな出会いを創出し、記憶に残る体験を提供します。しかし、日々の喧騒の中で、心地よい食事の場を予約することが意外にも煩わしい障壁となっていました。このギャップを埋めるため、私は「Rese」を創り出しました。

「Rese」は、ただの予約システムに留まらず、人々の生活に溶け込むシームレスな接続点を目指しています。直観的な操作性、効率的な予約プロセス、そして何よりもお客様一人ひとりの貴重な時間を尊重する設計。それぞれの瞬間を、特別なものへと昇華させるために。

Laravel Sailを骨格に、Laravel Breezeで洗練された認証プロセスを統合し、それぞれのユーザーが直感的に操作できる環境を提供します。

このプロジェクトは、ただ予約を受け付けるだけではなく、食を通じて人々の生活に意味と喜びをもたらすことを使命としています。私の願いは、Reseが食文化の新たな潮流を生み出し、一人ひとりの食卓がもっと輝く未来を創造することです。

![トップ画像](https://github.com/yabe-shiori/rese/assets/142664073/317577fe-3f3a-471f-b654-ca38bc0a50af)

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

<br />

## インストール

### 1.プロジェクトのクローン  
git clone https://github.com/yabe-shiori/rese.git

  
### 2. プロジェクトディレクトリに移動    
`cd rese`  

### 3. Composerパッケージのインストール
`composer install`  


### 4. 環境変数の設定
`.env.example`ファイルをコピーして`.env`ファイルを作成し、必要な環境変数を設定します。  
`cp .env.example .env`  

DB_CONNECTION=mysql  
DB_HOST=mysql  
DB_PORT=3306  
DB_DATABASE=rese 
DB_USERNAME=sail  
DB_PASSWORD=password  


### 5. Docker環境のセットアップ
laravelSailを使用してDocker環境をセットアップします。  
`./vendor/bin/sail up -d`  

  

### 6. アプリケーションキーの生成
`./vendor/bin/sail artisan key:generate`  

  
  
### 7. NPMパッケージのインストール
`./vendor/bin/sail npm install`  

  

### 8. データベースのセットアップと初期データの投入 
`./vendor/bin/sail artisan migrate:refresh --seed `  

  
### 9. アセットのコンパイル  
`./vendor/bin/sail npm run dev`  

  

### 10. アプリケーションの実行
・Webブラウザで[http://localhost](http://localhost)にアクセスして、アプリケーションが正しく動作していることを確認します。  

### 11. タスクスケジューラーの設定  

タスクの自動実行を設定するために、以下の手順に従ってCronを設定してください。  

1. Laravel Sailのコンテナにrootユーザーとして入ります。

`./vendor/bin/sail root-shell`    

2. コンテナ内でcronをインストールします。    
`apt-get update && apt-get install -y cron`    

4. nanoエディタをインストールします。    
`apt-get install nano -y`    

もしくは、vimエディタをインストールしたい場合は：    
`apt-get install vim -y`      

4. エディタのインストール後、Cronの設定を行います。    
`crontab -e`    

5. エディタが開いたら、以下の行を追加します。    
`* * * * * cd /var/www/html && php artisan schedule:run >> /dev/null 2>&1`    

変更を保存し、エディタを閉じます。      

7. Cronサービスを起動します。    
`service cron start`    

これで、Laravelのスケジュールされたタスクが処理されるようになります。    

<br />  

## 注意事項: 

**利用者について**  
  
- メールアドレス-> user@example.com
- パスワード-> password  
マイページで予約の変更や削除が行えます。
 
**管理者について** 

 ログイン画面にて、
- メールアドレス-> amdmin@example.com
- パスワード ->  password
を入力し、ログイン。メニューから管理者用のダッシュボードを選択する。

**店舗代表者について**　　

初期データで各店舗に紐づいた店舗代表者を作成しています。  

- メールアドレス-> manager(店舗id)@example.com  
- パスワード-> "password"(全店舗代表者で共通)  
  
店舗id1(仙人)  
メールアドレス-> manager1@example.com  
パスワード-> password  

店舗id2(牛助)  
メールアドレス-> manager2@example.com   
パスワード-> password    

のように、店舗id順に設定してあります。
店舗代表者画面では、ログインしている店舗代表者の店舗情報が表示されます。  

  
**メール通知について**  
MailPitを利用しています。  
[http://localhost:8025](http://localhost:8025)にアクセスして通知メールを確認してください。  


<br />

## 使用技術

| Category          | Technology Stack                                     |
| ----------------- | --------------------------------------------------   |
| Frontend          | npm, Tailwind CSS                                    |
| Infrastructure    | Amazon Web Services                                  |
| Backend           | Laravel, PHP                                         |
| Infrastructure    | Amazon Web Services                                  |
| Database          | MySQL                                                |
| Environment setup | Docker, Laravel Sail                                 |
| etc.              | Git, GitHub                                          |

<br />

## AWS構成図

![AWS構成図](https://github.com/yabe-shiori/rese/assets/142664073/1efc7daf-af55-4b83-9cbf-f1aad0721284)

<br />

## ER図

![ER図](https://github.com/yabe-shiori/rese/assets/142664073/b89d6849-2787-4a15-bab0-1a8e7065fa15)

<br />

