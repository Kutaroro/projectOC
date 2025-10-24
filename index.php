<?php

require("Personnage.php");
require("Histoire.php");
require("Description.php");


?>
<!DOCTYPE html>
<html lang="fr">
<head>
   <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Liste clients</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    

<?php

$personnage1= new Personnage("Nom1");
?>


<div class="container-fluid d-flex justify-content-center align-items-start bg-primary p-3  ">
    <h1 style="color:white">Liste des personnages </h1>
</div>

<div class="container mt-4">
    <!-- bouton pour afficher la ligne de formulaire -->
    <button id="toggleForm" class="btn btn-primary mb-3">Ajouter un personnage</button>

    <!-- ligne de formulaire masquée par défaut -->
    <div id="nomFormulaire" class="card p-3 mb-3" style="display:none; max-width:600px;">
        <form method="post" class="row g-2 align-items-center">
            <div class="col">
                <label class="form-label visually-hidden" for="nom">Nom</label>
                <input type="text" name="nom" id="nom" class="form-control" placeholder="Nom du personnage" required>
            </div>
            <div class="col-auto">
                <button type="submit" name="create_personnage" class="btn btn-success">Créer</button>
                <button type="button" id="cancelForm" class="btn btn-secondary">Annuler</button>
            </div>
        </form>
    </div>
</div>

<div class="container d-flex justify-content-center align-items-start py-5">
    <div class="table-responsive w-75"> 
        <table class="table table-striped table-bordered mx-auto">
            <thead class="table-dark">
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Titre</th>
                    <th>Ville</th>
                    <th>Modifier histoire</th>
                    <th>Modifier description</th>
                </tr>
            </thead>
            <tbody>
                

            </tbody>





<script>
document.addEventListener('DOMContentLoaded', function () {
    const toggle = document.getElementById('toggleForm');
    const formRow = document.getElementById('formRow');
    const cancel = document.getElementById('cancelForm');

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