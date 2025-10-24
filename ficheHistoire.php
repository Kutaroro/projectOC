<?php

include("Personnage.php");
include("Histoire.php");


$user="root";
$pass="";
$dbname="OC_Personnage";
$host="localhost:3307";


$db = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//ON prend l'id du personnage qui était dans l'url
$idPersonnage = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$requete = $db->query("SELECT * FROM Histoire as h INNER JOIN Personnage as p on h.idPersonnage=p.id WHERE IdPersonnage = $idPersonnage");
$requete->setFetchMode(PDO::FETCH_CLASS,"Histoire");
$histoires = $requete->fetchAll();


if(isset($_POST['delete'])){
    $id_efface = (int)$_POST['delete'];
    echo $id_efface;
    $requeteDel = $db->query("DELETE FROM Histoire WHERE id = $id_efface ");   
    
    // Redirection pour actualiser la page
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
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
<div class="container-fluid d-flex justify-content-center align-items-start bg-primary p-3  ">
    <h1 style="color:white">Liste histoires </h1>
</div>

<div class="container d-flex justify-content-center align-items-start p-3 mt-3 ">
    <form action="ficheHistoire.php" method="post" class="row">
        <div class="row">
            <label for="type" ><b>Type/Titre: Ce qui vous permettra d'identifier l'histoire. (Notes,idées,backstory,fun-facts...) </b></label>
            <input type="text" placeholder="type" name="type" id="type" included>
        </div>
        <div class="row">
            <label for="univers" ><b>Univers/Monde du personnage. Dans quel histoire il est.</b></label>
            <input type="text" placeholder="univers" name="univers" id="univers" included>
        </div>
        <div class="row">
            <label for="description" ><b>Description courte en quelques lignes ou prises de notes</b></label>
            <input type="text" placeholder="description" name="description" id="description" included>
        </div>
         <div class="row">
            <label for="histoire" ><b>Histoire complète ou détails en plus si prise de notes</b></label>
            <input type="text" placeholder="histoire" name="histoire" id="histoire" included>
        </div>

        <input type="hidden" name="idPersonnage" value="<?= $idPersonnage ?>">

        <div class="mt-3"></div>
         <button type="submit">Confirmer</button>
        </div>
    </form>
    </div>
</div>


<?php 
    if(isset($_POST["histoire"])){ // Comment faire pour tout le formulaire?
        $idPersonnage = isset($_POST['idPersonnage']) ? (int)$_POST['idPersonnage'] : 0;
        $type=trim($_POST['type']);
        $univers=trim($_POST['univers']);
        $description=trim($_POST['description']);
        $histoire = trim($_POST['histoire']);

        $requete = $db->prepare("INSERT INTO Histoire (idPersonnage,type,univers,description,histoire) VALUES (?,?,?,?,?)");
        $requete->execute([$idPersonnage,$type,$univers,$description,$histoire]);

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
                foreach($histoires as $histoire){
                echo "<tr>
                        <td>".$histoire->getId()." </td>
                        <td>".$histoire->getType()." </td>
                        <td>".$histoire->getUnivers()."</td>
                        <td>".$histoire->getDescription()."</td>
                        <td>".$histoire->getHistoire()."</td>
                        <td>
                            <form method=\"post\" onsubmit=\"return confirm('Êtes vous sûr de supprimer ce personnage ?');\">
                                <input type=\"hidden\" name=\"delete\" value=". $histoire->getId().">
                                <button type=\"submit\" class=\"btn btn-danger btn-sm\">Effacer l'histoire</button>
                            </form>
                        </td>
                    </tr>";
                }

                ?>
               

            </tbody>

    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>