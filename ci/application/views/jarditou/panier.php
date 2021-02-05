<?php
if  (isset ($_SESSION["status"])){



?>


<p id="tableau"></p>
    <div class="table-responsive"> <!--tableau responsive-->
      <table class="table table-hover table-bordered w-100 w-sm-50"> <!--tableau avec separation des ligne et contour-->
          <thead>
            <tr class="table-active">
              <th>Photo</th>
              <th>Produit</th>
              <th>Prix</th>
              <th>Quantité</th>
              <th>Prix Total</th>
              <th>Modifier Panier</th>

            </tr>   
          </thead>
          <tbody>
            <?php
            $total = 0;
            for ($i = 0; $i <= count($_SESSION["panier"])-1; $i++){
                

                echo'<tr>';?>
                    <td class="table-warning"><img src="<?php echo base_url("assets/images/".$_SESSION["panier"][$i]['pro_id']);?>"  width="100">.</td>
            
    <?php
                    echo "<th class='table-warning'>".$_SESSION["panier"][$i]['pro_libelle']."</th>";
                    echo"<th class='table-warning'>".$_SESSION["panier"][$i]['pro_prix']." Euros"."</th>";
                    
                    echo"<th class='table-warning'>".$_SESSION["panier"][$i]['pro_qte']."</th>";
                    echo"<th class='table-warning'>".$_SESSION["panier"][$i]['pro_qte'] * $_SESSION["panier"][$i]['pro_prix']." Euros"."</th>";
                    
                    
                    $total = $total + ($_SESSION["panier"][$i]['pro_qte'] * $_SESSION["panier"][$i]['pro_prix']);
                  ?>
                    <th class='table-warning'><div class="d-flex justify-content-around">
                                                <a href="<?= base_url("index.php/jarditou/supprimerProduit/".$_SESSION["panier"][$i]['pro_id']);?>">Supprimer</a>
                                                
                                                <a class ="btn btn-dark ml-4" href="<?= base_url("index.php/jarditou/ajoutQuantite/".$_SESSION["panier"][$i]['pro_id']);?>">+</a>
                                               
                                                <a class ="btn btn-dark ml-2" href="<?= base_url("index.php/jarditou/diminueQuantite/".$_SESSION["panier"][$i]['pro_id']);?>">-</a>
                                              </div>
                    </th>
           
           <?php    echo"</tr>";
    
    
     
    }
       ?>
        </tbody> 
         
    </table>
    </div>
    <br>
    <br>
    <div>
      <?php if ($total != 0){?>
              <h3  class="d-flex justify-content-center">Le Montant total de votre panier est de <?= round($total - (($total * 20) / 100),2) ?> Euros HT</h3> 
              <br> 
              <h3  class="d-flex justify-content-center">TVA : 20%</h3>
              <br> 
              <h3  class="d-flex justify-content-center">Le Montant total de votre panier est de <?= round($total,2) ?> Euros TTC</h3>
              <br>
              <div class="d-flex justify-content-center" name ="actionProduit">
                <a  class="btn btn-dark" href="<?= base_url("index.php/jarditou/supprimepanier");?>">Vider le panier</a>
    </div>

      <?php }
            else {?>
              <h3 class="d-flex justify-content-center">Votre panier est vide</h3>
        <?php } ?>
    </div>
    <br>

    <div class="d-flex justify-content-center" name ="actionProduit">
                <a  class="btn btn-success" href="<?= base_url("index.php/Pagination/");?>">Retour</a>
    </div>

    <br>


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
        