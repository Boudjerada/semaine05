<?php
// Connexion, avec par défaut les modes exception et objets 
$oPdo = new PDO("mysql:host=localhost;dbname=jarditou", "root", "", array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ) );

// Exécution de la requête (notez le chaînage de méthodes)
$aProduits = $oPdo->query("SELECT * FROM produits WHERE pro_cat_id=27")->fetchAll(); 

var_dump($aProduits); //Tableau d'objets un echo est pas possible

echo "<br>";
echo "<br>";
echo "<br>";

//Passage de PHP aJson
$sJson = json_encode($aProduits);
echo $sJson;

echo "<br>";
echo "<br>";
echo "<br>";

//Passage de Json a PHP
$aProduits2 = json_decode($sJson);
var_dump($aProduits2);

?>