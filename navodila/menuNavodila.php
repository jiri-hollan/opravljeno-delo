<?php
require_once '../skupne/database.php';
require_once 'sabloni/vkladane/zahlavi.php';
require_once '../skupne/home.php';
echo '<a id="buttonDomov" href="' . $home . '" >Domov</a>';
//----------prijavni podatki za podatkovno bazo odvisno od uporabljenega strežnika------

$tabulka="besedilaTbl";
$stolpci=["tematika"];
$podminka=[""];
$vyber = new database();
$vybrano=$vyber->vyber($tabulka, $stolpci, $podminka );
//echo $vybrano[1];
//echo var_dump($vybrano);
echo "<br>";
/********prikaže izbiro vnešenega besedila iz podatkov v bazi "navodila" tabela "besedilaTbl"*******/
    $teme=array();
    foreach ($vybrano as $value) {
		$teme[] = $value["tematika"];
		$teme = array_unique($teme);
		}
//echo var_dump($teme);
//echo $value["tematika"];
echo'<nav id= "navodilaNav">
<ul class= "navodilaCl">';
/********v seznamu prikaže tematike iz baze ********/
foreach ($teme as $value){
//echo $value;	
echo'<li><a href="navodila.php?tematika='.$value.'">'.$value.'</a> </li>';
}
echo'</ul></nav>';
require_once '../skupne/sabloni/zapati.php';
?>