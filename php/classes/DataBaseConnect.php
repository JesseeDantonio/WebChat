<?php

namespace Index\php\classes;

class DataBaseConnect
{
    private String $HOST;
    private String $DATABASE_NAME;
    private String $USER;
    private String $PASSWORD;
    private \PDO $LINK;

    public function __construct()
    {
        // $this->HOST = "monporxdylan.mysql.db";
        // $this->DATABASE_NAME = "monporxdylan";
        // $this->USER = "monporxdylan";
        // $this->PASSWORD = "mf0Aa4ihzVt6";

        $this->HOST = "localhost";
        $this->DATABASE_NAME = "project_final";
        $this->USER = "root";
        $this->PASSWORD = "";

        try {

            $this->LINK = new \PDO(
                'mysql:' .
                'host=' . $this->HOST . ';' .
                'dbname=' . $this->DATABASE_NAME . ';',
                $this->USER,
                $this->PASSWORD
            );
            
        } catch (\Exception $error) {
            die($error->getMessage());
        }
    }

    public function getLink(): \PDO
    {
        return $this->LINK;
    }
}
