<?php

namespace Index\php\classes;

use Index\php\classes\Profile;

class VerifyIdentification
{

    public function start(): Profile | null
    {
        if (session_status() === PHP_SESSION_ACTIVE) {

            if (isset($_SESSION["userProfile"]) && !empty($_SESSION["userProfile"])) {

                if (is_string($_SESSION["userProfile"])) {

                    $profile = unserialize($_SESSION["userProfile"]);

                    if ($profile instanceof Profile) {

                        return $profile;
                    }
                }
            }
        }


        return null;
    }

    public function isProfileVerified(Profile | null $profile, String $pathLocation): void
    {
        if ($profile instanceof Profile) {
            header("Location:" . $pathLocation);
            return;
        }
    }

    public function isProfileNotVerified(Profile | null $profile, String $pathLocation): void
    {
        if ($profile === null && !($profile instanceof Profile)) {
            header("Location:" . $pathLocation);
            return;
        }
    }

    public function isVerifyWithoutAction(): bool
    {
        if (isset($_SESSION["userProfile"])) {
            return true;
        }

        return false;
    }

    public function isAdministratorWithoutAction(): bool
    {
        $profile = unserialize($_SESSION['userProfile']);
        if ($profile->getPermission()) {
            return true;
        }
        return false;
    }




    public function isNotAdministrator(Profile $profile, String $pathLocation): void
    {
        if (!$profile instanceof Profile) {
            header("Location:" . $pathLocation);
            return;
        }

        if (!$profile->getPermission()) {
            header("Location:" . $pathLocation);
            return;
        }
    }
}

class InvalidProfileException extends \Exception
{
}
