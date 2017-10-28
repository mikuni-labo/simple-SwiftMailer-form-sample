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
        $param['first_name']       = !empty($_REQUEST['first_name'])      ? Filter::Get($_REQUEST['first_name'],      255) : '';
        $param['last_name']        = !empty($_REQUEST['last_name'])       ? Filter::Get($_REQUEST['last_name'],       255) : '';
        $param['first_name_kana']  = !empty($_REQUEST['first_name_kana']) ? Filter::Get($_REQUEST['first_name_kana'], 255, '[^あ-ヾァ-ヶー\-]', 'KVC') : '';
        $param['last_name_kana']   = !empty($_REQUEST['last_name_kana'])  ? Filter::Get($_REQUEST['last_name_kana'],  255, '[^あ-ヾァ-ヶー\-]', 'KVC') : '';
        $param['gender']           = !empty($_REQUEST['gender'])          ? Filter::Get($_REQUEST['gender'],          255) : '';
        $param['email']            = !empty($_REQUEST['email'])           ? Filter::Get($_REQUEST['email'],           255, null, 'a') : '';
        $param['birth_y']          = !empty($_REQUEST['birth_y'])         ? Filter::Get($_REQUEST['birth_y'],         4, "[^0-9]", "a") : '';
        $param['birth_m']          = !empty($_REQUEST['birth_m'])         ? Filter::Get($_REQUEST['birth_m'],         2, "[^0-9]", "a") : '';
        $param['birth_d']          = !empty($_REQUEST['birth_d'])         ? Filter::Get($_REQUEST['birth_d'],         2, "[^0-9]", "a") : '';
        $param['tel1']             = !empty($_REQUEST['tel1'])            ? Filter::Get($_REQUEST['tel1'],            5, "[^0-9]", "a") : '';
        $param['tel2']             = !empty($_REQUEST['tel2'])            ? Filter::Get($_REQUEST['tel2'],            5, "[^0-9]", "a") : '';
        $param['tel3']             = !empty($_REQUEST['tel3'])            ? Filter::Get($_REQUEST['tel3'],            5, "[^0-9]", "a") : '';
        $param['content']          = !empty($_REQUEST['content'])         ? Filter::Get($_REQUEST['content'],         5000) : '';
        
        $param['free_text1']       = !empty($_REQUEST['free_text1'])      ? Filter::Get($_REQUEST['free_text1'],      255) : '';
        $param['free_text2']       = !empty($_REQUEST['free_text2'])      ? Filter::Get($_REQUEST['free_text2'],      255) : '';
        $param['free_text3']       = !empty($_REQUEST['free_text3'])      ? Filter::Get($_REQUEST['free_text3'],      255) : '';
        $param['free_text4']       = !empty($_REQUEST['free_text4'])      ? Filter::Get($_REQUEST['free_text4'],      255) : '';
        $param['free_text5']       = !empty($_REQUEST['free_text5'])      ? Filter::Get($_REQUEST['free_text5'],      255) : '';
        $param['free_text6']       = !empty($_REQUEST['free_text6'])      ? Filter::Get($_REQUEST['free_text6'],      255) : '';
        $param['free_text7']       = !empty($_REQUEST['free_text7'])      ? Filter::Get($_REQUEST['free_text7'],      255) : '';
        
        $param['free_area1']       = !empty($_REQUEST['free_area1'])      ? Filter::Get($_REQUEST['free_area1'],      5000) : '';
        $param['free_area2']       = !empty($_REQUEST['free_area2'])      ? Filter::Get($_REQUEST['free_area2'],      5000) : '';
        $param['free_area3']       = !empty($_REQUEST['free_area3'])      ? Filter::Get($_REQUEST['free_area3'],      5000) : '';
        
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
        if(! Filter::Email($this->param['email']))
            $this->error['email'] = "E-Mailの入力形式が正しくありません。";
        
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
        $mailbody  = "お問い合わせ内容は以下です。\n\n";
        $mailbody .= "◆ お名前: {$this->param['last_name']} {$this->param['first_name']}\n";
        $mailbody .= "◆ フリガナ: {$this->param['last_name_kana']} {$this->param['first_name_kana']}\n";
        $mailbody .= "◆ 性別： {$this->param['gender']}\n";
        $mailbody .= "◆ 生年月日： {$this->param['birth_y']}-{$this->param['birth_m']}-{$this->param['birth_d']}\n";
        $mailbody .= "◆ E-Mail: {$this->param['email']}\n";
        $mailbody .= "◆ Tel： {$this->param['tel1']}-{$this->param['tel2']}-{$this->param['tel3']}\n";
        $mailbody .= "◆ お問い合わせ内容： {$this->param['content']}\n";
        
        if(!empty($this->param['free_text1']))
            $mailbody .= "◆ フリーテキスト1： {$this->param['free_text1']}\n";
        
        if(!empty($this->param['free_text2']))
            $mailbody .= "◆ フリーテキスト2： {$this->param['free_text2']}\n";
        
        if(!empty($this->param['free_text3']))
            $mailbody .= "◆ フリーテキスト3： {$this->param['free_text3']}\n";
        
        if(!empty($this->param['free_text4']))
            $mailbody .= "◆ フリーテキスト4： {$this->param['free_text4']}\n";
        
        if(!empty($this->param['free_text5']))
            $mailbody .= "◆ フリーテキスト5： {$this->param['free_text5']}\n";
        
        if(!empty($this->param['free_text6']))
            $mailbody .= "◆ フリーテキスト6： {$this->param['free_text6']}\n";
        
        if(!empty($this->param['free_text7']))
            $mailbody .= "◆ フリーテキスト7： {$this->param['free_text7']}\n";
        
        if(!empty($this->param['free_area1']))
            $mailbody .= "◆ フリーエリア1： {$this->param['free_area1']}\n";
        
        if(!empty($this->param['free_area2']))
            $mailbody .= "◆ フリーエリア2： {$this->param['free_area2']}\n";
        
        if(!empty($this->param['free_area3']))
            $mailbody .= "◆ フリーエリア3： {$this->param['free_area3']}\n";
        
        $mailbody .= "\n";
        
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
                        ->setBody($mailbody);
            
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
