<?php

use Index\php\classes\{ DataBaseConnect, DataBaseRequest, VerifyIdentification, AutoLoading };

require(__DIR__ . "/../../classes/AutoLoading.php");

const AUTO_LOADING = new AutoLoading();
const DATABASE_CONNECT = new DataBaseConnect();
const VERIFY_IDENTIFICATION = new VerifyIdentification();
$dataBaseRequest = new DataBaseRequest(DATABASE_CONNECT->getLink());

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$response = VERIFY_IDENTIFICATION->start();

VERIFY_IDENTIFICATION->isProfileNotVerified($response, "../../../index.php");

VERIFY_IDENTIFICATION->isNotAdministrator("../../../index.php");

if (isset($_GET['uuid']) && !empty($_GET['uuid'])) {

    $uuid = htmlspecialchars($_GET['uuid']);
    $email = $dataBaseRequest->selectEmailAccount($uuid)['email'];

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

        $db = $dataBaseConnect->getLink();

        $row = $dataBaseRequest->existAccount($email);

        if ($row) {

            $token = bin2hex(openssl_random_pseudo_bytes(24));
            $tokenUser = bin2hex(openssl_random_pseudo_bytes(24));

            $insert = $db->prepare("INSERT INTO password_recover(token, token_user) VALUE (?, ?)");
            $insert->execute(array(
                $token, $tokenUser
            ));

            $dataBaseRequest->updateTokenAccount($email, $tokenUser);

            $dataBaseRequest->updateAccount($uuid);

            $link = "http://localhost/projet_communautaire/php/controller/recover_processing.php"
                . "?"
                . "tu=" . base64_encode($tokenUser)
                . "&"
                . "t=" . base64_encode($token);

            $messageMail = "Hello, click on this link to get a new password : $link";
            $headers = 'From: Content-Type: text/plain; charset="utf-8"' . " ";
            mail($email, "forgot password", $messageMail, $headers);
        }
        header("Location:" . "../../../page/dashboard-admin/watch-user.php?uuid=" . $uuid);
    }
} else {
    header("Location:" . "../../../page/error.php");
}
