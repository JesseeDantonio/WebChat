<?php

use Index\php\classes\{ DataBaseConnect, DataBaseRequest, VerifyIdentification, Profile, AutoLoading, PasswordFormat };

require(__DIR__ . "/../classes/AutoLoading.php");

const AUTO_LOADING = new AutoLoading();
const VERIFY_IDENTIFICATION = new VerifyIdentification();
const PASSWORD_FORMAT = new PasswordFormat();
const DATABASE_CONNECT = new DataBaseConnect();
$dataBaseRequest = new DataBaseRequest(DATABASE_CONNECT->getLink());

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$response = VERIFY_IDENTIFICATION->start();

VERIFY_IDENTIFICATION->isProfileVerified($response, "/../../index.php");


if (isset($_POST['form_login_email']) && !empty($_POST['form_login_email'])) {
    
    if (isset($_POST['form_login_password']) && !empty($_POST['form_login_password'])) {
        
        $email = strip_tags($_POST['form_login_email']);
        $password = strip_tags($_POST['form_login_password']);

        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        $email = strtolower($email);
        
        if ($dataBaseRequest->existAccount($email)) {
            
            if (!$dataBaseRequest->existBan($email)) {
                
                $data = $dataBaseRequest->queryAccountEmail($email);
                
                $dataUUID = strip_tags($data['uuid']);
                $dataUsername = strip_tags($data['username']);

                $dataEmail = filter_var($data['email'], FILTER_SANITIZE_EMAIL);
                $dataEmail = strip_tags($dataEmail);

                $dataPassword = strip_tags($data['password']);
                
                if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

                    if (password_verify($password, $dataPassword)) {

                        $PROFIL = new Profile(
                            $dataUUID,
                            $data["registration_at"],
                            $dataUsername,
                            $dataEmail,
                            $data['path_img'],
                            $data["is_admin"]
                        );

                        $_SESSION['userProfile'] = serialize($PROFIL);

                        header("Location:" . "../../page/dashboard-user/dashboard.php?log_status=connected");
                    } else {
                        header("Location:" . "../../page/sign-in.php?login_err=password");
                    }
                } else {
                    header("Location:" . "../../page/sign-in.php?login_err=email_validate");
                }
            } else {
                header("Location:" . "../../page/sign-in.php?login_err=ban_account");
            }
        } else {
            header("Location:" . "../../page/sign-in.php");
        }
    } else {
        header("Location:" . "../../page/error.php");
    }
} else {
    header("Location:" . "../../page/error.php");
}
