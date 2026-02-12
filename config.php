<?php

    // Definícia API key pre serpapi
    define("API_KEY", "02e8c041a5a1f2fa4f6988ba9c910a0afaca523b219521273f405583c1bcf75e");

    // Error hlášky
    $error = [
        "success" => "ÚSPECH! JSON súbor bol úspešne vygenerovaný!",
        "error1" => "CHYBA! Súbor sa nepodarilo uložiť na server.",
        "error2" => "CHYBA! Súbor, ktorý sa snažíte stiahnuť neexistuje.",
        "error3" => "CHYBA! Textové pole pre kľúčové slovo nesmie byť prázdne.",
        "error4" => "CHYBA! Textové pole pre kľúčové slovo obsahuje príliš málo znakov.",
        "error5" => "CHYBA! Textové pole pre kľúčové slovo je príliš dlhé.",
        "error6" => "CHYBA! V textovom poli sa nachádzajú nepovolené znaky.",
        "error7" => "CHYBA! Počkajte aspoň 10 sekúnd pred ďalším vyhľadávaním."
    ];

    // Časový limit pro antispam ochranu v sekundách
    $limit = 10;