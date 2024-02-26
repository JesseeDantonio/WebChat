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

if (isset($_POST['form_report_uuid_concerned']) && !empty($_POST['form_report_uuid_concerned'])) {

    if (isset($_POST['form_report_id_message']) && !empty($_POST['form_report_id_message'])) {

        $profile = $response;

        $uuidConcerned = strip_tags($_POST['form_report_uuid_concerned']);
        $idMessage = strip_tags($_POST['form_report_id_message']);

        $dataBaseRequest->postReport($uuidConcerned, $profile->getUUID(), $idMessage);

        header("Location:" . "../../../page/dashboard-user/dashboard.php?rep_send=success");
    } else {
        header("Location:" . "../../../page/error.php");
    }
} else {
    header("Location:" . "../../../page/error.php");
}
