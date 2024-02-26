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

    if (isset($_GET['id_report']) && !empty($_GET['id_report'])) {

        $uuidUser = htmlspecialchars($_GET['uuid']);
        $idReport = htmlspecialchars($_GET['id_report']);

        $emailUser = htmlspecialchars($dataBaseRequest->selectEmailAccount($_GET['uuid'])['email']);

        $dataBaseRequest->addBan($emailUser);

        $uuidUser = htmlspecialchars($_GET['uuid']);

        // On essaye de trouver une précedente image avec toutes les extensions autorisées, et l'uuid utilisateur.
        foreach (PROFILE_PICTURE->getExtensionsValid() as $extension) {
            // On vérifie si la combinaison avec l'extension existe
            if (file_exists("../../../assets/img/" . $uuidUser . "." . $extension)) {
                // Si oui, alors on supprime
                unlink("../../../assets/img/" . $uuidUser . "." . $extension);
            }
        }

        $dataBaseRequest->deleteAccount($uuidUser);

        $dataBaseRequest->removeReport($idReport);

        header("Location:" . "../../../page/dashboard-admin/list-reports.php");
    }else{
        header("Location:" . "../../../page/error.php");
    }
} else {
    header("Location:" . "../../../page/error.php");
}
