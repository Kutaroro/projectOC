<?php

include("Personnage.php");
include("Histoire.php");
include("Description.php");


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>


<div class="container d-flex p-2">
    <h1 class="row">Création de voiture</h1>
    <form action="formulaire.php" method="post" class="row">
        <div class="row">
            <label for="type" ><b>type</b></label>
            <input type="text" placeholder="type" name="type" id="type" included>
        </div>
        <div class="row">
            <label for="univers" ><b>Modèle</b></label>
            <input type="text" placeholder="univers" name="univers" id="univers" included>
        </div>
        <div class="row">
            <label for="resume" ><b>resume</b></label>
            <input type="text" placeholder="resume" name="resume" id="resume" included>
        </div>
        <div class="row">
            <label for="histoire" ><b>Histoire</b></label>
            <input type="text" placeholder="histoire" name="histoire" id="histoire" included>
        </div>
        <div class="row"></div>
         <button type="submit">Création de voiture</button>
        </div>
    </form>
</div>
    
</body>
</html>