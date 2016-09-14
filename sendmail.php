<?php
require_once ('./require_page.php');

if($_SERVER['REQUEST_METHOD'] === 'POST')
{
	$Page = new Page();
	$Page->run();
}

/**
 * メインフロー
 */
class Page
{
	public function run()
	{
		$ValidateForSendMail = new ValidateForSendMail();
		$ValidateForSendMail->Filter();
		
		if( $ValidateForSendMail->Validator() === true)
			$result = $ValidateForSendMail->sendMail();
		
		$ValidateForSendMail->redirect();
	}
}

/**
 * 処理クラス
 */
class ValidateForSendMail
{
	private $param;
	private $error;
	
	public function __construct()
	{
		//
	}
	
	/**
	 * Filter...
	 *
	 * @return array
	 */
	public function Filter()
	{
		$param                     = array();
		$param["first_name"]       = Filter::Get($_REQUEST["first_name"],       255);
		$param["last_name"]        = Filter::Get($_REQUEST["last_name"],        255);
		$param["email"]            = Filter::Get($_REQUEST["email"],            255, null, "a");
		$param["content"]          = Filter::Get($_REQUEST["content"],          3000);
		
		$this->param = $param;
		return $param;
	}
	
	/**
	 * Validator...
	 * 
	 * @return bool
	 */
	public function Validator()
	{
		if(! Filter::Email($this->param["email"]))
			$this->error["email"] = "E-Mailの入力形式が正しくありません。";
		
		if( count($this->error) === 0 ) return true;
		else return false;
	}
	
	/**
	 * Send Mail...
	 *
	 * @return bool
	 */
	public function sendMail()
	{
		try {
			// SMTPトランスポートを使用
			// SMTPサーバはlocalhost(Poftfix)を使用
			// 他サーバにある場合は、そのホスト名orIPアドレスを指定する
			$transport = Swift_SmtpTransport::newInstance(SMTP_HOST, SMTP_PORT, SMTP_SECURITY)
						->setUsername(AUTH_USER)
						->setPassword(AUTH_PASS);
			
			// メーラークラスのインスタンスを作成
			$mailer = Swift_Mailer::newInstance($transport);
			
			// メッセージ作成
			$message = Swift_Message::newInstance()
						->setTo($this->param['email'], $this->param['last_name']. ' ' .$this->param['first_name'])
						->setBcc(MAIL_BCC_ADDRESS, MAIL_BCC_NAME)
						->setReplyTo(MAIL_REPLY_TO_ADDRESS, MAIL_REPLY_TO_NAME)
						->setFrom(array(
								MAIL_FROM_ADDRESS => MAIL_FROM_NAME,
						))
						->setSubject(MAIL_SUBJECT)
						->setBody($this->param['content']);
			
			// メール送信
			$result = $mailer->send($message);
		}
		catch (Exception $e)
		{
			// 例外処理はここで
			//echo $e->getMessage();
			$result = 0;
		}
		
		return $result;
	}
	
	/**
	 * Redirect...
	 *
	 * @return void
	 */
	public function redirect()
	{
		$url = REDIRECT_URL;
		header("Location: {$url}");
		exit;
	}
}
