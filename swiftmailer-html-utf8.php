<?php
require_once 'vendor/autoload.php';

Dotenv::load(__DIR__);
$sendgrid_username = $_ENV['SENDGRID_USERNAME'];
$sendgrid_password = $_ENV['SENDGRID_PASSWORD'];
$tos               = explode(',', $_ENV['TOS']);
$names             = explode(',', $_ENV['NAMES']);
$from              = $_ENV['FROM'];

// create a transport
$transport = Swift_SmtpTransport::newInstance('smtp.sendgrid.net', 587, 'tls')
  ->setUsername($sendgrid_username)
  ->setPassword($sendgrid_password);
$mailer = Swift_Mailer::newInstance($transport);

// create a message
$message = Swift_Message::newInstance()
  ->setSubject('こんにちはSendGrid')
  ->setTo($from)
  ->setFrom($from)
  ->setBody(
    "こんにちは、nameさん\r\nようこそ〜テキストメールの世界へ！",
    'text/plain'
  )
  ->addPart(
    "<html>".
    "<body bgcolor=\"#d9edf7\" style=\"background-color: #d9edf7;\">".
    "こんにちは、nameさん<br>ようこそ〜HTMLメールの世界へ！<br>".
    "</body></html>",
    'text/html'
  )
  ->attach(Swift_Attachment::fromPath('./logo.gif'));

// x-smtpapi header
$smtpapi = new Smtpapi\Header();
$smtpapi->setTos($tos);
$smtpapi->addSubstitution('name', $names);
$smtpapi->addCategory('category1');
$headers = $message->getHeaders();
$headers->addTextHeader(
  'x-smtpapi', $smtpapi->jsonString(JSON_UNESCAPED_UNICODE)
);

// send the message
echo $message->toString();
echo $mailer->send($message);
