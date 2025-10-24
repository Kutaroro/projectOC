<?php

require("Personnage.php");
require("Histoire.php");
require("Description.php");

$user="root";
$pass="";
$dbname="OC_Personnage";
$host="localhost:3307";


try {
     
    $db = new PDO("mysql:host=$host", $user, $pass);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // On verifie que la base n'existe pas déjà
    $test = $db->query("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '$dbname'");
    $bddExiste = $test->fetchColumn();
    
    if (!$bddExiste) { // Pour être sur que la BDD soit créee qu'une fois
        $sql = "CREATE DATABASE $dbname";
        $db->exec($sql);
       // echo "BDD Crée";
    } /*else {
        echo "La BDD existe";
    }*/
    
    $db = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
}catch(PDOException $e) {
    echo "" . $e->getMessage();
}


$requete=$db->query("CREATE TABLE IF NOT EXISTS Personnage (
                            Id int NOT NULL AUTO_INCREMENT,
                            Nom varchar(255) NOT NULL,
                            idHistoire int,
                            idDescription int,
                            PRIMARY KEY (id)
                        );");

$requete=$db->query("SELECT * from Personnage");
$requete->setFetchMode(PDO::FETCH_CLASS,"Personnage");
$personnages = $requete->fetchAll();

?>
<!DOCTYPE html>
<html lang="fr">
<head>
   <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Liste personnages</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    
<div class="container-fluid d-flex justify-content-center align-items-start bg-primary p-3  ">
    <h1 style="color:white">Liste des personnages </h1>
</div>

<div class="container mt-4">
    
    <button id="nomBouton" class="btn btn-primary mb-3">Ajouter un personnage</button>


    <div id="nomFormulaire" class="card p-3 mb-3" style="display:none; max-width:600px;">
        <form method="get" name="nom" class="row g-2 align-items-center">
            <div class="col">
                <label class="form-label visually-hidden" for="nom">Nom</label>
                <input type="text" name="nom" id="nom" class="form-control" placeholder="Nom du personnage" required>
            </div>
            <div class="col-auto">
                <button type="submit" name="create_personnage" class="btn btn-success">Créer</button>
                <button type="button" id="nomFermer" class="btn btn-secondary">Annuler</button>
            </div>
        </form>
    </div>
</div>

<?php
    if(isset($_GET["nom"])){
         try {
        
        $nom = trim($_GET['nom']);


        $nouveauPersonnage = new Personnage($nom);

        $requete = $db->prepare("INSERT INTO Personnage (nom) VALUES (:nom)");
        $nom = "%" . $_GET["nom"] . "%";
        $requete->bindParam(':nom', $nom, PDO::PARAM_STR);
        $requete->execute([$nom]);

    } catch(PDOException $e) {
        $message = "Erreur lors de la création du personnage : " . $e->getMessage();
    }
    }
    ?>



<div class="container d-flex justify-content-center align-items-start py-5">
    <div class="table-responsive w-75"> 
        <table class="table table-striped table-bordered mx-auto">
            <thead class="table-dark">
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Histoire</th>
                    <th>Description</th>
            </thead>
            <tbody>

                <?php 
                foreach($personnages as $personnage){
                echo "<tr>
                        <td>".$client->getId()." </td>
                        <td>".$client->getNom()." </td>
                        <td>".$client->getHistoire()."<a href='ficheHistoire.php?id=".$personnage->getId()."' class='text-decoration-none'> </td>
                        <td>".$client->getDescription()."<a href='ficheHistoire.php?id=".$personnage->getId()."' class='text-decoration-none'></td>
                    </tr>";
                }

                ?>
               

            </tbody>





<script>
document.addEventListener('DOMContentLoaded', function () {
    const toggle = document.getElementById('nomBouton');
    const formRow = document.getElementById('nomFormulaire');
    const cancel = document.getElementById('nomFermer');

    if (toggle) {
        toggle.addEventListener('click', () => {
            formRow.style.display = (formRow.style.display === 'none' || formRow.style.display === '') ? 'block' : 'none';
        });
    }
    if (cancel) {
        cancel.addEventListener('click', () => formRow.style.display = 'none');
    }
});
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>