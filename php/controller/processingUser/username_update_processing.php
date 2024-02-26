<?php

use Index\php\classes\{DataBaseConnect, DataBaseRequest, VerifyIdentification, AutoLoading};

require(__DIR__ . "/../../classes/AutoLoading.php");

const AUTO_LOADING = new AutoLoading();
const DATABASE_CONNECT = new DataBaseConnect();
$dataBaseRequest = new DataBaseRequest(DATABASE_CONNECT->getLink());
const VERIFY_IDENTIFICATION = new VerifyIdentification();

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$response = VERIFY_IDENTIFICATION->start();

VERIFY_IDENTIFICATION->isProfileNotVerified($response, "/../../../index.php");


if (isset($_POST['form_change_username'])) {

    if (!empty($_POST['form_change_username'])) {

        $profile = $response;

        
        if (strlen($username) <= 100) {

            $username = strip_tags($_POST['form_change_username']);

            $dataBaseRequest->updateUsernameAccount($profile->getUUID(), $username);

            $profile->setUsername($username);

            $_SESSION['userProfile'] = serialize($profile);

            $dataBaseRequest->updateAccount($profile->getUUID());

            header("Location:" . "../../../page/dashboard-user/profile.php?username_err=success");
        }
    } else {
        header("Location:" . "../../../page/error.php");
    }
} else {
    header("Location:" . "../../../page/error.php");
}
