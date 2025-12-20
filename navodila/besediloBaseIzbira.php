<?php
//----------prijavni podatki za podatkovno bazo odvisno od uporabljenega strežnika------

require_once '../skupne/database.php';
$tabulka="besedilaTbl";
$stolpci=["id", "tematika", "naslov", "direktorij","fajl"];
$podminka=[""];
$vyber = new database();
$vybrano=$vyber->vyber($tabulka, $stolpci, $podminka );
//echo $vybrano[1];
//echo var_dump($vybrano);
echo "<br>";
try {
//---------------------prikaže izbiro vnešenega besedila iz podatkov v bazi "navodila" tabela "besedilaTbl"------------------
    $teme=array();
    foreach ($vybrano as $value) {
		$teme[] = $value["tematika"];
		$teme = array_unique($teme);
		}
//echo var_dump($teme);
//echo $value["tematika"];

$tematika=$_GET['tematika'];

    echo '<ul class= "navodilaCl">';
    foreach ($vybrano as $value) {
//var_dump($value);
if($value["tematika"]==$tematika){
        echo '<li><a href= "' . $value["direktorij"] . $value["fajl"] . '" >' . $value["naslov"] . '</a></li>';
      }
}
    echo '</ul><br>';
	
    echo '<ul class= "navodilaCl">';
    foreach ($vybrano as $value) {
//var_dump($value);
/*
if($value["tematika"]=="Cellsaver"){
        echo '<li><a href= "' . $value["direktorij"] . $value["fajl"] . '" >' . $value["naslov"] . '</a></li>';
      }*/
}
    echo '</ul>';
	
    }
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;
echo "</table>";
?>
