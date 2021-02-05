<?php
if  (isset ($_SESSION["status"])){



?>
<!DOCTYPE html>
<html lang="fr"> <!--indique la langue dans laquelle la page web est rédigéé aux robots de référencement ou aux logiciels de synthése vocale-->
<!--les balises de la partie head ne sont pas affichées à l'exeption de title-->
<head>
    <!--meta permet de fourni des indications différentes du contenu de la page web -->
    <meta charset="UTF-8"><!--permet de spécifier aux navigateurs l'encodage de la page web, il s'agit là de la valeur standard qui évite les pbs d'affichages des caractères spéciaux-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0",shrink-to-fit=no>
    <title><?= $title ?></title>
    <!--on importe Bootstrap via une URL pointant sur un CDN (un serveur externe hébergeant des fichiers) -->
    <!--<link rel="stylesheet" href="../../assets/css/all.min.css">
    <link rel="stylesheet" href="../../assets/css/fontawesome.min.css">-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
    <div class="container"> <!--container global de la page-->
        <div class="row"> <!--création d'une ligne de 2 colonne de 6-->
            <div class="col-6"> 
                <!--d-none d-md-block supprime l'element sur petit écran -->
                <img src="<?php echo base_url("assets/images/jarditou_logo");?>"  class="d-none d-md-block w-50 mt-2" alt="Image responsive" title="Image logo">
            </div>
            <div class="col-6">
                <!--display-6 est une taille de police-->
                <h2 class="d-none d-md-block display-6 float-right mr-5 mt-3">Tout le jardin</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
<!--navbar-expand-sm qui indique à partir de quelle dimension (ici sm, donc à plus de 576px) la barre de navigation sera visible entièrement au lieu d'afficher le bouton hamburger.-->
            <nav class="navbar navbar-expand-sm bg-light navbar-light"> <!--couleur de la barre de navigation-->
                <span class=navbar-brand>Jarditou.com</span> <!--lien jarditou.com-->
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar1">
                    <span class="navbar-toggler-icon"></span>
                </button> 
                <div class="collapse navbar-collapse" id="collapsibleNavbar1">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url("index.php/jarditou/accueil");?>">Accueil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href=<?= base_url("index.php/Pagination/index");?>>Tableau</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url("index.php/jarditou/contact");?>">Contact</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url("index.php/jarditou/index");?>">Deconnexion</a>
                        </li>
                    </ul>
                </div>
                <form action ='#' class="form-inline d-sm-none d-md-block" id="search" role="search" > <!--form inline pour la même ligne, d-none et block supprime en dessous de md-->
                        <label for="search-imput" ></label>
                        <input type="search"  id="search-imput" name="Entrerpromotion" spellcheck="false" placeholder="Votre promotion"> <!--spellckeck analyse orthographe, placeholder message pour champs obligatoire-->
                        <input value="Recherche" type="submit" class="btn btn-outline-info py-1"> <!--padding de 1 en haut et en bas-->
                </form>
            </nav>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <img src="<?php echo base_url("assets/images/promotion");?>"   class="w-100" alt="Image responsive" title="Image promotion"> <!--image esponsive s'adapte progressivement à la taille de l'ecran sans disparaitre-->
            </div>
        </div>

<?php }

?>