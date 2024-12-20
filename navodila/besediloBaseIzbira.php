<?php
//----------prijavni podatki za podatkovno bazo odvisno od uporabljenega strežnika------

require_once '../skupne/database.php';
$tabulka="besedilaTbl";
$stolpci=["id", "naslov", "direktorij","fajl"];
$podminka=[""];
$vyber = new database();
$vybrano=$vyber->vyber($tabulka, $stolpci, $podminka );
//echo $vybrano[1];
//echo var_dump($vybrano);
echo "<br>";
try {
//---------------------prikaže izbiro vnešenega besedila iz podatkov v bazi "navodila" tabela "besedilaTbl"------------------	

echo '<ul id= "navodilaId">';
 foreach ($vybrano as $value) {
  //var_dump($value);
  echo '<li><a href= "' . $value["direktorij"] . $value["fajl"] . '" >' . $value["naslov"] . '</a></li>';
}
echo '</ul>';
    }
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;
echo "</table>";
?>
