<!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Suppression d'un produit</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0",shrink-to-fit=no>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
    <body> 
        <div class="container"> <!--container global de la page-->

            <div class="col-12 d-flex justify-content-center">
                <img src="<?php echo base_url("assets/images/".$produit->pro_id);?>" class="w-50" alt="Image responsive" title="<?=$produit->pro_id.".".$produit->pro_photo;?>" >
            </div>


            <h1 class="d-flex justify-content-center"><b><?=$produit->pro_libelle?></b></h1>
            <br>
            <h3>Etes vous sûr de vouloir supprimer <b><?=$produit->pro_libelle?></b> de la base de données ?<h3>

            <br>
            <br>
           
            <?php echo form_open(); ?>
        
                <input type="hidden" name="pro_id" value="<?php echo $produit->pro_id; ?>">
                <div class="d-flex justify-content-center" name = actionProduit>    
                     <button type="submit" class="btn btn-dark">Supprimer</button>   
                    <a class="btn-primary ml-2"  href="<?php echo base_url("index.php/produits/home_view");?>">Annuler</a>
                </div>
              
            </form>

            <br>

           
       
       
       </div>

</body>
</html>