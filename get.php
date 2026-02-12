<?php

    // Overenie parametra z GET metódy, ktorý nám určuje, ktorý súbor sa má stiahnuť
    if(!isset($_GET["fid"]))
        {
            header("Location: index.php");
            exit;
        }

    // Určenie názvu súboru a prevencia pre path traversal
    $filename = basename($_GET["fid"]);
    $filepath = __DIR__ . "/files/" . $filename . ".json";

    // Overenie, či súbor existuje na serveri
    if(!file_exists($filepath))
        {
            header("Location: index.php?s=error2");
            exit;
        }

    // Overenie čítateľnosti súboru
    if(!is_readable($filepath))
        {
            header("Location: index.php");
            exit;
        }

    // Hlavičky pre download zvoleného súboru
    header("Content-Description: File Transfer");
    header("Content-Type: application/json");
    header("Content-Disposition: attachment; filename= ". $filename . ".json");
    header("Content-Length: ". filesize($filepath));
    header("Cache-Control: must-revalidate");
    header("Pragma: public");

    // Pošle súbor
    readfile($filepath);
    exit;

    


