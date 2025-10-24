<?php

include("Personnage.php");
include("Description.php");


$user="root";
$pass="";
$dbname="OC_Personnage";
$host="localhost:3307";


$db = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//ON prend l'id du personnage qui était dans l'url
$idPersonnage = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$requete = $db->query("SELECT * FROM Description as d INNER JOIN Personnage as p on d.idPersonnage=p.id WHERE IdPersonnage = $idPersonnage");
$requete->setFetchMode(PDO::FETCH_CLASS,"Description");
$descriptions = $requete->fetchAll();


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Liste caracteres</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<!-- Modification des infos de bases -->
<div class="container d-flex p-2">
    <h1 class="row">Formulaire physique</h1>
    <form action="ficheDescription.php" method="post" class="row">
        <div class="row">
            <label for="genre" ><b>Genre</b></label>
            <input type="text" placeholder="genre" name="genre" id="genre" included>
        </div>
        <div class="row">
            <label for="taille" ><b>Taille</b></label>
            <input type="text" placeholder="taille" name="taille" id="taille" included>
        </div>
        <div class="row">
            <label for="physique" ><b>Apparence physique</b></label>
            <input type="text" placeholder="physique" name="physique" id="physique" included>
        </div>
         <div class="row">
            <label for="caractere" ><b>Personalité</b></label>
            <input type="text" placeholder="caractere" name="caractere" id="caractere" included>
        </div>

        <input type="hidden" name="idPersonnage" value="<?= $idPersonnage ?>">

        <div class="row"></div>
         <button type="submit">Confirmer</button>
        </div>
    </form>
</div>


<?php 
    if(isset($_POST["caractere"])){ // Comment faire pour tout le formulaire?
        $idPersonnage = isset($_POST['idPersonnage']) ? (int)$_POST['idPersonnage'] : 0;
        $genre=trim($_POST['genre']);
        $taille=trim($_POST['taille']);
        $physique=trim($_POST['physique']);
        $caractere = trim($_POST['caractere']);

        $requete = $db->prepare("INSERT INTO Description (idPersonnage,genre,taille,physique,caractere) VALUES (?,?,?,?,?)");
        $requete->execute([$idPersonnage,$genre,$taille,$physique,$caractere]);

        // Si je veux pas me retrouver avec 50 fois la même ligne en actualisant
        //Voulais mettre dans le form mais ça a tout cassé ._. donc on va rester avec ça
       header("Location: " . $_SERVER['PHP_SELF'] . "?id=" . $idPersonnage);
        exit();


    }
?>


<div class="container d-flex justify-content-center align-items-start py-5">
    <div class="table-responsive w-75"> 
        <table class="table table-striped table-bordered mx-auto">
            <thead class="table-dark">
                <tr>
                    <th>TODO FLEMME</th>
                    <th>TODO FLEMME</th>
                    <th>TODO FLEMME</th>
                    <th>TODO FLEMME</th>
                    <th>TODO FLEMME</th>
            </thead>
            <tbody>

                <?php 
                foreach($descriptions as $description){
                echo "<tr>
                        <td>".$description->getId()." </td>
                        <td>".$description->getGenre()." </td>
                        <td>".$description->getTaille()."</td>
                        <td>".$description->getPhysique()."</td>
                        <td>".$description->getCaractere()."</td>
                    </tr>";
                }

                ?>
               

            </tbody>

    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>