<?php
require_once 'administrace.php';
require_once 'databaseS.php';
$nazaj="statistikaMenu.php";
require_once('sabloni/zahlavi.php');
require_once('sabloni/forma.php');
require_once('opraviloVsiS.php');
require_once ('ogledStatistika.php');
echo'<script src="js/bolnikPogoji.js?'.time().'"></script>';
if(isset($_REQUEST['semafor'])){
  $tabulka="bolnikTbl";
/***
za enkrat semafor nerabi parameter, ker ni več opcij
vseeno sem dal v switch
**/
 if(isset($_GET['semafor'])){
	$semafor = $_GET['semafor'];
  //switch ($_GET['semafor']){
  switch ($semafor){	  
    case "pregledovalec":
/***prikaže število pregledov za celotno razdobje po zdravnikih***/
	$stolpci=["imeZdravnika"];
	$grupa=["imeZdravnika"];
    $podminka=NULL;
     new countPregled($tabulka, $stolpci, $grupa, $podminka, $semafor);
    break;
	case "asa":
	$stolpci=["asa"];
	$grupa=["asa"];
    $podminka=NULL;
	 new poKriterijih($tabulka, $stolpci, $grupa, $podminka, $semafor);
	break;
	case "mallampati":
	$stolpci=["mallampati"];
	$grupa=["mallampati"];
    $podminka=NULL;
	 new poKriterijih($tabulka, $stolpci, $grupa, $podminka, $semafor);
	break;
	case "sklep":
	$stolpci=["sklep"];
	$grupa=["sklep"];
    $podminka=NULL;
	 new poKriterijih($tabulka, $stolpci, $grupa, $podminka, $semafor);
	break;	
	case "opiati":
	$stolpci=["opiati"];
	$grupa=["opiati"];
    $podminka=NULL;
	 new poKriterijih($tabulka, $stolpci, $grupa, $podminka, $semafor);
	break;
	case "alergija":
	$stolpci=["alergija"];
	$grupa=["alergija"];
    $podminka=NULL;
	 new poKriterijih($tabulka, $stolpci, $grupa, $podminka, $semafor);
	break;	
    case "starost":
	$stolpci=["starost"];
	$grupa=["starost"];
    $podminka=NULL;
	 new poStarosti($tabulka, $stolpci, $grupa, $podminka, $semafor);
	break;	
    default:
     echo"semafor GET ni pravi";
  }
 }
 
 if(isset($_POST['semafor'])){
	 $podminka = [];
	 $danes='"'.date("Y-m-d").'"';
	 if(isset($_POST['zacDatum'])){
	 $this_zacDatum = $_POST['zacDatum'];
	 $podminka["datPregleda>="] = $this_zacDatum;
	 }else{$this_zacDatum =NULL;}
	 if(isset($_POST['koncDatum'])){
	 $this_koncDatum = $_POST['koncDatum'];
	 $podminka["datPregleda<="] = $this_koncDatum;
	  }else{$this_koncDatum =NULL;}
//var_dump($podminka); 
  switch ($_POST['semafor']){
	case "pregledovalec":
/**************************************************************
*semafor dDatum poslan iz bolnikPogoji.js
*prikaže število pregledov po zdravnikih za določen interval
***************************************************************/

	 $stolpci=["imeZdravnika"];
	 $grupa=["imeZdravnika"];
      new countPregled($tabulka, $stolpci, $grupa, $podminka, $_POST['semafor']);
    break;
	case "asa":
	$stolpci=["asa"];
	$grupa=["asa"];
      new poKriterijih($tabulka, $stolpci, $grupa, $podminka, $_POST['semafor']);
    break;
	case "mallampati":
	$stolpci=["mallampati"];
	$grupa=["mallampati"];
      new poKriterijih($tabulka, $stolpci, $grupa, $podminka, $_POST['semafor']);
    break;
	case "sklep":
	$stolpci=["sklep"];
	$grupa=["sklep"];
      new poKriterijih($tabulka, $stolpci, $grupa, $podminka, $_POST['semafor']);
    break;
	case "opiati":
	$stolpci=["opiati"];
	$grupa=["opiati"];
      new poKriterijih($tabulka, $stolpci, $grupa, $podminka, $_POST['semafor']);
    break;
	case "alergija":
	$stolpci=["alergija"];
	$grupa=["alergija"];
      new poKriterijih($tabulka, $stolpci, $grupa, $podminka, $_POST['semafor']);
    break;
	case "starost":
	$stolpci=["starost"];
	$grupa=["starost"];
      new poStarosti($tabulka, $stolpci, $grupa, $podminka, $_POST['semafor']);
    break;
	
    default:
	echo $_POST['semafor'];
     echo" semafor POST ni pravi";	  
  }
 }
}else{echo"ni REQUEST";}
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
function __construct($tabulka, $stolpci, $grupa, $podminka, $semafor) {
   $counta = new databaseS();
   $vybrano=$counta->counta($tabulka, $stolpci, $grupa, $podminka);
//echo "<br>";
//echo var_dump($vybrano);
//echo "<br>";
//echo var_dump($vybrano[0]);
//echo "<br>"
//echo 'deloStatistika.php linija 72 '. count($vybrano);
//echo "<br>";
//echo "<br>";
//var_dump($semafor);
  if(count($vybrano)>0){
	  if(isset($podminka["datPregleda>="])||isset($podminka["datPregleda<="])){
      echo "&nbsp;od:&nbsp;".$podminka["datPregleda>="]."&nbsp;&nbsp;do:&nbsp;".$podminka["datPregleda<="]."<br>";
      }
  echo "<table id='pocet' style='border: solid 1px black;'>";
/* nadpisi se morajo ujemati s prikazanimi stlpci v vyberFunction*/
  echo "<tr class='glavaTable'><th>ime Zdravnika</th><th>stevilo pregledov</th></tr>";
    foreach(new DeloRows(new RecursiveArrayIterator($vybrano)) as $k=>$v) {
        echo $v;
   }//od foreach
  echo"</table>";
   }else{
// echo var_dump($podminka);
	 echo "&nbsp;od:&nbsp;".$podminka["datPregleda>="]."&nbsp;&nbsp;do:&nbsp;".$podminka["datPregleda<="]."<br>";	 
     echo 'V izbranem terminu ni zapisov o opravljenem delu ';
     }
		$danes='"'.date("Y-m-d").'"';
//echo $semafor;
	echo"<script>intervalFunction($danes, '$semafor')</script>"; 
//echo"<div id='intervalId'>razdoblje</div>";
 }//od construct  
}//od class CountPregled
//CCCCCCCCCCCCC KONEC  CLASS count Pregled  CCCCCCCCCCCCCCCCCCCCCCCCCCC


