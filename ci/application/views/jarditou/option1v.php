<option value="">Choisir une catégorie</option>
<?php  foreach ($option1 as $row): ?>
           <option value="<?= $row->cat_id?>" <?php if (isset($_SESSION['id_cat']) and $_SESSION['id_cat'] == $row->cat_id ) {echo" selected";} ?>><?=$row->cat_nom?></option>
<?php endforeach; ?>

<?php

$_SESSION['id_cat']="";
unset($_SESSION['id_cat']);