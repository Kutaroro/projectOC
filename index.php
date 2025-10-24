<?php

require("Personnage.php");
require("Histoire.php");
require("Description.php");

$user="root";
$pass="";
$dbname="OC_Personnage";
$host="localhost:3307";

$db=new PDO("mysql:host=$host;dbname=$dbname",$user,$pass);

$requete=$db->query("SELECT * from Personnage");
$requete->setFetchMode(PDO::FETCH_CLASS,"Personnage");
$personnages = $requete->fetchAll();

if(isset($_POST['delete'])){
    $id_efface = (int)$_POST['delete'];
    echo $id_efface;
    $requeteDel = $db->query("DELETE FROM Personnage WHERE id = $id_efface ");   
    
    // Redirection pour actualiser la page
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

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

<div class="container-fluid d-flex justify-content-center align-items-start my-3"> 
    <div class="row">
    <form action="index.php" method="get">
        <input type="text" placeholder="Recherche" name="recherche" id="recherche" >
        <button type="submit">Rechercher</button>
    </form>



<div class="container mt-4">
    
    <button id="nomBouton" class="btn btn-primary mb-3">Ajouter un personnage</button>


    <div id="nomFormulaire" class="card p-3 mb-3" style="display:none; max-width:600px;">
        <form method="post" name="nom" class="row g-2 align-items-center">
            <div class="col">
                <label class="form-label visually-hidden" for="nom">Nom</label>
                <input type="text" name="nom" id="nom" class="form-control" placeholder="Nom du personnage" required>
            </div>
            <div class="col-auto">
                <button type="submit" name="creer_perso" class="btn btn-success">Créer</button>
                <button type="button" id="nomFermer" class="btn btn-secondary">Annuler</button>
            </div>
        </form>
        </div></div>
        </div>
    </div>
</div>
<?php 
    if(isset($_POST["nom"])){        
        $nom = trim($_POST['nom']);

        $requete = $db->prepare("INSERT INTO Personnage (nom) VALUES (?)");
        $requete->execute([$nom]);
        // Redirection pour actualiser la page
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }
?>

<div class="container d-flex justify-content-center align-items-start py-5">
    <div class="table-responsive w-75"> 
        <table class="table table-striped table-bordered mx-auto">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nom/ Nom de code</th>
                    <th>Toutes les histoires</th>
                    <th>Toutes les descriptions</th>
            </thead>
            <tbody>

                <?php 

                // RECHERCHE
                if (isset($_GET["recherche"])) {
                    $recherche = '%' . $_GET["recherche"] . '%';

                    $sql = "SELECT DISTINCT p.* FROM Personnage p
                            WHERE p.Nom LIKE :recherche
                            OR EXISTS (
                                SELECT 1 FROM Description d
                                WHERE d.idPersonnage = p.Id
                                    AND (d.genre LIKE :recherche OR d.race LIKE :recherche)
                            )
                            OR EXISTS (
                                SELECT 1 FROM Histoire h
                                WHERE h.idPersonnage = p.Id
                                    AND (h.univers LIKE :recherche OR h.type LIKE :recherche)
                            )";

                    $requeteR = $db->prepare($sql);
                    $requeteR->bindParam(':recherche', $recherche, PDO::PARAM_STR);
                    $requeteR->execute();
                    $requeteR->setFetchMode(PDO::FETCH_CLASS, "Personnage");
                    $personnages = $requeteR->fetchAll();
                }


                // Fonctionnement normal sans recherche
                foreach($personnages as $personnage){

                    $idPersonnage = $personnage->getId(); // ou depuis $_GET['id']

                    $requeteH = $db->query("SELECT * FROM Histoire WHERE idPersonnage = $idPersonnage ORDER BY id ASC");
                    $requeteH->setFetchMode(PDO::FETCH_CLASS,"Histoire");
                    $histoires = $requeteH->fetchAll();

                    $histoireF = [];
                    foreach($histoires as $histoire) {
                        $histoireF[] = $histoire->getType()."<br>";
                        $histoireF[] = $histoire->getUnivers()."<br>";
                        $histoireF[]="_______________<br/>";

                    }

                    $requeteD = $db->query("SELECT * FROM Description WHERE idPersonnage = $idPersonnage ORDER BY id ASC");
                    $requeteD->setFetchMode(PDO::FETCH_CLASS,"Description");
                    $descriptions = $requeteD->fetchAll();

                    $descriptionF = [];
                    foreach($descriptions as $description) {
                        $descriptionF[] = $description->getGenre();
                        $descriptionF[] = $description->getRace()."~";
                        $descriptionF[] = $description->getTaille()."<br/>";
                        $descriptionF[] = substr($description->getPhysique(), 0, 12)." ...<br/>";             
                        $descriptionF[] = substr($description->getCaractere(), 0, 12)." ...<br/>";  
                        $descriptionF[]="_______________<br/>";
                    }


                    echo "<tr>
                            <td>".$personnage->getId()." </td>
                            <td>".$personnage->getNom()." </td>
                            <td>".implode(" ", $histoireF)."<br/><a href='ficheHistoire.php?id=".$personnage->getId()."' class='text-decoration-none'>Voir plus/modifier</a></td>
                            <td>".implode(" ", $descriptionF)."<br/><a href='ficheDescription.php?id=".$personnage->getId()."' class='text-decoration-none'>Voir plus/modifier</a></td>
                            <td>
                                <form method=\"post\" onsubmit=\"return confirm('Êtes vous sûr de supprimer ce personnage ?');\">
                                    <input type=\"hidden\" name=\"delete\" value=". $personnage->getId().">
                                    <button type=\"submit\" class=\"btn btn-danger btn-sm\">Effacer le personnage</button>
                                </form>
                            </td>
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