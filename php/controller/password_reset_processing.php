<?php

use Index\php\classes\{DataBaseConnect, DataBaseRequest, VerifyIdentification, PasswordFormat, AutoLoading};

require(__DIR__ . "/../classes/AutoLoading.php");
const AUTO_LOADING = new AutoLoading();
const PASSWORD_FORMAT = new PasswordFormat();
const VERIFY_IDENTIFICATION = new VerifyIdentification();
const DATABASE_CONNECT = new DataBaseConnect();
$dataBaseRequest = new DataBaseRequest(DATABASE_CONNECT->getLink());

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$response = VERIFY_IDENTIFICATION->start();

VERIFY_IDENTIFICATION->isProfileVerified($response, "/../../index.php");

if (
    isset($_POST['form_change_new_password'])
    && isset($_POST['form_change_retype_password'])
    && isset($_POST['form_token'])
) {

    if (
        !empty($_POST['form_change_new_password'])
        && !empty($_POST['form_change_retype_password'])
        && !empty($_POST['form_token'])
    ) {
        $db = DATABASE_CONNECT->getLink();

        $passwordNew = htmlspecialchars($_POST['form_change_new_password']);
        $passwordNewRetype = htmlspecialchars($_POST['form_change_retype_password']);
        $tokenUser = htmlspecialchars(base64_decode($_POST['form_token']));

        $check = $db->prepare("SELECT uuid FROM user_list WHERE token = ?");
        $check->execute(array(
            $tokenUser
        ));
        $data = $check->fetch();

        if (hash_equals($passwordNew, $passwordNewRetype)) {

            if (PASSWORD_FORMAT->isThePasswordCorrect($passwordNew)) {

                $dataBaseRequest->updatePasswordAccount($data['uuid'], $passwordNew);

                $dataBaseRequest->resetTokenAccount($tokenUser);

                $delete = $db->prepare("DELETE FROM password_recover WHERE token_user = ?");
                $delete->execute(array(
                    $tokenUser
                ));

                $dataBaseRequest->updateAccount($_SESSION['uuid']);

                header("Location:" . "../../page/sign-in.php?password_change=success");
            } else {
                header("Location:" . "../../index.php?password_change=password_format_invalid");
            }
        } else {
            header("Location:" . "../../index.php?password_change=password_retype_invalid");
        }
    } else {
        header("Location:" . "../../page/error.php");
    }
} else {
    header("Location:" . "../../page/error.php");
}


$delete = $db->prepare("UPDATE users SET token = ? WHERE token = ?");
$delete->execute(array(
    null, $tokenUser
));

$delete = $db->prepare("DELETE FROM password_recover WHERE token_user = ?");
$delete->execute(array(
    $tokenUser
));
