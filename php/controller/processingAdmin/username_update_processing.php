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

if (isset($_POST['form_change_username']) && !empty($_POST['form_change_username'])) {

    $username = htmlspecialchars($_POST['form_change_username']);

    $uuid = htmlspecialchars($_GET['uuid']);

    if (strlen($username) <= 100) {

        $dataBaseRequest->updateUsernameAccount($uuid, $username);

        $dataBaseRequest->updateAccount($uuid);

        header("Location:" . "../../../page/dashboard-admin/watch-user.php?uuid=" . $uuid);
        return;
    }
} else {
    header("Location:" . "../../../page/error.php");
}
