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

if (isset($_GET["uuid"]) && isset($_GET["uuid"])) {

    if (!empty($_GET["uuid"]) && !empty($_GET["list"])) {

        $uuid = htmlspecialchars($_GET["uuid"]);
        $list = htmlspecialchars($_GET["list"]);

        $dataBaseRequest->removePermission($uuid);

        switch ($list) {
            case 'admin':
                header("Location:" . "../../../page/dashboard-admin/list-administrators.php");
                break;
            case 'user':
                header("Location:" . "../../../page/dashboard-admin/list-users.php");
                break;
        }
    } else {
        header("Location:" . "../../../page/error.php");
    }
} else {
    header("Location:" . "../../../page/error.php");
}
