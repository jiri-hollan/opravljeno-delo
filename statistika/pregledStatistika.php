<?php
require_once 'administrace.php';
require_once 'databaseS.php';
$nazaj="statistikaMenu.php";
require_once('sabloni/zahlavi.php');
//require_once('sabloni/forma.php');
require_once('opraviloVsiS.php');
require_once ('ogledStatistika.php');
echo'<script src="js/bolnikPogoji.js?'.time().'"></script>';
echo"<div class='flex-container'>";
require_once('sabloni/forma.php');
echo'<script src="js/bolnikPogoji.js?'.time().'"></script>';
if(isset($_REQUEST['semafor'])){
  $tabulka="bolnikTbl";
/*************************************************
*$_GET semafor poslan iz statistikaMenu,
*definiran v menuStatistika_items
**************************************************/ 
 if(isset($_GET['semafor'])){
	$semafor = $_GET['semafor'];
    $podminka=NULL;
	 }
 /**************************************************************
*$_POST semafor poslan iz bolnikPogoji.js
*prikaže število pregledov po zdravnikih za določen interval
***************************************************************/
 if(isset($_POST['semafor'])){
	 $semafor = $_POST['semafor'];
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
 }
  switch ($semafor){
	case "pregledovalec":
	$stolpci=["imeZdravnika"];
	$grupa=["imeZdravnika"];
      new countPregled($tabulka, $stolpci, $grupa, $podminka, $semafor);
    break;
	case "asa":
	$stolpci=["asa"];
	$grupa=["asa"];
      new poKriterijih($tabulka, $stolpci, $grupa, $podminka, $semafor);
    break;
	case "mallampati":
	$stolpci=["mallampati"];
	$grupa=["mallampati"];
      new poKriterijih($tabulka, $stolpci, $grupa, $podminka, $semafor);
    break;
	case "sklep":
	$stolpci=["sklep"];
	$grupa=["sklep"];
      new poKriterijih($tabulka, $stolpci, $grupa, $podminka, $semafor);
    break;
	case "opiati":
	$stolpci=["opiati"];
	$grupa=["opiati"];
      new poKriterijih($tabulka, $stolpci, $grupa, $podminka, $semafor);
    break;
	case "druge_Ovisnosti":
	$stolpci=["dovisnosti"];
	$grupa=["dovisnosti"];
      new poKriterijih($tabulka, $stolpci, $grupa, $podminka, $semafor);
    break;
	case "alergija":
	$stolpci=["alergija"];
	$grupa=["alergija"];
      new poKriterijih($tabulka, $stolpci, $grupa, $podminka, $semafor);
    break;
//.........................................................................
	case "starost":
	$stolpci=["starost"];
	$grupa=["starost"];
	  $sloupceSQL = implode(', ', $stolpci);
  $razvrstitev ="CASE
		    WHEN $sloupceSQL < 10 THEN $sloupceSQL
		    WHEN $sloupceSQL BETWEEN 10 AND 100 THEN TRUNCATE($sloupceSQL, -1)           
		    WHEN $sloupceSQL BETWEEN 100 AND 110 THEN TRUNCATE($sloupceSQL, -2)
			ELSE '200&nbspneveljaven&nbspvnos'
		END";
      new poStarosti($tabulka, $stolpci, $razvrstitev, $grupa, $podminka, $semafor);
    break;
//.........................................................................
	case "ks":	
		$stolpci=["ks"];
	    $grupa=["ks"];
	    $sloupceSQL = implode(', ', $stolpci);
  $razvrstitev ="CASE
		    WHEN $sloupceSQL < 1 THEN 'ni&nbsppodatkov'
			WHEN $sloupceSQL BETWEEN 1 AND 3 THEN TRUNCATE($sloupceSQL, 0) 
		    WHEN $sloupceSQL BETWEEN 3 AND 5 THEN TRUNCATE($sloupceSQL, 0)           
		    WHEN $sloupceSQL BETWEEN 5 AND 10 THEN TRUNCATE($sloupceSQL, 0)
			WHEN $sloupceSQL BETWEEN 10 AND 19 THEN TRUNCATE($sloupceSQL, 0)
			WHEN $sloupceSQL BETWEEN 20 AND 50 THEN TRUNCATE($sloupceSQL, -1)
			ELSE 'verjetno&nbspneveljaven&nbspvnos'
		END";
      new poStarosti($tabulka, $stolpci, $razvrstitev, $grupa, $podminka, $semafor);
    break;
//.........................................................................
	case "hb":	
		$stolpci=["hb"];
	    $grupa=["hb"];
	    $sloupceSQL = implode(', ', $stolpci);
  $razvrstitev ="CASE
		    WHEN $sloupceSQL < 1 THEN 'ni&nbsppodatkov'
			WHEN $sloupceSQL BETWEEN 50 AND 200 THEN TRUNCATE($sloupceSQL, -1)
			ELSE 'verjetno&nbspneveljaven&nbspvnos'
		END";
      new poStarosti($tabulka, $stolpci, $razvrstitev, $grupa, $podminka, $semafor);
    break;
//.........................................................................
	case "trombociti":	
		$stolpci=["trombociti"];
	    $grupa=["trombociti"];
	    $sloupceSQL = implode(', ', $stolpci);
  $razvrstitev ="CASE
		    WHEN $sloupceSQL < 1 THEN ' ni&nbsppodatkov'
			WHEN $sloupceSQL BETWEEN 1 AND 150 THEN '<150'            
		    WHEN $sloupceSQL BETWEEN 100 AND 999 THEN TRUNCATE($sloupceSQL, -2)
			WHEN $sloupceSQL BETWEEN 1000 AND 20000 THEN TRUNCATE($sloupceSQL, -3)
			ELSE 'verjetno&nbspneveljaven&nbspvnos'
		END";
      new poStarosti($tabulka, $stolpci, $razvrstitev, $grupa, $podminka, $semafor);
    break;
//.........................................................................
	case "pbnp":	
		$stolpci=["pbnp"];
	    $grupa=["pbnp"];
	    $sloupceSQL = implode(', ', $stolpci);
  $razvrstitev ="CASE
		    WHEN $sloupceSQL < 1 THEN ' ni&nbsppodatkov'
			WHEN $sloupceSQL BETWEEN 1 AND 99 THEN '<100'            
		    WHEN $sloupceSQL BETWEEN 100 AND 999 THEN TRUNCATE($sloupceSQL, -2)
			WHEN $sloupceSQL BETWEEN 1000 AND 20000 THEN TRUNCATE($sloupceSQL, -3)
			ELSE 'verjetno&nbspneveljaven&nbspvnos'
		END";
      new poStarosti($tabulka, $stolpci, $razvrstitev, $grupa, $podminka, $semafor);
    break;
//.........................................................................

	case "spo2":
	$stolpci=["spo2"];
	$grupa=["spo2"];
	$sloupceSQL = implode(', ', $stolpci);
  $razvrstitev ="CASE
		    WHEN $sloupceSQL < 1 THEN ' ni&nbsppodatkov'          
		    WHEN $sloupceSQL BETWEEN 50 AND 100 THEN TRUNCATE($sloupceSQL, 1)
			ELSE 'verjetno&nbspneveljaven&nbspvnos'
		END";
      new poStarosti($tabulka, $stolpci, $razvrstitev, $grupa, $podminka, $semafor);
	  
	  
    break;
//.........................................................................
    default:
	echo $semafor;
     echo" semafor GET ali POST ni pravi";	  
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
	  echo"<div class='udaje'>";
	  if(isset($podminka["datPregleda>="])||isset($podminka["datPregleda<="])){
      echo "&nbsp;od:&nbsp;".$podminka["datPregleda>="]."&nbsp;&nbsp;do:&nbsp;".$podminka["datPregleda<="]."<br>";
      }
  echo "<table id='pocet'>";
/* nadpisi se morajo ujemati s prikazanimi stlpci v vyberFunction*/
  echo "<tr class='glavaTable'><th>ime Zdravnika</th><th>stevilo pregledov</th></tr>";
    foreach(new DeloRows(new RecursiveArrayIterator($vybrano)) as $k=>$v) {
        echo $v;
   }//od foreach
  echo"</table>";
  echo"</div>";
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
	  echo"<div class='udaje'>";
	  if(isset($podminka["datPregleda>="])||isset($podminka["datPregleda<="])){
      echo "&nbsp;od:&nbsp;".$podminka["datPregleda>="]."&nbsp;&nbsp;do:&nbsp;".$podminka["datPregleda<="]."<br>";
      } 
  echo "<table id='pocet'>";
/* nadpisi se morajo ujemati s prikazanimi stlpci v vyberFunction*/
//var_dump($grupa[0]);
//echo strtoupper($grupa[0]);
  echo "<tr class='glavaTable'><th>".strtoupper($semafor)."</th><th></th></tr>";
    foreach(new DeloRows(new RecursiveArrayIterator($vybrano)) as $k=>$v) {
        echo $v;
   }//od foreach
  echo"</table>";
  echo"</div>";  
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
function __construct($tabulka, $stolpci, $razvrstitev, $grupa, $podminka, $semafor){
//$tabulka = 'bolnikTbl';
//var_dump($grupa);
//var_dump($semafor);
  $this->podminka=$podminka;
  $skupina = new databaseS();
  $vybrano=$skupina->skupina($tabulka, $stolpci, $grupa, $this->podminka, $razvrstitev);
    if(count($vybrano)>0){
	  echo"<div class='udaje'>";
	  if(isset($podminka["datPregleda>="])||isset($podminka["datPregleda<="])){
      echo "&nbsp;od:&nbsp;".$podminka["datPregleda>="]."&nbsp;&nbsp;do:&nbsp;".$podminka["datPregleda<="]."<br>";
      }
  echo "<table id='pocet'>";
/* nadpisi se morajo ujemati s prikazanimi stlpci v vyberFunction*/
//var_dump($grupa[0]);
//echo strtoupper($grupa[0]);
  echo "<tr class='glavaTable'><th>".strtoupper($grupa[0])."</th><th></th></tr>";
    foreach(new DeloRows(new RecursiveArrayIterator($vybrano)) as $k=>$v) {
        echo $v;
   }//od foreach
  echo"</table>";
  echo"</div>";
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




echo"</div>";
?>