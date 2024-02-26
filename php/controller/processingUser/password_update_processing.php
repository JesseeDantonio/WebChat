<?php

use Index\php\classes\{ DataBaseConnect, DataBaseRequest, VerifyIdentification, PasswordFormat, AutoLoading };

require(__DIR__ . "/../../classes/AutoLoading.php");

const AUTO_LOADING = new AutoLoading();
const DATABASE_CONNECT = new DataBaseConnect();
const PASSWORD_FORMAT = new PasswordFormat();
$dataBaseRequest = new DataBaseRequest(DATABASE_CONNECT->getLink());
const VERIFY_IDENTIFICATION = new VerifyIdentification();

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$response = VERIFY_IDENTIFICATION->start();

VERIFY_IDENTIFICATION->isProfileNotVerified($response, "/../../../index.php");

if (
    isset($_POST['form_change_old_password']) && !empty($_POST['form_change_old_password'])) {

    if (isset($_POST['form_change_new_password']) && !empty($_POST['form_change_new_password'])) {
        
        $profile = $response;

        $passwordOld = strip_tags($_POST['form_change_old_password']);
        $passwordNew = strip_tags($_POST['form_change_new_password']);

        $data = $dataBaseRequest->selectPasswordAccount($profile->getUUID());

        if (password_verify($passwordOld, strip_tags($data['password']))) {

            if (PASSWORD_FORMAT->isThePasswordCorrect($passwordNew)) {

                $dataBaseRequest->updatePasswordAccount($profile->getUUID(), $passwordNew);

                $dataBaseRequest->updateAccount($profile->getUUID());

                header("Location:" . "../../../page/dashboard-user/profile.php?password_change=success");
            } else {
                header("Location:" . "../../../page/dashboard-user/profile.php?password_change=password_format_invalid");
            }
        } else {
            header("Location:" . "../../../page/dashboard-user/profile.php?password_change=password_old_incorrect");
        }
    } else {
        header("Location:" . "../../../page/error.php");
    }
} else {
    header("Location:" . "../../../page/error.php");
}
