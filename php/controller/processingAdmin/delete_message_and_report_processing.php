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

if (isset($_GET['id_message']) && !empty($_GET['id_message'])) {

    if (isset($_GET['id_report']) && !empty($_GET['id_report'])) {

        $idMessage = htmlspecialchars($_GET['id_message']);
        $idReport = htmlspecialchars($_GET['id_report']);

        $dataBaseRequest->removeMessage($idMessage);

        $dataBaseRequest->removeReport($idReport);

        header("Location:" . "../../../page/dashboard-admin/list-reports.php");
    }else{
        header("Location:" . "../../../page/error.php");
    }
}else {
    header("Location:" . "../../../page/error.php");
}
