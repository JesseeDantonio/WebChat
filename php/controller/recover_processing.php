<?php

use Index\php\classes\{ DataBaseConnect,  DataBaseRequest, VerifyIdentification, AutoLoading };

require(__DIR__ . "/../classes/AutoLoading.php");

const AUTO_LOADING = new AutoLoading();
const VERIFY_IDENTIFICATION = new VerifyIdentification();
const DATABASE_CONNECT = new DataBaseConnect();
$dataBaseRequest = new DataBaseRequest(DATABASE_CONNECT->getLink());

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$response = VERIFY_IDENTIFICATION->start();

VERIFY_IDENTIFICATION->isProfileVerified($response, "/../../index.php");

if (isset($_GET['tu']) && !empty($_GET['tu'])) {

    if (isset($_GET['t']) && !empty($_GET['t'])) {

        $tokenUser = htmlspecialchars(base64_decode($_GET['tu']));
        $token = htmlspecialchars(base64_decode($_GET['t']));

        $row = $dataBaseRequest->existTokens($token, $tokenUser);

        if ($row) {

            $data = $dataBaseRequest->selectTokensValidity($tokenUser, $token);

            if ((time() - strtotime($data['registration_at'])) <= 1800) {

                $data = $dataBaseRequest->selectTokenAccount($tokenUser);

                if (hash_equals($data['token'], $tokenUser)) {
                    header("Location:" . "../../page/password_reset.php"
                        . "?"
                        . "tu="
                        . base64_encode($tokenUser)
                        . "&"
                        . "t="
                        . base64_encode($token));
                }
            } else {
                $dataBaseRequest->resetTokens($tokenUser);
                $dataBaseRequest->resetTokenAccount($tokenUser);
                header("Location:" . "/../../index.php");
            }
        } else {
            header("Location:" . "../../index.php");
        }
    } else {
        header("Location:" . "../../page/error.php");
    }
} else {
    header("Location:" . "../../page/error.php");
}
