<!DOCTYPE html>
<html lang="sk">
  <head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Generátor JSON súboru z Google vyhľadávania - praktická úloha">
  <meta name="author" content="Marián Krempaský">
  <meta name="keywords" content="Google, JSON, vyhľadávanie, generator">
  <meta name="robots" content="index, follow">
  <title>Home - Google JSON Generator</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="style/design.css" rel="stylesheet">
  </head>
  <body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <div class="container mt-5">
      <div class="form-wrapper text-center">
        <h1 class="mb-4 fs-4">Generátor JSON súboru z Google vyhľadávania</h1>
        <?php

          // Implementácia súboru config.php
          require __DIR__ ."/config.php";

          // Definícia zjednodušených premenných $state a $fid
          $state = $_GET["s"] ?? NULL;
          $f = $_GET["f"] ?? NULL;

          // Odstránenie prípony .json z file ID premennej
          $fid = $f ? pathinfo($f, PATHINFO_FILENAME) : NULL;
          if(isset($state)): ?>
          
            <div class="alert 
              <?=  $state === "success" 
                  ? "alert-success" 
                  : "alert-danger" ?>"
            >
            
            <?= htmlspecialchars($error[$state] ?? "Neznáma chyba!", ENT_QUOTES, "UTF-8")  ?>

            <?php if ($state == "success" && isset($fid)): ?>
            <br /><br />
            <a href="get.php?fid=<?= $fid ?>" class="btn btn-success">Stiahnuť súbor</a>
          <?php endif ?>
            
            </div>
          <?php endif ?>
          
            <form method="post" action="action.php">
                <input class="form-control" type="text" name="query" placeholder="Sem napíšte slovné spojenie..." />
                <div class="text-center mt-4">
                  <input class="btn btn-primary" type="submit" name="odoslat" value="Odoslať" />
                </div>
            </form>
      </div>
    </div>
  </body>
  <footer>
     <div class="text-center mt-3">
        <small class="text-muted">Copyright &copy; 2026 Google JSON Generator</small>
      </div>
  </footer>
</html>