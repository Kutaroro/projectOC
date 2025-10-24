
<?php
// J'ai crée à la main mais je garde sous la main au cas où
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
                        );"); // A modifier pour clé etrangère
?>