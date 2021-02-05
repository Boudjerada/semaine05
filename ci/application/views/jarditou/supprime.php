
<?php
if  (isset ($_SESSION["status"])){

?>
            <div class="col-12 d-flex justify-content-center">
                <img src="<?php echo base_url("assets/images/".$produit->pro_id);?>" class="w-50" alt="Image responsive" title="<?=$produit->pro_id.".".$produit->pro_photo;?>" >
            </div>


            <h1 class="d-flex justify-content-center"><b><?=$produit->pro_libelle?></b></h1>
            <br>
            <h6>Etes vous sûr de vouloir supprimer&nbsp<b><?=$produit->pro_libelle?></b>&nbspde la base de données ?<h6>

            <br>
            <br>
           
            <?php echo form_open(); ?>
        
                <input type="hidden" name="pro_id" value="<?php echo $produit->pro_id; ?>">
                <div class="d-flex justify-content-center" name = actionProduit>    
                    <button type="submit" class="btn btn-dark" onclick="verif();">Supprimer</button>   
                    <a class="btn-primary ml-2"   href="<?= base_url("index.php/jarditou/detail/".$produit->pro_id);?>">Annuler</a>
                </div>
              
            </form>

            <br>

<script>
//vérifie si on envoit ou non le formulaire à "script_modif.php"
function verif(){ 
    //Rappel : confirm() -> Bouton OK et Annuler, renvoit true ou false
    var resultat = confirm("Etes-vous certain de vouloir supprimer cet enregistrement ?");

    //alert("retour :"+ resultat);

    if (resultat==false){
        alert("Vous avez annulé les modifications \nAucune suppression ne sera apportée!");
        //annule l'évènement par défaut ... SUBMIT vers "script_modif.php"
        event.preventDefault();    
    }
}
</script>



<?php }

else  {?>
    
    <!DOCTYPE html>
    <html lang="fr"> <!--indique la langue dans laquelle la page web est rédigéé aux robots de référencement ou aux logiciels de synthése vocale-->
    <!--les balises de la partie head ne sont pas affichées à l'exeption de title-->
    <head>
        <!--meta permet de fourni des indications différentes du contenu de la page web -->
        <meta charset="UTF-8"><!--permet de spécifier aux navigateurs l'encodage de la page web, il s'agit là de la valeur standard qui évite les pbs d'affichages des caractères spéciaux-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0",shrink-to-fit=no>
        <title>Document Contact</title>
        <!--on importe Bootstrap via une URL pointant sur un CDN (un serveur externe hébergeant des fichiers) -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    </head>
    <body>
        <div class="container"> <!--container global de la page-->
            <div class="row">
                <div class="col-12">
                    <img  src="<?php echo base_url("assets/images/promotion");?>"  class="w-100" alt="Image responsive" title="Image promotion"> <!--image esponsive s'adapte progressivement à la taille de l'ecran sans disparaitre-->
                </div>
            </div>
        <?php
            echo "<h1 class='d-flex justify-content-center'>"."Vous n'êtes pas autorisé à acceder sur cette pas"."</h1>";
            echo "<h3 class='d-flex justify-content-center'>"."Veuillez vous inscrire ou vous autentifier"."</h3>";
            echo "<br>";
            echo "<br>";
        ?>
            <a  class="btn btn-success d-flex justify-content-center" href="<?= base_url("index.php/jarditou/");?>">Inscription/Connexion</a>
        </div>      
        
        <!--fichiers Javascript nécessaires à Bootstrap-->
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        </body>
        </html>
        
       <?php } ?>