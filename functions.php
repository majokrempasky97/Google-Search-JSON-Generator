<?php

    // Funkcia na generovanie názvu JSON súboru
    function generateId($length = 6)
    {
        return bin2hex(random_bytes($length));
    }

    // Funkcia na validáciu dát v textovom poli pre vyhľadávanie
    function validateData($data)
    {
        $data = trim($data);
        $length = mb_strlen($data, "UTF-8");

        /*
            1. Overí, či pole nie je prázdne
            2. Overí, či dĺžka vstupu nie je menej ako 3 znaky
            3. Overí, či dĺžka vstupu nie je viac ako 30 znakov
            4. Overí, či sa vo vstupe nenachádzajú nepovolené znaky
        */
        
        if($data == "")
        {
            return "error3";

        }
        else if($length < 3)
        {
            return "error4";
        }
        else if($length > 30)
        {
            return "error5";
        }
        else if (!preg_match("/^[\p{L}0-9\s\-]+$/u", $data)) 
        {
            return "error6";
        }
        else
        {
            return NULL;
        }
    }