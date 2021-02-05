
<?php
if  (isset ($_SESSION["status"])){

?>

        <h1 class="d-flex-justify-content-center"><b>Ajout d'un produit</b></h1>  
        <?php echo form_open_multipart(); ?>
        
        
        
        <label for="select1"><b>Nom catégorie<b></label>
        <select class="form-control" name="pro_cat_id" id="select1"></select>
        <?php echo form_error('pro_cat_id'); // affiche l'erreur du champs concerné?>
        <label for="select2"><b>Sous catégorie<b></label>
        <select class="form-control" name="pro_cat_id2" id="select2"></select>
       

        <div class="form-group">
            <label for="pro_ref"><b>Réference produit</b></label><input type="text" class="form-control" name="pro_ref" id="pro_ref" value="<?php echo set_value('pro_ref'); ?>">
            <?php echo form_error('pro_ref'); // affiche l'erreur du champs concerné?>
            <br>
            <?php if  (isset ($_SESSION["ref"])){?> <span id="alerte-mail" class="alert alert-danger"><?=$_SESSION['ref'];?></span><?php }?>
            <br>
            <label for="pro_libelle"><b>Libéllé produit</b></label><input type="text" class="form-control" name="pro_libelle" id="pro_libelle" value="<?php echo set_value('pro_libelle'); ?>">
            <label for="pro_description"><b>Description produit</b></label><input type="text" class="form-control" name="pro_description" id="pro_description" value="<?php echo set_value('pro_description'); ?>">
            <label for="pro_prix"><b>Prix</b></label><input type="text" class="form-control" name="pro_prix" id="pro_prix" value="<?php echo set_value('pro_prix'); ?>">
            <?php echo form_error('pro_prix'); // affiche l'erreur du champs concerné?>
            <label for="pro_stock"><b>Quantité en stock</b></label><input type="text" class="form-control" name="pro_stock" id="pro_stock" value="<?php echo set_value('pro_stock'); ?>">
            <?php echo form_error('pro_stock'); // affiche l'erreur du champs concerné?>
            <label for="pro_couleur"><b>Couleur Produit</b></label><input type="text" class="form-control" name="pro_couleur" id="pro_couleur" value="<?php echo set_value('pro_couleur'); ?>">
        </div>      
        <b>Produit bloqué&nbsp&nbsp<b>
        <div class="form-check form-check-inline">
             <label class="form-check-label" for="pro_bloque"><input class="form-check-input" type="radio" name="pro_bloque" id="pro_bloque1" value=1>bloque</label>
        </div>
        <div class="form-check form-check-inline">
            <label class="form-check-label" for="pro_bloque"><input class="form-check-input" type="radio" name="pro_bloque" id="pro_bloque2" value=0>Non bloque</label>
        </div>
        <br>
        <br>
        <label for="pro_d_ajout"><b>Date d'ajout :</b></label><input type="text" class="form-control" name="pro_d_ajout" id="pro_d_ajout" value='<?php date_default_timezone_set("Europe/Paris"); echo date("Y-m-d h:i:s"); ?>' Readonly>
        <br>
        <input type="file" name="fichier" id="fichier">
        <br>
        <br>
        <?php if  (isset ($_SESSION["fich"])){?> <span id="alerte-mail" class="alert alert-danger"><?=$_SESSION['fich'];?></span><?php }?>
        <br>
        <br>
        <div class="d-flex justify-content-center" name ="actionProduit">
                <button class="btn-primary ml-1" type="submit" onclick="verif();" >Enregistrer</button>
                <a class="btn-primary ml-2"   href="<?= base_url("index.php/Pagination");?>">Annuler</a>
        </div>
    </form>

   

    <br>

<script>
//vérifie si on envoit ou non le formulaire à "script_modif.php"
function verif(){ 
    //Rappel : confirm() -> Bouton OK et Annuler, renvoit true ou false
    var resultat = confirm("Etes-vous certain de vouloir ajouter cet enregistrement ?");

    //alert("retour :"+ resultat);

    if (resultat==false){
        alert("Vous avez annulé l'enregistrement' \nAucun ajout ne sera apportée à cet enregistrement !");
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


<?php
       $_SESSION['ref']="";
       $_SESSION["fich"]="";
       unset($_SESSION['ref']);
       unset($_SESSION["fich"]);
?>