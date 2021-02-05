<?php
if  (isset ($_SESSION["status"])){

?>
    <br>
    <a class="d-flex justify-content-center btn-secondary" href="<?= base_url("index.php/jarditou/ajouter")?>">Créer un nouvel enregistrement</a>
     
    <p id="tableau"></p>
    <div class="table-responsive"> <!--tableau responsive-->
      <table class="table table-hover table-bordered w-100 w-sm-50"> <!--tableau avec separation des ligne et contour-->
          <thead>
            <tr class="table-active">
              <th>Photo</th>
              <th>ID</th>
              <th>Catégorie</th>
              <th>Référence</th>
              <th>Libellé</th>
              <th>Prix</th>
              <th>stock</th>
              <th>Couleur</th>
              <th>Ajout</th>
              <th>Modif</th>
              <th>bloqué</th>
            </tr>   
          </thead>
          <tbody>

          <?php 

/*<td class="d-flex justify-content-center table-warning"><img src="jarditou_photos/<?=$row->pro_id.".".$row->pro_photo;?>" alt="<?=$row->pro_id.".".$row->pro_photo;?>" width="100"></td>*/
foreach ($pagination as $row){
                    
                echo'<tr>';?>
                    <td class="table-warning"><img src="<?php echo base_url("assets/images/".$row->pro_id);?>" alt="<?=$row->pro_id.".".$row->pro_photo;?>" width="100">.</td>
                    
            <?php
                    echo"<th class='table-warning'>".$row->pro_id."</th>";
                    echo"<th >".$row->cat_nom."</th>";
                    echo"<th class='table-warning'>".$row->pro_ref."</th>";?>
                    <th><a href="<?= base_url("index.php/jarditou/detail/".$row->pro_id);?>" title="<?=$row->pro_libelle;?>"><?=$row->pro_libelle;?></a></th>
                    <?php echo"<th class='table-warning'>".$row->pro_prix."</th>";
                    
                    if ($row->pro_stock == 0)  {echo"<th>"."Rupture de stock"."</th>";} else {echo"<th>".$row->pro_stock."</th>";}
                    
                    echo"<th class='table-warning'>".$row->pro_couleur."</th>";
                    echo"<th>".$row->pro_d_ajout."</th>";
                    echo"<th class='table-warning'>".$row->pro_d_modif."</th>";
                    
                    echo "<th>";
                    
                    if ($row->pro_bloque == 1){   ?>
                        
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModalScrollable">Bloqué</button>
                            <div class="modal" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalCenteredLabel">Produit Bloqué</h5>
                                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                </button>
                                        </div>
                                        <div class="modal-body">Nous vous tiendront informé sur les futurs disponibilités du produit</div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary" data-dismiss="modal">Ok</button>
                                           
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </th>
                </tr> 
                <?php } ?> 
        </tbody>        
      </table>
      <br>
      <h5 class="d-flex justify-content-center"><?php echo $links; ?></h5>
      <br>
      
    </div>


    

    <?php }

else  { ?>
    
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
       $_SESSION['ref']="";
       $_SESSION["fich"]="";
       unset($_SESSION['ref']);
       unset($_SESSION["fich"]);
?>

