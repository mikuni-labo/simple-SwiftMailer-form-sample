<?php
require_once __DIR__ . './vendor/autoload.php';

$toMailAddress = 'wada@n-di.co.jp';

// SMTPトランスポートを使用
// SMTPサーバはlocalhost(Poftfix)を使用
// 他サーバにある場合は、そのホスト名orIPアドレスを指定する
//$transport = \Swift_SmtpTransport::newInstance('localhost', 25);
$transport = \Swift_SmtpTransport::newInstance('smtp.gmail.com', 465)
												->setUsername('redbull.816.com@gmail.com')
												->setPassword('hitopon7');

// メーラークラスのインスタンスを作成
$mailer = \Swift_Mailer::newInstance($transport);

// メッセージ作成
$message = \Swift_Message::newInstance()
	->setSubject('テストメール')
	->setTo($toMailAddress, '氏名')
	//->setBcc($toMailAddress, '管理者')
	->setFrom(array('redbull.816.com@gmail.com' => 'Mr.Foo'))
	->setBody('これはテストメールです。');

// メール送信
$result = $mailer->send($message);

echo $result;

exit;
