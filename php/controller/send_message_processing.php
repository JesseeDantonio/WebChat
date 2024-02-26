<?php

use Index\php\classes\{DataBaseConnect, DataBaseRequest, AutoLoading, VerifyIdentification};

require_once(__DIR__ . "/../classes/AutoLoading.php");

const AUTO_LOADING = new AutoLoading();
const DATABASE_CONNECT = new DataBaseConnect();
$dataBaseRequest = new DataBaseRequest(DATABASE_CONNECT->getLink());
$verifyIdentification = new VerifyIdentification();

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$response = $verifyIdentification->start();

$verifyIdentification->isProfileNotVerified($response, "/../../index.php");

if (isset($_POST['content'])) {

    $message = strip_tags($_POST["content"]);

    if (strlen($message) != 0) {

        $profile = $response;

        $dataBaseRequest->postMessage($profile->getUUID(), $message);

        include_once(__DIR__ . '/../../php/controller/get_messages_processing.php');
    } else {
        header("Location:" . "../../page/error.php");
    }
} else {
    header("Location:" . "../../page/error.php");
}
