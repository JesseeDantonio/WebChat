<?php

use Index\php\classes\{ DataBaseConnect, DataBaseRequest, VerifyIdentification, AutoLoading };

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

if (isset($_POST['form_update_new_email']) && !empty($_POST['form_update_new_email'])) {

    if (isset($_POST['form_update_email_password'])&& !empty($_POST['form_update_email_password'])) {

        $emailInput = strip_tags($_POST['form_update_new_email']);

        $emailInput = filter_var($emailInput, FILTER_SANITIZE_EMAIL);

        if (filter_var($emailInput, FILTER_VALIDATE_EMAIL)) {

            $profile = $response;

            $passwordInput = strip_tags($_POST['form_update_email_password']);

            $data = $dataBaseRequest->selectPasswordAccount($profile->getUUID());

            if (password_verify($passwordInput, strip_tags($data['password']))) {

                $dataBaseRequest->updateEmailAccount($emailInput, $profile->getUUID());

                $profile->setEmail($emailInput);

                $_SESSION["userProfile"] = serialize($profile);

                header("Location:" . "../../../page/dashboard-user/profile.php");
            } else {
                header("Location:" . "../../../page/dashboard-user/profile.php");
            }
        }else {
            header("Location:" . "../../../page/error.php");
        }
    }else {
        header("Location:" . "../../../page/error.php");
    }
}else {
    header("Location:" . "../../../page/error.php");
}
