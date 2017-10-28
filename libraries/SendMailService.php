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
        if (! Filter::Email($this->params['email'])) {
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
        $mailbody  = "お問い合わせ内容は以下です。\n";
        $mailbody .= "\n◆ お名前: {$this->params['last_name']} {$this->params['first_name']}";
        $mailbody .= "\n◆ フリガナ: {$this->params['last_name_kana']} {$this->params['first_name_kana']}";
        $mailbody .= "\n◆ 性別： {$this->params['gender']}";
        $mailbody .= "\n◆ 生年月日： {$this->params['birth_y']}-{$this->params['birth_m']}-{$this->params['birth_d']}";
        $mailbody .= "\n◆ E-Mail: {$this->params['email']}";
        $mailbody .= "\n◆ Tel： {$this->params['tel1']}-{$this->params['tel2']}-{$this->params['tel3']}";
        $mailbody .= "\n◆ お問い合わせ内容： {$this->params['content']}";

        /**
         * フリーテキストフィールド（1〜7）
         */
        for ($i = 1; $i <= 7; $i++) {
            if (!empty($this->params["free_text{$i}"])) {
                $mailbody .= "\n◆ フリーテキスト{$i}： {$this->params["free_text{$i}"]}";
            }
        }

        /**
         * フリーテキストエリア（1〜3）
         */
        for ($i = 1; $i <= 3; $i++) {
            if (!empty($this->params["free_area{$i}"])) {
                $mailbody .= "\n◆ フリーエリア{$i}： {$this->params["free_area{$i}"]}";
            }
        }

        try {
            /**
             * SMTPトランスポート設定
             * デフォルトでlocalhost(Poftfix)、ポート25を使用
             */
            $transport = Swift_SmtpTransport::newInstance();

            if (SMTP_HOST !== "") {
                $transport->setHost(SMTP_HOST);
            }

            if (SMTP_PORT !== "") {
                $transport->setPort(SMTP_PORT);
            }

            if (SMTP_SECURITY !== "") {
                $transport->setEncryption(SMTP_SECURITY);
            }

            if (AUTH_USER !== "") {
                $transport->setUsername(AUTH_USER);
            }

            if (AUTH_PASS !== "") {
                $transport->setPassword(AUTH_PASS);
            }

            // メーラークラスのインスタンスを作成
            $mailer = Swift_Mailer::newInstance($transport);

            // メッセージ作成
            $message = Swift_Message::newInstance();
            $message->setTo(array(
                $this->params['email'] => $this->params['last_name']. ' ' .$this->params['first_name'],
            ));

            $message->setFrom(array(
                MAIL_FROM_ADDRESS => MAIL_FROM_NAME,
                // Add any more...
            ));

            $message->setSubject(MAIL_SUBJECT);
            $message->setBody($mailbody);

            if (MAIL_CC_ADDRESS !== "") {
                $message->setCc(array(
                    MAIL_CC_ADDRESS => MAIL_CC_NAME,
                    // Add any more...
                ));
            }

            if (MAIL_BCC_ADDRESS !== "") {
                $message->setBcc(array(
                    MAIL_BCC_ADDRESS => MAIL_BCC_NAME,
                    // Add any more...
                ));
            }

            if (MAIL_REPLY_TO_ADDRESS !== "") {
                $message->setReplyTo(array(
                    MAIL_REPLY_TO_ADDRESS => MAIL_REPLY_TO_NAME,
                    // Add any more...
                ));
            }

            return (bool) $mailer->send($message);

        } catch (Exception $e) {
            // 例外処理はここで

            return false;
        }

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
