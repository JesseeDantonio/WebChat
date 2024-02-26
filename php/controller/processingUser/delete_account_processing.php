<?php

use Index\php\classes\{ DataBaseConnect, DataBaseRequest, VerifyIdentification, ProfilePicture, AutoLoading };

require(__DIR__ . "/../../classes/AutoLoading.php");

const AUTO_LOADING = new AutoLoading();
const DATABASE_CONNECT = new DataBaseConnect();
$dataBaseRequest = new DataBaseRequest(DATABASE_CONNECT->getLink());
const VERIFY_IDENTIFICATION = new VerifyIdentification();
const PROFILE_PICTURE = new ProfilePicture();

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$response = VERIFY_IDENTIFICATION->start();

VERIFY_IDENTIFICATION->isProfileNotVerified($response, "/../../index.php");

if (isset($_POST["form_delete_password"]) && !empty($_POST["form_delete_password"])) {

    $profile = $response;

    $passwordInput = strip_tags($_POST["form_delete_password"]);

    $data =  $dataBaseRequest->selectPasswordAccount($profile->getUUID());

    if (password_verify($passwordInput, $data['password'])) {

        if(PROFILE_PICTURE->existPicture($profile->getUUID(), "../../../assets/img/")) {
            PROFILE_PICTURE->deletePicture($profile->getUUID(), "../../../assets/img/");
        }

        $dataBaseRequest->deleteAccount($profile->getUUID());

        header("Location:" . "../logout_processing.php");
    } else {
        header("Location:" . "../../../page/dashboard-user/profile.php?delete_err=echec");
    }
} else {
    header("Location:" . "../../../page/error.php");
}
