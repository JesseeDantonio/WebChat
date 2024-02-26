<?php

use Index\php\classes\{ DataBaseConnect, DataBaseRequest, VerifyIdentification, AutoLoading, ProfilePicture};

require(__DIR__ . "/../../classes/AutoLoading.php");

const AUTO_LOADING = new AutoLoading();
const DATABASE_CONNECT = new DataBaseConnect();
const VERIFY_IDENTIFICATION = new VerifyIdentification();
const PROFILE_PICTURE = new ProfilePicture();
$dataBaseRequest = new DataBaseRequest(DATABASE_CONNECT->getLink());

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$response = VERIFY_IDENTIFICATION->start();

VERIFY_IDENTIFICATION->isProfileNotVerified($response, "../../../index.php");

VERIFY_IDENTIFICATION->isNotAdministrator("../../../index.php");

if (isset($_GET['uuid']) && !empty($_GET['uuid'])) {

    $uuidUser = htmlspecialchars($_GET['uuid']);

    foreach (PROFILE_PICTURE->getExtensionsValid() as $extension) {
        // On vérifie si la combinaison avec l'extension existe
        if (file_exists("../../../assets/img/" . $uuidUser . "." . $extension)) {
            // Si oui, alors on supprime
            unlink("../../../assets/img/" . $uuidUser . "." . $extension);
        }
    }

    if ($dataBaseRequest->existPathImage($uuidUser)) {
        $dataBaseRequest->resetImageAccount($uuidUser);
    }

    $dataBaseRequest->updateAccount($uuidUser);

    header("Location:" . "../../../page/dashboard-admin/watch-user.php?uuid=" . $uuidUser);
}else {
    header("Location:" . "../../../page/error.php");
}
