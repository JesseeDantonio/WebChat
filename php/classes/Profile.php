<?php

namespace Index\php\classes;

class Profile
{
    private String $UUID;
    private String $REGISTRATION_DATE;
    private bool $PERMISSION;
    private String $username;
    private String $email;
    private String | NULL $pathImage;


    public function __construct(
        String $UUID, 
        String $REGISTRATION_DATE, 
        String $username, 
        String $email, 
        String | null $pathImage = null, 
        bool $IS_ADMINISTRATOR)
    {
        $this->UUID = $UUID;
        $this->REGISTRATION_DATE = $REGISTRATION_DATE;
        $this->PERMISSION = ($IS_ADMINISTRATOR) ? true : false;
        $this->username = $username;
        $this->email = $email;
        $this->pathImage = $pathImage;
    }

    public function setUsername(String $username): void
    {
        $this->username = $username;
    }

    public function setEmail(String $email): void
    {
        $this->email = $email;
    }

    public function setPathImage(String $pathImage): void
    {
        $this->pathImage = $pathImage;
    }

    public function setPERMISSION(bool $IS_ADMINISTRATOR): void
    {
        $this->PERMISSION = $IS_ADMINISTRATOR;
    }

    public function getUUID(): string
    {
        return $this->UUID;
    }

    public function getREGISTRATION_DATE(): string
    {
        return $this->REGISTRATION_DATE;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPathImage(): string | null
    {
        return $this->pathImage;
    }

    public function getPERMISSION(): bool
    {
        return $this->PERMISSION;
    }
}
