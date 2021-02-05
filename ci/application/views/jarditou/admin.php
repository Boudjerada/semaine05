
<?php
if  (isset ($_SESSION["status"])){

    if (isset ($_SESSION["insok"])){
        echo' <script> alert("Inscription réussi"); </script>';
    }
?>

<!DOCTYPE html>
<html lang="fr"> <!--indique la langue dans laquelle la page web est rédigéé aux robots de référencement ou aux logiciels de synthése vocale-->
<!--les balises de la partie head ne sont pas affichées à l'exeption de title-->
<head>
    <!--meta permet de fourni des indications différentes du contenu de la page web -->
    <meta charset="UTF-8"><!--permet de spécifier aux navigateurs l'encodage de la page web, il s'agit là de la valeur standard qui évite les pbs d'affichages des caractères spéciaux-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0",shrink-to-fit=no>
    <title>Inscription administrateur</title>
    <!--on importe Bootstrap via une URL pointant sur un CDN (un serveur externe hébergeant des fichiers) -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
    <div class="container"> <!--container global de la page-->
        <div class="row"> <!--création d'une ligne de 2 colonne de 6-->
            <div class="col-6"> 
                <!--d-none d-md-block supprime l'element sur petit écran -->
                <img src="<?php echo base_url("assets/images/jarditou_logo");?>" class="d-none d-md-block w-50 mt-2" alt="Image responsive" title="Image logo">
            </div>
            <div class="col-6">
                <!--display-6 est une taille de police-->
                <h2 class="d-none d-md-block display-6 float-right mr-5 mt-3">Tout le jardin</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <img src="<?php echo base_url("assets/images/promotion");?>" class="w-100" alt="Image responsive" title="Image promotion"> <!--image esponsive s'adapte progressivement à la taille de l'ecran sans disparaitre-->
            </div>
        </div>
    <br>
    <br>
    
    <h2 class="d-flex justify-content-center"><b>Formulaire d'inscription Administrateur</b></h2>  
        <p>Tout les champs sont obligatoires</p>
        <?php echo form_open(); ?>
            <div class="form-group">
                <label for="us_nom"><b>Nom</b></label><input type="text" class="form-control" name="us_nom" id="us_nom" value="<?=set_value('us_nom');?>" placeholder="Veuillez saisir votre nom" > <!--formcontrol pour mettre la zone de saisie en dessous du titre du champs-->
                <?php echo form_error('us_nom'); // affiche l'erreur du champs concerné?>
                <br>
                <label for="us_prenom"><b>Prenom</b></label><input type="text" class="form-control" name="us_prenom" id="us_prenom" value="<?=set_value('us_prenom');?>" placeholder="Veuillez saisir votre prénom" > <!--formcontrol pour mettre la zone de saisie en dessous du titre du champs-->
                <?php echo form_error('us_prenom'); // affiche l'erreur du champs concerné?>
                <br>
                <label for="us_mail"><b>E-mail</b></label><input type="text" class="form-control" name="us_mail" id="us_mail" value="<?=set_value('us_mail'); ?>" placeholder="Veuillez saisir votre mail" > <!--formcontrol pour mettre la zone de saisie en dessous du titre du champs-->
                <?php echo form_error('us_mail'); // affiche l'erreur du champs concerné?>
                <br>
                <?php if  (isset ($_SESSION["messMail"])){?> <span id="alerte-mail" class="alert alert-danger"><?=$_SESSION['messMail'];?></span><?php }?>
                <br>
                <br>
                <label for="us_log"><b>Login</b></label><input type="text" class="form-control" name="us_log" id="us_log" value="<?=set_value('us_log'); ?>" placeholder="Veuillez choisir un login de connexion de 6 caractères minimum" > <!--formcontrol pour mettre la zone de saisie en dessous du titre du champs-->
                <?php echo form_error('us_log'); // affiche l'erreur du champs concerné?>
                <br>
                <?php if  (isset ($_SESSION["messLogin"])){?> <span id="alerte-mail" class="alert alert-danger"><?=$_SESSION['messLogin'];?></span><?php }?>
                <br>
                <br>
                <label for="us_mp"><b>Mot de passe</b></label><input type="text" class="form-control" name="us_mp" id="us_mp" value="<?=set_value('us_mp');?>" placeholder="Veuillez choisir un mot de passe de connexion de 8 caractères" > <!--formcontrol pour mettre la zone de saisie en dessous du titre du champs-->
                <?php echo form_error('us_mp'); // affiche l'erreur du champs concerné?>
                <br>
                <label for="us_mp2"><b>Confirmer mot de passe</b></label><input type="text" class="form-control" name="us_mp2" id="us_mp2" placeholder="Veuillez confirmer vôtre mot de passe de connexion" > <!--formcontrol pour mettre la zone de saisie en dessous du titre du champs-->
                <br>
                <?php if  (isset ($_SESSION["messmdp"])){?> <span id="alerte-mail" class="alert alert-danger"><?=$_SESSION['messmdp'];?></span><?php }?>
                <br>
            </div>
            <div class="d-flex justify-content-center" name = "actioninscription">
                <button class="btn btn-dark" type="submit"  onclick="verif();">Inscription</button>
            </div>
        </form>
        <a  class="btn-primary" href="<?= base_url("index.php/jarditou/accueil");?>">Retour</a>

        <br>
    <br>
    <div class="row">
     <div class="col-12">
        <nav class="d-flex justify-content-center navbar navbar-expand-sm bg-dark navbar-dark">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                        <span class="navbar-toggler-icon"></span>
            </button> 
         <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="">mention légales</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="">horaires</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="">plan du site</a>
                    </li>
                </ul>
            </div> 
        </nav>
    </div>
</div>

</div>
        
<!--fichiers Javascript nécessaires à Bootstrap-->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>


<script>

//demande si on envoit ou non le formulaire au controleur
function verif(){ 
    //Rappel : confirm() -> Bouton OK et Annuler, renvoit true ou false
    var resultat = confirm("Etes-vous certain de vouloir valider vôtre inscription");

    //alert("retour :"+ resultat);

    if (resultat==false){
        alert("Vous avez annulé votre inscription !");
        //annule l'évènement par défaut ... SUBMIT vers "script_modif.php"
        event.preventDefault();    
    }
}
</script>



<?php


}

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
                    <img src="public/images/promotion.jpg"  class="w-100" alt="Image responsive" title="Image promotion"> <!--image esponsive s'adapte progressivement à la taille de l'ecran sans disparaitre-->
                </div>
            </div>
        <?php
            echo "<h1 class='d-flex justify-content-center'>"."Vous n'êtes pas autorisé à acceder sur cette pas"."</h1>";
            echo "<h3 class='d-flex justify-content-center'>"."Veuillez vous inscrire ou vous autentifier"."</h3>";
            echo "<br>";
            echo "<br>";
        ?>
            <a  class="btn btn-success d-flex justify-content-center" href="<?= base_url("index.php/jarditou");?>">Inscription/Connexion</a>
        </div>      
        
        <!--fichiers Javascript nécessaires à Bootstrap-->
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        </body>
        </html>
        
       <?php } ?>


<?php


/*Detruction session pour réactualisation de la page */



$_SESSION["messMail"]="";
$_SESSION["messLogin"]="";
$_SESSION["messmdp"]="";
$_SESSION["insok"]="";




unset($_SESSION["messMail"]);
unset($_SESSION["messLogin"]);
unset($_SESSION["messmdp"]);
unset($_SESSION["insok"]);


?>