<?php
require_once 'administrace.php';
require_once 'databaseS.php';
$nazaj="statistikaMenu.php";
require_once('sabloni/zahlavi.php');
require_once('sabloni/formaPogoji.php');
require_once('opraviloVsiS.php');
require_once ('ogledStatistika.php');
//echo'<script src="js/statistika.js?'.time().'"></script>';
//echo'<script src="js/poDatumu.js?'.time().'"></script>';
//echo'<script src="js/ogledStatistika.js?'.time().'"></script>';
if(isset($_REQUEST['semafor'])){
new countPregled();
}else{echo"Nekaj je narobe, obvestite admina!";}
/************************************************************
*Tu pridejo predlogi SQL za pregled polj v tabli bolnikTbl
*naj bi vsbovali datum od-do ali določeno leto mesec ...
*iskanje po pogojih ==,>=,<=,vsebuje
*kombinacijo pogojev 
*prikaz pozdravniku
*grafične prikaze določi dodatna obdelava arrayev
************************************************************/

/******* SQL za prikaz vseh zdravnikov in števila njigovih zapisov***

SELECT imeZdravnika, COUNT(*) AS steviloZapisov
FROM bolnikTbl
GROUP BY imeZdravnika
ORDER BY steviloZapisov DESC;

*********************************************************************/

//CCCCCCCCCCCCCCC CLASS countPregled  CCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCC
class countPregled {
public $tabulka;
function __construct() {
$tabulka = 'bolnikTbl';
$stolpci=["imeZdravnika"];
$grupa=["imeZdravnika"];
   $counta = new databaseS();
   $vybrano=$counta->counta($tabulka, $stolpci, $grupa );
//echo "<br>";
//echo var_dump($vybrano);
//echo "<br>";
//echo var_dump($vybrano[0]);
//echo "<br>"
//echo 'deloStatistika.php linija 72 '. count($vybrano);
//echo "<br>";
//echo "<br>";
  if(count($vybrano)>0){
  echo "<table id='pocet' style='border: solid 1px black;'>";
/* nadpisi se morajo ujemati s prikazanimi stlpci v vyberFunction*/
  echo "<tr class='glavaTable'><th>ime Zdravnika</th><th>stevilo pregledov</th></tr>";
    foreach(new DeloRows(new RecursiveArrayIterator($vybrano)) as $k=>$v) {
        echo $v;
   }//od foreach
  }//od if(cout)
 else {
 echo 'V izbranem terminu ni zapisov o opravljenem delu ';
 }	 
 }//od construct  
}//od class VyberImaStevilko
//CCCCCCCCCCCCC KONEC  CLASS SestevekDela  CCCCCCCCCCCCCCCCCCCCCCCCCCC

//CCCCCCCCCCCCCCC CLASS TABLE ROWS CCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCC
class DeloRows extends RecursiveIteratorIterator {
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
	  //echo "<td onclick=" . '"poDatumuFunction('. "'vyber'".')"'.'"' . ">izberi</td></tr>" . "\n";
      //echo '<td onclick="poDatumuFunction('."'vyber'".')">izberi</td></tr>';	  
        echo '</tr>';
    }//od endChildren
}// od class DeloRows
//CCCCCCCCCCCCCCC KONEC CLASS TABLE ROWS CCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCC
