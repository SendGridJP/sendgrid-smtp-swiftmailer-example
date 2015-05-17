#sendgrid-smtp-swiftmailer-example

========================
 本コードはSwiftMailer(PHP)を使ってSendGrid(SMTP)経由でメールを送信するサンプルです。

## 使い方

```bash
git clone https://github.com/SendGridJP/sendgrid-smtp-swiftmailer-example.git
cd sendgrid-smtp-swiftmailer-example
cp .env.example .env
# .envファイルを編集してください
bundle install
# テキストメールを送る(JIS)
php swiftmailer-text-jis.php
# テキストメールを送る(UTF-8)
php swiftmailer-text-utf8.php
# HTMLメールを送る(JIS)
php swiftmailer-html-jis.php
# HTMLメールを送る(UTF-8)
php swiftmailer-html-utf8.php
```

## .envファイルの編集
.envファイルは以下のような内容になっています。

```bash
SENDGRID_USERNAME=your_username
SENDGRID_PASSWORD=your_password
TOS=you@youremail.com,friend1@friendemail.com,friend2@friendemail.com
NAMES=名前1,名前2,名前3,名前4
FROM=you@youremail.com
```
SENDGRID_USERNAME:SendGridのユーザ名を指定してください。  
SENDGRID_PASSWORD:SendGridのパスワードを指定してください。  
TOS:宛先をカンマ区切りで指定してください。  
NAMES:宛先毎の宛名をカンマ区切りで指定してください。
FROM:送信元アドレスを指定してください。  
