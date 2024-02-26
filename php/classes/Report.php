<?php

class Report {

    private int $ID;
    private int $MESSAGE_ID;
    private string $UUID_TRIGGERED;
    private string $UUID_CONCERNED;


    function __construct(int $ID, int $MESSAGE_ID, string $UUID_TRIGGERED, string $UUID_CONCERNED)
    {
        $this->ID = $ID;
        $this->MESSAGE_ID = $MESSAGE_ID;
        $this->UUID_TRIGGERED = $UUID_TRIGGERED;
        $this->UUID_CONCERNED = $UUID_CONCERNED;
    }


    function getID() : int
    {
        return $this->ID;
    }

    function getMESSAGE_ID() : int
    {
        return $this->MESSAGE_ID;
    }

    function getUUID_TRIGGERED() : string
    {
        return $this->UUID_TRIGGERED;
    }

    function getUUID_CONCERNED() : string
    {
        return $this->UUID_CONCERNED;
    }
}