# Rese

# 概要

このアプリケーションは、従業員の勤怠を管理するためのシンプルなアプリケーションです。

![トップ画面の画像]()


## 目的



 ## 特長

- 
- 
- 
- 

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
./vendor/bin/sail artisan migrate:refresh --seed  

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

