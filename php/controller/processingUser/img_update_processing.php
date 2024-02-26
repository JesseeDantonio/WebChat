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

VERIFY_IDENTIFICATION->isProfileNotVerified($response, "/../../../index.php");

if (isset($_FILES['form_update_image'])) {
    
    if (!empty($_FILES['form_update_image']['name'])) {

        $profile = $response;

        $sizeFile =  strip_tags($_FILES['form_update_image']['size']);
        $nameFile = strip_tags($_FILES['form_update_image']['name']);

        if ($sizeFile <= PROFILE_PICTURE->getSizeMax()) {

            $extensionUpload = PROFILE_PICTURE->getExtension($nameFile);

            // On vérifie si l'extension du fichier upload, est autorisée
            if (in_array($extensionUpload, PROFILE_PICTURE->getExtensionsValid())) {

                $path = PROFILE_PICTURE->getPathPictures($profile->getUUID(), $extensionUpload, __DIR__ . "/../../../assets/img/");

                if(PROFILE_PICTURE->existPicture($profile->getUUID(), "../../../assets/img/")) {
                    PROFILE_PICTURE->deletePicture($profile->getUUID(), "../../../assets/img/");
                }

                // On déplace le fichier télécharger dans un répertoire ( path )
                move_uploaded_file($_FILES['form_update_image']['tmp_name'], $path);
                // le chemin d'accès depuis le profil utilisateur
                $pathUpdate = "../../assets/img/" . $profile->getUUID() . "." . $extensionUpload;
                // On met le nouveau chemin directement en session pour éviter de se reconnecter
                $profile->setPathImage($pathUpdate);
                // Mise en base de donnée du chemin d'accès de l'image
                $dataBaseRequest->updateImageAccount($pathUpdate, $profile->getUUID());
                // On met à jour l'objet profile
                $_SESSION["userProfile"] = serialize($profile);
                // Retour sur la page profile utilisateur
                header("Location:" . "../../../page/dashboard-user/profile.php");
            }
        } else {
            header("Location:" . "../../../page/error.php");
        }
    } else {
        header("Location:" . "../../../page/error.php");
    }
} else {
    header("Location:" . "../../../page/error.php");
}
