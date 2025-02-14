<?php
require_once 'administrace.php';
require_once 'databaseS.php';
require_once('sabloni/zahlavi.php');
require_once 'sabloni/forma.php';
$nazaj="statistikaMenu.php.php";
new VyberZdravnika(1);
//CCCCCCCCCCCCCCC CLASS VYBER IMA STEVIKLO CCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCC
class VyberImaStevilko {
public $tabulka;
 function __construct( $podminka) {
	    $tabulka="uporabnikiTbl";
   /* stolpci se morajo ujemati z nadpisi stlpcev v "if(count)" linija 105*/
   $stolpci=["id", "bolnisnica", "ime", "priimek", "stevilkaZdravnika"];
   $vyber = new databaseS();
   $vybrano=$vyber->vyberPogoj($tabulka, $stolpci, $podminka );
//echo $vybrano[1];
//echo var_dump($vybrano);
 //  echo "<br>";
 //echo count($vybrano);
//$dolzina=count($vybrano);
//echo $vybrano[1];
//echo "<br>";
  if(count($vybrano)>0){
 echo'Število zdravnikov z vpisano zdravniško številko= '. count($vybrano);	  
  echo "<table id='osebe' style='border: solid 1px black;'>";
/* nadpisi se morajo ujemati s prikazanimi stlpci v vyberFunction*/
  echo "<tr class='glavaTable'><th>Id</th><th>bolnisnica</th><th>ime</th><th>priimek</th><th>stevilkaZdravnika</th></tr>";
    foreach(new TableRows(new RecursiveArrayIterator($vybrano)) as $k=>$v) {
        echo $v;
   }//od foreach
  }//od if(cout) 
  else{
  echo'v bazi ni zdravnikov z vpisano zdravniško številko';  
  }
 }//od construct  
}//od class VyberImaStevilko
//CCCCCCCCCCCCC KONEC  CLASS VYBER IMA STEVIKLO CCCCCCCCCCCCCCCCCCCCCCCCCCC
 
//CCCCCCCCCCCCCCC CLASS TABLE ROWS CCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCC
class TableRows extends RecursiveIteratorIterator {
    function __construct($it) {
        parent::__construct($it, self::LEAVES_ONLY);
    }
    function current() { 
		 return "<td  >"  . parent::current() . "</td>";
    }
    function beginChildren() {
        echo "<tr>";
    }
    function endChildren() {
        echo "<td onclick=" . '"izberiStevilkoZdravnikaFunction('. "'vyber'".')"'.'"' . ">izberi</td></tr>" . "\n";
    }//od endChildren
}// od class TableRows
//CCCCCCCCCCCCCCC KONEC CLASS TABLE ROWS CCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCC

class VyberZdravnika {
 function __construct( $podminka) {
$stevilkaZdravnika="1"; //"= 1"  TO DOLOČI, DA SO ZBRANI LE ZAPISI S ŠTEVILKO >0

if ($stevilkaZdravnika >0) {
$podminka = array("stevilkaZdravnika>"=>0);	   
//$podminka = array("stevilkaZdravnika>"=>$stevilkaZdravnika);
} else {
	   $podminka = NULL;
       }
new VyberImaStevilko($podminka);
 }//od construct  
}//od class VyberZdravnika
//CCCCCCCCCCCCC KONEC  CLASS VyberZdravnika CCCCCCCCCCCCCCCCCCCCCCCCCCC

echo'<script src="js/manipulaceZdravniki.js?'.time().'"></script>';
require_once 'sabloni/prijavljenJe.php';
require_once '../skupne/sabloni/zapati.php';
?>