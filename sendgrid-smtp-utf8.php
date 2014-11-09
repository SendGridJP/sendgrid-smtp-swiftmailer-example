<?php
require_once "vendor/autoload.php";

Dotenv::load(__DIR__);
$sendgrid_username = $_ENV["SENDGRID_USERNAME"];
$sendgrid_password = $_ENV["SENDGRID_PASSWORD"];
$from              = $_ENV["FROM"];
$tos               = explode(",", $_ENV["TOS"]);

// create a message
$transport = Swift_SmtpTransport::newInstance("smtp.sendgrid.net", 587, "tls")
  ->setUsername($sendgrid_username)
  ->setPassword($sendgrid_password);
$mailer = Swift_Mailer::newInstance($transport);
$attachment = Swift_Attachment::fromPath("./gif.gif");
$message = Swift_Message::newInstance()
  ->setSubject("[sendgrid-smtp-swiftmailer-example] フクロウのお名前は fullname さん")
  ->setTo("dummy@test.com")
  ->setFrom($from)
  ->setBody("familynameさんは何をしていますか？\r\n 彼はplaceにいます。", "text/plain")
  ->addPart("<strong>familynameさんは何をしていますか？</strong><br />彼はplaceにいます。", "text/html")
  ->attach($attachment);

// x-smtpapi header
$smtpapi = new Smtpapi\Header();
$smtpapi->setTos($tos);
$smtpapi->addSubstitution("fullname", array("田中 太郎", "佐藤 次郎", "鈴木 三郎"));
$smtpapi->addSubstitution("familyname", array("田中", "佐藤", "鈴木"));
$smtpapi->addSubstitution("place", array("office", "home", "office"));
$smtpapi->addSection("office", "中野");
$smtpapi->addSection("home", "目黒");
$smtpapi->addCategory("Category1");
$headers = $message->getHeaders();
$headers->addTextHeader("x-smtpapi", $smtpapi->jsonString());

// send the message
$result = $mailer->send($message);
//echo $headers->toString();
echo $result;
