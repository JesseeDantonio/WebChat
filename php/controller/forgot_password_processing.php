<?php

use Index\php\classes\{ DataBaseConnect, DataBaseRequest, VerifyIdentification, AutoLoading };

require(__DIR__ . "/../classes/AutoLoading.php");

const AUTO_LOADING = new AutoLoading();
const DATABASE_CONNECT = new DataBaseConnect();
$dataBaseRequest = new DataBaseRequest(DATABASE_CONNECT->getLink());
const VERIFY_IDENTIFICATION = new VerifyIdentification();


if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$response = VERIFY_IDENTIFICATION->start();

VERIFY_IDENTIFICATION->isProfileNotVerified($response, "/../../index.php");

if (isset($_POST['form_forgot_email']) && !empty($_POST['form_forgot_email'])) {

    $email = htmlspecialchars($_POST['form_forgot_email']);

    $email = filter_var($email, FILTER_SANITIZE_EMAIL);

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

        $db = DATABASE_CONNECT->getLink();

        $row = $dataBaseRequest->existAccount($email);

        if ($row) {

            $token = bin2hex(openssl_random_pseudo_bytes(24));
            $tokenUser = bin2hex(openssl_random_pseudo_bytes(24));

            $insert = $db->prepare("INSERT INTO password_recover(token, token_user) VALUE (?, ?)");
            $insert->execute(array(
                $token, $tokenUser
            ));

            $dataBaseRequest->updateTokenAccount($email, $tokenUser);

            $dataBaseRequest->updateAccount($_SESSION['uuid']);

            $link = "http://localhost/projet_communautaire/php/controller/recover_processing.php"
                . "?"
                . "tu=" . base64_encode($tokenUser)
                . "&"
                . "t=" . base64_encode($token);

            $messageMail = "Hello, click on this link to get a new password : $link";
            $headers = 'From: Content-Type: text/plain; charset="utf-8"' . " ";
            mail($_POST['form_forgot_email'], "forgot password", $messageMail, $headers);
        }
        header("Location:" . "../../page/forgot.php?send_mail=success");
    }
} else {
    header("Location:" . "../../page/error.php");
}
