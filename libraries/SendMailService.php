<?php

/**
 * 処理クラス
 */
class SendMailService
{
    private $params = array();
    private $errors = array();

    public function __construct()
    {
    }

    /**
     * Filtering parameters.
     *
     * @return array
     */
    public function filter()
    {
        $this->params['first_name']       = !empty($_REQUEST['first_name'])      ? Filter::Get($_REQUEST['first_name'],      255) : '';
        $this->params['last_name']        = !empty($_REQUEST['last_name'])       ? Filter::Get($_REQUEST['last_name'],       255) : '';
        $this->params['first_name_kana']  = !empty($_REQUEST['first_name_kana']) ? Filter::Get($_REQUEST['first_name_kana'], 255, '[^あ-ヾァ-ヶー\-]', 'KVC') : '';
        $this->params['last_name_kana']   = !empty($_REQUEST['last_name_kana'])  ? Filter::Get($_REQUEST['last_name_kana'],  255, '[^あ-ヾァ-ヶー\-]', 'KVC') : '';
        $this->params['gender']           = !empty($_REQUEST['gender'])          ? Filter::Get($_REQUEST['gender'],          255) : '';
        $this->params['email']            = !empty($_REQUEST['email'])           ? Filter::Get($_REQUEST['email'],           255, null, 'a') : '';
        $this->params['birth_y']          = !empty($_REQUEST['birth_y'])         ? Filter::Get($_REQUEST['birth_y'],         4, "[^0-9]", "a") : '';
        $this->params['birth_m']          = !empty($_REQUEST['birth_m'])         ? Filter::Get($_REQUEST['birth_m'],         2, "[^0-9]", "a") : '';
        $this->params['birth_d']          = !empty($_REQUEST['birth_d'])         ? Filter::Get($_REQUEST['birth_d'],         2, "[^0-9]", "a") : '';
        $this->params['tel1']             = !empty($_REQUEST['tel1'])            ? Filter::Get($_REQUEST['tel1'],            5, "[^0-9]", "a") : '';
        $this->params['tel2']             = !empty($_REQUEST['tel2'])            ? Filter::Get($_REQUEST['tel2'],            5, "[^0-9]", "a") : '';
        $this->params['tel3']             = !empty($_REQUEST['tel3'])            ? Filter::Get($_REQUEST['tel3'],            5, "[^0-9]", "a") : '';
        $this->params['content']          = !empty($_REQUEST['content'])         ? Filter::Get($_REQUEST['content'],         5000) : '';

        $this->params['free_text1']       = !empty($_REQUEST['free_text1'])      ? Filter::Get($_REQUEST['free_text1'],      255) : '';
        $this->params['free_text2']       = !empty($_REQUEST['free_text2'])      ? Filter::Get($_REQUEST['free_text2'],      255) : '';
        $this->params['free_text3']       = !empty($_REQUEST['free_text3'])      ? Filter::Get($_REQUEST['free_text3'],      255) : '';
        $this->params['free_text4']       = !empty($_REQUEST['free_text4'])      ? Filter::Get($_REQUEST['free_text4'],      255) : '';
        $this->params['free_text5']       = !empty($_REQUEST['free_text5'])      ? Filter::Get($_REQUEST['free_text5'],      255) : '';
        $this->params['free_text6']       = !empty($_REQUEST['free_text6'])      ? Filter::Get($_REQUEST['free_text6'],      255) : '';
        $this->params['free_text7']       = !empty($_REQUEST['free_text7'])      ? Filter::Get($_REQUEST['free_text7'],      255) : '';

        $this->params['free_area1']       = !empty($_REQUEST['free_area1'])      ? Filter::Get($_REQUEST['free_area1'],      5000) : '';
        $this->params['free_area2']       = !empty($_REQUEST['free_area2'])      ? Filter::Get($_REQUEST['free_area2'],      5000) : '';
        $this->params['free_area3']       = !empty($_REQUEST['free_area3'])      ? Filter::Get($_REQUEST['free_area3'],      5000) : '';
    }

    /**
     * Validating requests.
     *
     * @return bool
     */
    public function isValid()
    {
        if(! Filter::Email($this->params['email'])) {
            $this->errors['email'] = "E-Mailの入力形式が正しくありません。";
        }

        return (bool) count($this->errors);
    }

    /**
     * Send Mail...
     *
     * @return bool
     */
    public function sendMail()
    {
        $mailbody  = "お問い合わせ内容は以下です。\n\n";
        $mailbody .= "◆ お名前: {$this->params['last_name']} {$this->params['first_name']}\n";
        $mailbody .= "◆ フリガナ: {$this->params['last_name_kana']} {$this->params['first_name_kana']}\n";
        $mailbody .= "◆ 性別： {$this->params['gender']}\n";
        $mailbody .= "◆ 生年月日： {$this->params['birth_y']}-{$this->params['birth_m']}-{$this->params['birth_d']}\n";
        $mailbody .= "◆ E-Mail: {$this->params['email']}\n";
        $mailbody .= "◆ Tel： {$this->params['tel1']}-{$this->params['tel2']}-{$this->params['tel3']}\n";
        $mailbody .= "◆ お問い合わせ内容： {$this->params['content']}\n";

        if(!empty($this->params['free_text1']))
            $mailbody .= "◆ フリーテキスト1： {$this->params['free_text1']}\n";

        if(!empty($this->params['free_text2']))
            $mailbody .= "◆ フリーテキスト2： {$this->params['free_text2']}\n";

        if(!empty($this->params['free_text3']))
            $mailbody .= "◆ フリーテキスト3： {$this->params['free_text3']}\n";

        if(!empty($this->params['free_text4']))
            $mailbody .= "◆ フリーテキスト4： {$this->params['free_text4']}\n";

        if(!empty($this->params['free_text5']))
            $mailbody .= "◆ フリーテキスト5： {$this->params['free_text5']}\n";

        if(!empty($this->params['free_text6']))
            $mailbody .= "◆ フリーテキスト6： {$this->params['free_text6']}\n";

        if(!empty($this->params['free_text7']))
            $mailbody .= "◆ フリーテキスト7： {$this->params['free_text7']}\n";

        if(!empty($this->params['free_area1']))
            $mailbody .= "◆ フリーエリア1： {$this->params['free_area1']}\n";

        if(!empty($this->params['free_area2']))
            $mailbody .= "◆ フリーエリア2： {$this->params['free_area2']}\n";

        if(!empty($this->params['free_area3']))
            $mailbody .= "◆ フリーエリア3： {$this->params['free_area3']}\n";

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

            var_dump($transport);exit;

            // メッセージ作成
            $message = Swift_Message::newInstance()
                        ->setTo($this->params['email'], $this->params['last_name']. ' ' .$this->params['first_name'])
                        ->setCc(MAIL_CC_ADDRESS, MAIL_CC_NAME)
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
        header("Location: " . REDIRECT_URL);
        exit;
    }
}
