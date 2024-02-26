<?php

namespace Index\php\classes;

class PasswordFormat
{
    private String $LOWER_CASE = "@[a-z]@";
    private String $UPPER_CASE = "@[A-Z]@";
    private String $NUMBER = "@[\d]@";
    private String $SPECIAL = "@[\W]@";
    private int $LENGHT_MIN = 8;

    public function isThePasswordCorrect(String $PASSWORD): bool
    {
        $LENGHT = $this->isThereAMinimumOfCharacters($PASSWORD);
        $UPPER_CASE = $this->isThereACapitalLetter($PASSWORD);
        $LOWER_CASE = $this->isThereALowercaseLetter($PASSWORD);
        $NUMBER = $this->isThereANumber($PASSWORD);
        $SPECIAL = $this->isThereASpecialCharacter($PASSWORD);

        if (!$UPPER_CASE || !$LOWER_CASE || !$NUMBER || !$SPECIAL || !$LENGHT) {
            return false;
        }

        return true;
    }

    private function isThereACapitalLetter($PASSWORD): bool
    {
        return preg_match($this->UPPER_CASE, $PASSWORD);
    }

    private function isThereALowercaseLetter($PASSWORD): bool
    {
        return preg_match($this->LOWER_CASE, $PASSWORD);
    }

    private function isThereASpecialCharacter($PASSWORD): bool
    {
        return preg_match($this->SPECIAL, $PASSWORD);
    }

    private function isThereANumber($PASSWORD): bool
    {
        return preg_match($this->NUMBER, $PASSWORD);
    }

    private function isThereAMinimumOfCharacters($PASSWORD): bool
    {
        return strlen($PASSWORD) >= $this->LENGHT_MIN;
    }
}
