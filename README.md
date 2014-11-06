#sendgrid-smtp-swiftmailer-example

========================
 本コードはSendGridのSMTPサービスの利用サンプルです。

## 使い方

```bash
git clone https://github.com/SendGridJP/sendgrid-smtp-swiftmailer-example.git
cd sendgrid-smtp-swiftmailer-example
cp .env.example .env
# .envファイルを編集してください
bundle install
php sendgrid-smtp-jis.php
php sendgrid-smtp-utf8.php
```

## .envファイルの編集
.envファイルは以下のような内容になっています。

```bash
SENDGRID_USERNAME=your_username
SENDGRID_PASSWORD=your_password
TOS=you@youremail.com,friend1@friendemail.com,friend2@friendemail.com
FROM=you@youremail.com
```
SENDGRID_USERNAME:SendGridのユーザ名を指定してください。  
SENDGRID_PASSWORD:SendGridのパスワードを指定してください。  
TOS:宛先をカンマ区切りで指定してください。  
FROM:送信元アドレスを指定してください。  
