<?php

    require("config.php");
    require("functions.php"); 

    // Antispam ochrana - porovnáva čas posledného requestu
    session_start();

    // Kontrola časového limitu medzi requestami
    $lastRequestTime = $_SESSION['last_request_time'] ?? 0;
    $currentTime = time();
    
    if(($currentTime - $lastRequestTime) < $limit)
        {
            header("Location: index.php?s=error7");
            exit;
        }
    
    // Aktualizuj čas posledného requestu
    $_SESSION['last_request_time'] = $currentTime;

    // Overenie toho, či k tomuto súboru bolo pristúpené POST metódou z formulára
    if($_SERVER["REQUEST_METHOD"] !== "POST")
        {
            header("Location: index.php");
            exit;
        }
    
    // Klúčové slovo, ktoré sa bude vyhľadávať
    $query = $_POST["query"] ?? "";
    $fail = validateData($query);

    // Overenie vstupu formulára
    if($fail != NULL){
        header("Location: index.php?s=".$fail);
        exit;
    }

    // Očistí výstup formulára o medzery
    $query = trim($query);

    // Adresa, z ktorej sa bude vypisovať obsah
    $url = 
        "https://serpapi.com/search.json" .
        "?q=". urlencode($query) . 
        "&apikey=". API_KEY;

    // Vytiahnutie obsahu zo zadanej adresy
    $response = file_get_contents($url);
    $data = json_decode($response, true);

    // Definovanie pola relevantných výsledkov
    $results = [];


    // Kontrola, či je v JSONe dostupný prvok "organic_results"
    if (isset($data["organic_results"]))
        {

        $count = 0;
        foreach ($data["organic_results"] as $item)
            {

                /* Zabezpečuje, aby sa popísalo len prvých 10 položiek (1 strana Google)
                Ak je viac, tak preruší cyklus */

                if($count > 10) break;
                $results[] = [
                    "position" => $item["position"] ?? NULL,
                    "title" => $item["title"] ?? NULL,
                    "link" => $item["link"] ?? NULL,
                    "snippet" => $item["snippet"] ?? NULL
                ];

                $count++;

            }

         }

    // Prevedenie obsahu pola $results do JSON formátu
    $minijson = json_encode($results, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

    // Vytvorenie názvu súboru
    $fileName = urlencode(generateId() . ".json");
    $filePath = __DIR__ . "/files/" . $fileName;

    // Kontrola a následné uloženie json obsahu do súboru
    if(file_put_contents($filePath, $minijson, LOCK_EX) === FALSE)
        {
            header("Location: index.php?s=error1");
            exit;
        }
    
    // Presmerovanie naspäť na index k stiahnutiu JSONu
    header("Location: index.php?s=success&f=" . $fileName);
    exit;

