<?php
/*
 |--------------------------------------------------------------------------
 | Data Definition File...
 |--------------------------------------------------------------------------
 |
 | 各種データ定義用ファイルです
 |
 | @author Kuniyasu Wada
 |
 */
define("SITE_NAME", "");
define("HTTP_URL", "");// スラッシュ無し
define("REDIRECT_URL", "");// スラッシュ無し


/**
 * 送信サーバ
 */
define("SMTP_HOST", "");// example.com
define("SMTP_PORT", "");// 465
define("SMTP_SECURITY", "");// ssl
define("AUTH_USER", "");// SMTP USER ID
define("AUTH_PASS", "");// SMTP USER PASSWORD


/**
 * メール関連
 */
// 差出人 (メールを送信するには差出人に正しいアカウント認証情報が必要です)
define("MAIL_FROM_ADDRESS", "");// info@example.com
define("MAIL_FROM_NAME", "");// 差出人名

// 返信先
define("MAIL_REPLY_TO_ADDRESS", "");// sample@example.com
define("MAIL_REPLY_TO_NAME", "");// 返信先名

// CC
define("MAIL_CC_ADDRESS", "");// cc@example.com
define("MAIL_CC_NAME", "");// CC受信者名

// BCC
define("MAIL_BCC_ADDRESS", "");// bcc@example.com
define("MAIL_BCC_NAME", "");// BCC受信者名

// 件名
define("MAIL_SUBJECT", "件名");// お問い合わせありがとうございます。


/**
 * サーバ・PHP設定調整
 */
ini_set('display_errors', 0);
ini_set("error_reporting", "E_ALL ^ E_NOTICE");
ini_set("mbstring.detect_order", "auto");
ini_set("mbstring.http_input", "auto");
ini_set("mbstring.internal_encoding", "UTF-8");
mb_language("Japanese");
