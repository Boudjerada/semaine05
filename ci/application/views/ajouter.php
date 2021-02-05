<!DOCTYPE html>
    <html lang="fr">
    
<head>
    <meta charset="UTF-8">
    <title>Ajout produit</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0",shrink-to-fit=no>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>

<body>
<div class="container">
    <?php echo validation_errors(); // Affiche toutes les erreurs de validation?>
    <?php echo form_open(); ?> <!-- = <form action="http://localhost/ci/index.php/produits/ajouter" method="post"> -->
        <div class="form-group">
            <label for="pro_libelle">Libellé</label>
            <input type="text" name="pro_libelle" id="pro_libelle" class="form-control" value="<?php echo set_value('pro_libelle');?>">
        </div> 

        <div class="form-group">
            <label for="pro_ref">Référence</label>
            <input type="text" name="pro_ref" id="pro_ref" class="form-control" value="<?php echo set_value('pro_ref');?>"> 
            <br>
            <?php echo form_error('pro_ref'); // affiche l'erreur du champs concerné?>
        </div> 

        <button type="submit" class="btn btn-dark">Ajouter</button>    
    </form>
</div>

</body>
</html>