<?php
if  (isset ($_SESSION["status"])){

?>

    <br>
    <p id="tableau"></p>
    <?php if  (isset ($_SESSION["existeproduit"])){?> <span id="alerte-existe" class="alert alert-danger"><?=$_SESSION['existeproduit'];?></span><?php }?>
    <?php if  (isset ($_SESSION["errqte"])){?> <span id="alerte-positif" class="alert alert-danger"><?=$_SESSION['errqte'];?></span><?php }?>
    <br>
    <?php echo form_error('pro_qte'); // affiche l'erreur du champs concerné?>
    <br>
    <div class="table-responsive"> <!--tableau responsive-->
      <table class="table table-hover table-bordered w-100 w-sm-50"> <!--tableau avec separation des ligne et contour-->
          <thead>
            <tr class="table-active">
              <th>Photo</th>
              <th>Catégorie</th>
              <th>Référence</th>
              <th>Libellé</th>
              <th>Prix</th>
              <th>Couleur</th>
              <th>Ajout Panier</th>
            </tr>   
          </thead>
          
          <tbody>
            
          <?php 

/*<td class="d-flex justify-content-center table-warning"><img src="jarditou_photos/<?=$row->pro_id.".".$row->pro_photo;?>" alt="<?=$row->pro_id.".".$row->pro_photo;?>" width="100"></td>*/
foreach ($pagination as $row){
                    
                echo'<tr>';?>
                    <td class="table-warning"><img src="<?php echo base_url("assets/images/".$row->pro_id);?>" alt="<?=$row->pro_id.".".$row->pro_photo;?>" width="100">.</td>
                    
            <?php
                    echo"<th class='table-warning'>".$row->cat_nom."</th>";
                    echo"<th>".$row->pro_ref."</th>";?>
                    <th class='table-warning'><a href="<?= base_url("index.php/jarditou/detail/".$row->pro_id."/");?>" title="<?=$row->pro_libelle;?>"><?=$row->pro_libelle;?></a></th>
                    <?php echo"<th>".$row->pro_prix."</th>";
                    echo"<th class='table-warning'>".$row->pro_couleur."</th>"; ?>
                
                   <th><?php 
                    /* Pour chaque produit, on ouvre un formulaire qui appellera 
                        * la méthode 'panier/ajouterPanier' 
                        * ... oh oh oh! ça sent la boucle...  
                    */
                        echo form_open("jarditou/ajouterPanier"); 
?>

                    <!-- champ visible pour indiquer la quantité à commander -->
                        <input type="number" class="form-control" name="pro_qte" id="pro_qte" value="1">
                        <input type="hidden" name="pro_prix" id="pro_prix" value="<?= $row->pro_prix ?>">
                        <input type="hidden" name="pro_id" id="pro_id" value="<?= $row->pro_id ?>">
                        <input type="hidden" name="pro_libelle" id="pro_libelle" value="<?= $row->pro_libelle ?>">

                <!-- Bouton 'Ajouter au panier' -->
                        <div class="form-group">
                        <button class="btn btn-dark" type="submit">Ajouter au panier</button>           
                        </div>
                        
                    </form>
                </th>
            </tr>
            <?php }

          ?>
         
          </tbody>        
      </table>
      <br>
      <h5 class="d-flex justify-content-center"><?php echo $links; ?></h5>
      <br>
    </div>
    


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
       $_SESSION['existeproduit']="";
       $_SESSION['errqte'] ="";

       unset($_SESSION['existeproduit']);
       unset($_SESSION['errqte'] );
?>




