<?php

namespace Index\php\classes;

use Report;

class DataBaseRequest
{
    private \PDO $link;

    public function __construct(\PDO $link)
    {
        $this->link = $link;
    }


    public function updateAccount($uuidAccount): void
    {
        $stmt = $this->link->prepare("UPDATE user_list SET updated_at = ? WHERE uuid = ?");
        $stmt->execute(array(
            date('Y-m-d H:i:s'), $uuidAccount
        ));
    }

    public function updateUsernameAccount($uuidAccount, $newUsername): String
    {
        $stmt = $this->link->prepare("UPDATE user_list SET username = ? WHERE uuid = ?");
        $stmt->execute(array($newUsername, $uuidAccount));
        return $newUsername;
    }

    public function updatePasswordAccount($uuidAccount, $newPassword): void
    {
        $hashPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $stmt = $this->link->prepare("UPDATE user_list SET password = ? WHERE uuid = ?");
        $stmt->execute(array(
            $hashPassword, $uuidAccount
        ));
    }

    public function updateTokenAccount($email, $tokenUser): void
    {
        $stmt = $this->link->prepare("UPDATE user_list SET token = ? WHERE email = ?");
        $stmt->execute(array(
            $tokenUser, $email
        ));
    }

    public function selectEmailAccount($uuidAccount): array
    {
        $stmt = $this->link->prepare("SELECT email FROM user_list WHERE uuid = ?");
        $stmt->execute(array(
            $uuidAccount
        ));
        return $stmt->fetch();
    }

    public function selectPasswordAccount($uuidAccount): array
    {
        $stmt = $this->link->prepare("SELECT password FROM user_list WHERE uuid = ?");
        $stmt->execute(array(
            $uuidAccount
        ));
        return $stmt->fetch();
    }

    public function selectTokenAccount($tokenAccount): array
    {
        $stmt = $this->link->prepare("SELECT token FROM user_list WHERE token = ?");
        $stmt->execute(array(
            $tokenAccount
        ));
        return $stmt->fetch();
    }

    public function createAccount($passwordAccount, $usernameAccount, $emailAccount, $dateBirth): void
    {
        $uuid = uniqid();
        $password = password_hash($passwordAccount, PASSWORD_DEFAULT, ["cost" => 10]);
        $stmt = $this->link->prepare("INSERT INTO user_list(uuid, username, email, password, date_of_birth) VALUES(:uuid, :username, :email, :password, :date_of_birth)");
        $stmt->execute(array(
            'uuid' => $uuid,
            'username' => $usernameAccount,
            'email' => $emailAccount,
            'password' => $password,
            'date_of_birth' => $dateBirth
        ));
    }

    public function deleteAccount($uuidAccount): void
    {
        $stmt = $this->link->prepare("DELETE FROM user_list WHERE uuid = ?");
        $stmt->execute(array(
            $uuidAccount
        ));
    }

    public function existAccount($emailAccount): bool
    {
        $stmt = $this->link->prepare("SELECT * FROM user_list WHERE email = ?");
        $stmt->execute(array(
            $emailAccount
        ));

        if ($stmt->rowCount() == 1) {
            return true;
        }
        return false;
    }

    public function existTokens($token, $tokenUser): int
    {
        $stmt = $this->link->prepare("SELECT * FROM password_recover WHERE token_user = ? AND token = ?");
        $stmt->execute(array(
            $tokenUser, $token
        ));
        return $stmt->rowCount();
    }

    public function queryAccountEmail($emailAccount): array
    {
        $stmt = $this->link->prepare("SELECT * FROM user_list WHERE email = ?");
        $stmt->execute(array(
            $emailAccount
        ));
        return $stmt->fetch();
    }

    public function queryAccountUUID($uuidAccount): array
    {
        $stmt = $this->link->prepare("SELECT * FROM user_list WHERE uuid = ?");
        $stmt->execute(array(
            $uuidAccount
        ));
        return $stmt->fetch();
    }

    public function resetTokenAccount($tokenUser): void
    {
        $stmt = $this->link->prepare("UPDATE user_list SET token = ? WHERE token = ?");
        $stmt->execute(array(
            null, $tokenUser
        ));
    }

    public function resetTokens($tokenUser): void
    {
        $stmt = $this->link->prepare("DELETE FROM password_recover WHERE token_user = ?");
        $stmt->execute(array(
            $tokenUser
        ));
    }

    public function selectTokensValidity($tokenUser, $token): array
    {
        $stmt = $this->link->prepare("SELECT registration_at FROM password_recover WHERE token = ? AND token_user = ?");
        $stmt->execute(array(
            $token, $tokenUser
        ));
        return $stmt->fetch();
    }

    public function updateEmailAccount($email, $uuidAccount): void
    {
        $stmt = $this->link->prepare("UPDATE user_list SET email = ? WHERE uuid = ?");
        $stmt->execute(array(
            $email, $uuidAccount
        ));
    }

    public function existPermission($uuid): bool
    {
        $stmt = $this->link->prepare("SELECT is_admin FROM user_list WHERE uuid = ?");
        $stmt->execute(array(
            $uuid
        ));
        $result = $stmt->fetch();

        if ($result['is_admin'] == 1) {
            return true;
        }

        return false;
    }

