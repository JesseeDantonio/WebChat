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

VERIFY_IDENTIFICATION->isNotAdministrator("../../../page/dashboard-user/dashboard.php");

if(isset($_GET['email']) && !empty($_GET['email'])){
    
    $email = htmlspecialchars($_GET['email']);

    $dataBaseRequest->removeBan($email);

    header("Location:" . "../../../page/dashboard-admin/list-bans.php");
}else {
    header("Location:" . "../../../page/error.php");
}