//cccccccccccccc CLASS poKriterijih cccccccccccccccccccccccccccccccccccc
class poKriterijih {
/*******************************************************************
*(mogoče)
* brez kriterijev pokaže le število zapisov kje se $stolpec nahaja
*"SELECT $sloupceSQL, COUNT(*) AS steviloZapisov FROM $tabulka $podminkaSQL GROUP BY $grupaSQL ORDER BY $grupaSQL"
*******************************************************************/
public $tabulka;
function __construct($tabulka, $stolpci, $grupa, $podminka, $semafor){
//$tabulka = 'bolnikTbl';
//var_dump($grupa);
//var_dump($semafor);
  $this->podminka=$podminka;
  $counta = new databaseS();
  $vybrano=$counta->counta($tabulka, $stolpci, $grupa, $this->podminka);
    if(count($vybrano)>0){
	/*  if(isset($podminka["datPregleda>="])||isset($podminka["datPregleda<="])){
      echo "&nbsp;od:&nbsp;".$podminka["datPregleda>="]."&nbsp;&nbsp;do:&nbsp;".$podminka["datPregleda<="]."<br>";
      }*/
  echo "<table id='pocet' style='border: solid 1px black;'>";
/* nadpisi se morajo ujemati s prikazanimi stlpci v vyberFunction*/
//var_dump($grupa[0]);
//echo strtoupper($grupa[0]);
  echo "<tr class='glavaTable'><th>".strtoupper($grupa[0])."</th><th></th></tr>";
    foreach(new DeloRows(new RecursiveArrayIterator($vybrano)) as $k=>$v) {
        echo $v;
   }//od foreach
  echo"</table>";
   }else{
// echo var_dump($podminka);
	 echo "&nbsp;od:&nbsp;".$podminka["datPregleda>="]."&nbsp;&nbsp;do:&nbsp;".$podminka["datPregleda<="]."<br>";	 
     echo 'V izbranem terminu ni zapisov o opravljenem delu ';
     }
$danes='"'.date("Y-m-d").'"';
//echo $semafor;
echo"<script>intervalFunction($danes, '$semafor')</script>"; 
  }
}
//CCCCCCCCCCCCCCC konec CLASS po Kriterijih CCCCCCCCCCCCCCCCCCCCCCCCCCC

//CCCCCCCCCCCCCCC CLASS delo ROWS CCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCC
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
      //echo '<td onclick="poDatumuFunction('."'vyber'".')">izberi</td></tr>';	  
        echo '</tr>';
    }//od endChildren
}// od class DeloRows
//CCCCCCCCCCCCCCC KONEC CLASS delo ROWS CCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCC

//cccccccccccccc CLASS poStarosti cccccccccccccccccccccccccccccccccccc
class poStarosti {
/*******************************************************************
*(mogoče)
* brez kriterijev pokaže le število zapisov kje se $stolpec nahaja
*"SELECT $sloupceSQL, COUNT(*) AS steviloZapisov FROM $tabulka $podminkaSQL GROUP BY $grupaSQL ORDER BY $grupaSQL"
*******************************************************************/
public $tabulka;
function __construct($tabulka, $stolpci, $grupa, $podminka, $semafor){
//$tabulka = 'bolnikTbl';
//var_dump($grupa);
//var_dump($semafor);
  $this->podminka=$podminka;
  $skupina = new databaseS();
  $vybrano=$skupina->skupina($tabulka, $stolpci, $grupa, $this->podminka);
    if(count($vybrano)>0){
  echo "<table id='pocet' style='border: solid 1px black;'>";
/* nadpisi se morajo ujemati s prikazanimi stlpci v vyberFunction*/
//var_dump($grupa[0]);
//echo strtoupper($grupa[0]);
  echo "<tr class='glavaTable'><th>".strtoupper($grupa[0])."</th><th></th></tr>";
    foreach(new DeloRows(new RecursiveArrayIterator($vybrano)) as $k=>$v) {
        echo $v;
   }//od foreach
  echo"</table>";
   }else{
// echo var_dump($podminka);
	 echo "&nbsp;od:&nbsp;".$podminka["datPregleda>="]."&nbsp;&nbsp;do:&nbsp;".$podminka["datPregleda<="]."<br>";	 
     echo 'V izbranem terminu ni zapisov o opravljenem delu ';
     }
$danes='"'.date("Y-m-d").'"';
//echo $semafor;
echo"<script>intervalFunction($danes, '$semafor')</script>"; 
  }
}
//CCCCCCCCCCCCCCC konec CLASS po starosti CCCCCCCCCCCCCCCCCCCCCCCCCCC





?>