    public function queryAllAccounts($uuidIgnore): array
    {
        $stmt = $this->link->prepare("SELECT * FROM user_list WHERE NOT uuid = ?");
        $stmt->execute(array(
            $uuidIgnore
        ));
        return $stmt->fetchAll();
    }

    public function queryAllPermissions($uuidIgnore): array
    {
        $stmt = $this->link->prepare("SELECT * FROM user_list WHERE NOT uuid = ?");
        $stmt->execute(array(
            $uuidIgnore
        ));
        return $stmt->fetchAll();
    }

    public function selectUsernameAccount($uuidAccount): array
    {
        $stmt = $this->link->prepare("SELECT username FROM user_list WHERE uuid = ?");
        $stmt->execute(array(
            $uuidAccount
        ));
        return $stmt->fetch();
    }

    public function addPermission($uuidAccount): void
    {
        $stmt = $this->link->prepare("UPDATE user_list SET is_admin = ? WHERE uuid = ?");
        $stmt->execute(array(
            1, $uuidAccount
        ));
    }

    public function removePermission($uuidAccount): void
    {
        $stmt = $this->link->prepare("UPDATE user_list SET is_admin = ? WHERE uuid = ?");
        $stmt->execute(array(
            0, $uuidAccount
        ));
    }

    public function updateImageAccount($pathImg, $uuidAccount): void
    {
        $stmt = $this->link->prepare("UPDATE user_list SET path_img = ? WHERE uuid = ?");
        $stmt->execute(array(
            $pathImg, $uuidAccount
        ));
    }

    public function resetImageAccount($uuidAccount): void
    {
        $stmt = $this->link->prepare("UPDATE user_list SET path_img = ? WHERE uuid = ?");
        $stmt->execute(array(
            NULL, $uuidAccount
        ));
    }

    public function existPathImage($uuidAccount): bool
    {
        $stmt = $this->link->prepare("SELECT path_img FROM user_list WHERE uuid = ?");
        $stmt->execute(array(
            $uuidAccount
        ));
        $result = $stmt->fetch();

        if ($result['path_img'] === null) {
            return false;
        }

        return true;
    }

    function getMessages(): array
    {
        $stmt = $this->link->prepare("SELECT * FROM message_list ORDER BY registration_at DESC LIMIT 20");
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    function postMessage($uuid, $content): void
    {
        $stmt = $this->link->prepare("INSERT INTO message_list(uuid_user, username, contains) VALUES (:uuid_user, :username, :contains)");
        $stmt->execute(array(
            "uuid_user" => $uuid,
            "username" => self::selectUsernameAccount($uuid)['username'],
            "contains" => $content
        ));
    }

    function queryReport($uuidUser): array
    {
        $stmt = $this->link->prepare("SELECT * FROM report_list WHERE uuid_user = ?");
        $stmt->execute(array(
            "uuid_user" => $uuidUser
        ));
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    function queryReports(): array
    {
        $stmt = $this->link->prepare("SELECT * FROM report_list");
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function postReport(Report $report): void
    {
        $stmt = $this->link->prepare("INSERT INTO report_list(uuid_sender, uuid_concerned, id_message) VALUES (:uuid_sender, :uuid_concerned, :id_message)");
        $stmt->execute(array(
            "uuid_sender" => $report->getUUID_TRIGGERED(),
            "uuid_concerned" => $report->getUUID_CONCERNED(),
            "id_message" => $report->getMESSAGE_ID()
        ));
    }

    public function addBan(String $emailUser): void
    {
        $stmt = $this->link->prepare("INSERT INTO ban_list(email) VALUES (:email)");
        $stmt->execute(array(
            "email" => $emailUser
        ));
    }

    public function queryBanList(): array
    {
        $stmt = $this->link->prepare("SELECT * FROM ban_list");
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function existBan(String $emailUser): bool
    {
        $stmt = $this->link->prepare("SELECT * FROM ban_list WHERE email = ?");
        $stmt->execute(array(
            $emailUser
        ));

        if ($stmt->rowCount() == 1) {
            return true;
        }
        return false;
    }

    public function removeBan(String $emailConcerned): void
    {
        $stmt = $this->link->prepare("DELETE FROM ban_list WHERE email = ?");
        $stmt->execute(array(
            $emailConcerned
        ));
    }

    public function selectMessage($idMessage): array
    {
        $stmt = $this->link->prepare("SELECT contains FROM message_list INNER JOIN report_list ON message_list.id = report_list.id_message WHERE message_list.id = ?");
        $stmt->execute(array(
            $idMessage
        ));

        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function removeMessage($idMessage): void
    {
        $stmt = $this->link->prepare("DELETE FROM message_list WHERE id = ?");
        $stmt->execute(array(
            $idMessage
        ));
    }

    public function removeReport($idReport): void
    {
        $stmt = $this->link->prepare("DELETE FROM report_list WHERE id = ?");
        $stmt->execute(array(
            $idReport
        ));
    }
}
