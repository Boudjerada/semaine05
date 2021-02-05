<?php 
header('Access-Control-Allow-Origin: http://localhost/ajax_demo');  

try 
{      
   $db = new PDO('mysql:host=localhost;dbname=jarditou;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));   
} 
catch (Exception $e) 
{
   echo'Erreur : '.$e->getMessage().'<br>';
   echo'N° : '.$e->getCode(); 
   die('Fin du script');
}

$str_requete = "SELECT * FROM produits";
$result = $db->query($str_requete);

$liens = $result->fetchAll(PDO::FETCH_OBJ);
echo json_encode($liens);

$result->closeCursor();
?>