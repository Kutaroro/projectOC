<?php

include("Personnage.php");
include("Histoire.php");
include("Description.php");


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
    <form action="ficheHistoire.php" method="post" class="row">
        <div class="row">
            <label for="type" ><b>type</b></label>
            <input type="text" placeholder="type" name="type" id="type" included>
        </div>
        <div class="row">
            <label for="univers" ><b>Univers</b></label>
            <input type="text" placeholder="univers" name="univers" id="univers" included>
        </div>
        <div class="row">
            <label for="description" ><b>description</b></label>
            <input type="text" placeholder="description" name="description" id="description" included>
        </div>
         <div class="row">
            <label for="histoire" ><b>histoire</b></label>
            <input type="text" placeholder="histoire" name="histoire" id="histoire" included>
        </div>

        <input type="hidden" name="idPersonnage" value="<?= $idPersonnage ?>">

        <div class="row"></div>
         <button type="submit">Confirmer</button>
        </div>
    </form>
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
                    </tr>";
                }

                ?>
               

            </tbody>

    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>