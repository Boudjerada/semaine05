<?php
  header('Access-Control-Allow-Origin: http://localhost/ajax_demo');  

  try 
  {      
     $db = new PDO('mysql:host=localhost;dbname=ajax_regions;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));   
  } 
  catch (Exception $e) 
  {
     echo'Erreur : '.$e->getMessage().'<br>';
     echo'N° : '.$e->getCode(); 
     die('Fin du script');
  }
  $id_region = $_GET["id_region"];
  $str_requete = "SELECT * FROM departements where dep_reg_id=".$id_region;
  $result = $db->query($str_requete);
  
  while ($row = $result->fetch(PDO::FETCH_OBJ)){?>

    <option value="<?= $row->dep_id?>"><?=$row->dep_nom?></option>
  
<?php
}
?>