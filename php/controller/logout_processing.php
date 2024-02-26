<?php

use Index\php\classes\{ VerifyIdentification, AutoLoading, DataBaseConnect, Session};

require(__DIR__ . "/../classes/AutoLoading.php");

const AUTO_LOADING = new AutoLoading();
const VERIFY_IDENTIFICATION = new VerifyIdentification();
const DATABASE_CONNECT = new DataBaseConnect();


if (session_status() === PHP_SESSION_NONE) {

    session_start();

    $response = VERIFY_IDENTIFICATION->start();

    VERIFY_IDENTIFICATION->isProfileNotVerified($response, "../../index.php");

    try {
        session_destroy();
        header("Location:" . "../../page/sign-in.php?log_status=disconnected");
    } catch (\Exception $error) {
        die($error->getMessage());
    }
} else {
    header("Location:" . "../../page/error.php");
}
