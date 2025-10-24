<?php

include("Personnage.php");
include("Histoire.php");
include("Description.php");

try {
    $db = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Récupération de l'ID depuis l'URL
    $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
    
    // Requête pour obtenir les détails du histoire
    $requete = $db->prepare("SELECT * FROM Histoire WHERE Id = ?");
    $requete->execute([$id]);
    $requete->setFetchMode(PDO::FETCH_CLASS, "Histoire");
    $histoire = $requete->fetch();

} catch(PDOException $e) {
    echo "" . $e->getMessage();
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Liste histoires</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<!-- Modification des infos de bases -->
<div class="container d-flex p-2">
    <h1 class="row">Formulaire histoire</h1>
    <form action="formulaire.php" method="post" class="row">
        <div class="row">
            <label for="type" ><b>type</b></label>
            <input type="text" placeholder="type" name="type" id="type" included>
        </div>
        <div class="row">
            <label for="univers" ><b>Univers</b></label>
            <input type="text" placeholder="univers" name="univers" id="univers" included>
        </div>
        <div class="row">
            <label for="resume" ><b>resume</b></label>
            <input type="text" placeholder="resume" name="resume" id="resume" included>
        </div>
        <div class="row"></div>
         <button type="submit">Confirmer</button>
        </div>
    </form>
</div>

<div>
    <div >
            <label for="histoire" ><b>Rajouter une histoire</b></label>
            <input type="text" placeholder="histoire" name="histoire" id="histoire" included>
        </div>
        <div ></div>
         <button type="submit">Confirmer</button>
        </div>
</div>

    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>