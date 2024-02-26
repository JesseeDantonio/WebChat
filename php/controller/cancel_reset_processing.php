<?php

use Index\php\classes\{ DataBaseConnect, DataBaseRequest, VerifyIdentification };

require_once(__DIR__ . "/../classes/DataBaseConnect.php");
require_once(__DIR__ . "/../classes/DataBaseRequest.php");
require_once(__DIR__ . "/../classes/VerifyIdentification.php");
require_once(__DIR__ . "/../classes/Profile.php");

$dataBaseConnect = new DataBaseConnect();
$dataBaseRequest = new DataBaseRequest($dataBaseConnect->getLink());
$verifyIdentification = new VerifyIdentification();

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$response = $verifyIdentification->start();

$verifyIdentification->isProfileVerified($response, "/../../index.php");

if (isset($_POST['form_token']) && !empty($_POST['form_token'])) {

    $tokenUser = htmlspecialchars($_POST['form_token']);

    $dataBaseRequest->resetTokens(base64_decode($tokenUser));

    $dataBaseRequest->resetTokenAccount(base64_decode($tokenUser));

    header("Location:" . "../../index.php");
} else {
    header("Location:" . "../../page/error.php");
}
