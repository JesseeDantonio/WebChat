<?php

use Index\php\classes\{AutoLoading, DataBaseConnect, DataBaseRequest, VerifyIdentification, PasswordFormat};

require(__DIR__ . "/../classes/AutoLoading.php");

const AUTO_LOADING = new AutoLoading();
const VERIFY_IDENTIFICATION = new VerifyIdentification();
const PASSWORD_FORMAT = new PasswordFormat();
const DATABASE_CONNECT = new DataBaseConnect();
$dataBaseRequest = new DataBaseRequest(DATABASE_CONNECT->getLink());

$response = VERIFY_IDENTIFICATION->start();

VERIFY_IDENTIFICATION->isProfileVerified($response, "/../../index.php");


if (
    isset($_POST['form_register_email'])
    && isset($_POST['form_register_username'])
    && isset($_POST['form_register_date_of_birth'])
    && isset($_POST['form_register_password'])
    && isset($_POST['form_register_password_retype'])
) {

    if (
        !empty($_POST['form_register_email'])
        && !empty($_POST['form_register_username'])
        && !empty($_POST['form_register_date_of_birth'])
        && !empty($_POST['form_register_password'])
        && !empty($_POST['form_register_password_retype'])
    ) {

        $email = strip_tags($_POST['form_register_email']);
        $username = strip_tags($_POST['form_register_username']);
        $dateBirth = strip_tags($_POST['form_register_date_of_birth']);
        $password = strip_tags($_POST['form_register_password']);
        $passwordRetype = strip_tags($_POST['form_register_password_retype']);

        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        $email = strtolower($email);
        
        if (!$dataBaseRequest->existAccount($email)) {
            
            if (!$dataBaseRequest->existBan($email)) {
                
                if (strlen($username) <= 100) {
                    
                    if (strlen($email) <= 100) {

                        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                            
                            if (hash_equals($password, $passwordRetype)) {
                                
                                if (PASSWORD_FORMAT->isThePasswordCorrect($password)) {

                                    $dataBaseRequest->createAccount($password, $username, $email, $dateBirth);
                                    header("Location: " . "../../page/sign-in.php?reg_err=success");
                                } else {
                                    header("Location:" . "../../index.php?reg_err=password_format");
                                }
                            } else {
                                header("Location:" . "../../index.php?reg_err=password_equals");
                            }
                        } else {
                            header("Location:" . "../../index.php?reg_err=email_invalid");
                        }
                    } else {
                        header("Location:" . "../../index.php?reg_err=email_lenght");
                    }
                } else {
                    header("Location:" . "../../index.php?reg_err=pseudo_lenght");
                }
            } else {
                header("Location:" . "../../index.php?reg_err=ban_list");
            }
        } else {
            header("Location:" . "../../index.php?reg_err=already");
        }
    } else {
        header("Location:" . "../../page/error.php");
    }
} else {
    header("Location:" . "../../page/error.php");
}



/*
<?php

 * Ce code va tester votre serveur pour déterminer quel serait le meilleur "cost".
 * Vous souhaitez définir le "cost" le plus élevé possible sans trop ralentir votre serveur.
 * 8-10 est une bonne base, mais une valeur plus élevée est aussi un bon choix à partir
 * du moment où votre serveur est suffisament rapide ! Le code suivant espère un temps
 * ≤ à 50 millisecondes, ce qui est une bonne base pour les systèmes gérants les identifications
 * intéractivement.

$timeTarget = 0.05; // 50 millisecondes

$cost = 8;
do {
    $cost++;
    $start = microtime(true);
    password_hash("test", PASSWORD_BCRYPT, ["cost" => $cost]);
    $end = microtime(true);
} while (($end - $start) < $timeTarget);

echo "Valeur de 'cost' la plus appropriée : " . $cost;
?>
*/