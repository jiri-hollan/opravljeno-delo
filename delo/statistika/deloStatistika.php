<?php
require_once 'administrace.php';
require_once 'databaseS.php';
$nazaj="statistikaMenu.php";
require_once('sabloni/zahlavi.php');
require_once 'sabloni/forma.php';


/**
*V prvem bloku pobere iz uporabnikiTbl vse zapise v katerih je vnesena številka zdravnika
*in prikaže ime, priimek, številka zdravnika, upstatus in gdpr.
*s klikom na določenega zdravnika se odpre menu, kje se lahko: 
*1.Izbere število ur v določenem dnevu ali v dnevih od do. 
*2.Lahko se pogleda, kaj vse je bilo v določenem dnevu (dnevih) vpisano.
*3.Lahko se pogleda po šifri oravila trajanje le tega po dnedih ali v odstotku
*
*
*
**/
/*/////////////////////////////////////////////
SELECT OrderID, SUM(Quantity) AS [Total Quantity]
FROM OrderDetails
WHERE ProductID <=12
AND ProductID >=11
GROUP BY OrderID;
*//////////////////////////////////////////////*/
/**
variable:

public $tabulka = deloTbl;
public $zacDatum;
public $koncDatum;
public $stevilkaZdravnika;
public SqlCasDela = '

SELECT datumOpravila, SUM(casOpravila) AS [Po dnevih]
FROM $tabulka
WHERE stevilkaZdravnika = $stevilkaZdravnika
AND true
GROUP BY datumOpravila;

';

SELECT datumOpravila, SUM(casOpravila) AS [Po dnevih]
FROM $tabulka
WHERE stevilkaZdravnika = $stevilkaZdravnika
AND datumOpravila >= $zacDatum
AND datumOpravila >= $koncDatum
GROUP BY datumOpravila;

';

**/
//CCCCCCCCCCCCCCC CLASS SestevekDela  CCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCC
class SestevekDela {
public $tabulka;
 function __construct( $podminka) {
$tabulka = 'deloTbl';
//var_dump($podminka);
 $podminka ["datumOpravila="]='10.01.2025';
//var_dump($podminka);
	    /* stolpci se morajo ujemati z nadpisi stlpcev v "if(count)" linija 105*/
   $stolpci=["datumOpravila","SUM(casOpravila)"];
   $suma = new database();
   $vybrano=$suma->suma($tabulka, $stolpci, $podminka );
//echo $vybrano[1];
//echo var_dump($vybrano);
 //  echo "<br>";
 echo count($vybrano);
//$dolzina=count($vybrano);
//echo $vybrano[1];
//echo "<br>";
  if(count($vybrano)>0){
  echo "<table id='osebe' style='border: solid 1px black;'>";
/* nadpisi se morajo ujemati s prikazanimi stlpci v vyberFunction*/
  echo "<tr class='glavaTable'><th>datum</th><th>minute</th></tr>";
    foreach(new TableRows(new RecursiveArrayIterator($vybrano)) as $k=>$v) {
        echo $v;
   }//od foreach
  }//od if(cout) 
 }//od construct  
}//od class VyberImaStevilko
//CCCCCCCCCCCCC KONEC  CLASS SestevekDela  CCCCCCCCCCCCCCCCCCCCCCCCCCC




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

//$stevilkaZdravnika="6027"; //"= 1"  TO DOLOČI, DA SO ZBRANI LE ZAPISI S ŠTEVILKO >0
	 
	 if ($_SERVER["REQUEST_METHOD"] == "GET") {
		if (isset($_GET['stevilkaZdravnika'])){
     $stevilkaZdravnika = $_GET['stevilkaZdravnika'];
	 }
	 }
var_dump($stevilkaZdravnika);	 
if ($stevilkaZdravnika >0) {
//$podminka = array("stevilkaZdravnika>"=>0);	   
$podminka = array("stevilkaZdravnika="=>$stevilkaZdravnika);
} else {
	   $podminka = NULL;
       }
new SestevekDela($podminka);
echo'
<script src="js/manipulaceZdravniki.js?'.time().'">
</script>';
require_once 'sabloni/prijavljenJe.php';
require_once '../../skupne/sabloni/zapati.php';
?>