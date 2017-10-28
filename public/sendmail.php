<?php
require_once ('../require.php'); // require.phpまでのパスを記述

$SendMailService = new SendMailService();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $SendMailService->filter();

    if (! $SendMailService->isValid()) {
        $result = $SendMailService->sendMail();
    }
}

$SendMailService->redirect();

