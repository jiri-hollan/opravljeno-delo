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
/***
za enkrat semafor nerabi parameter, ker ni več opcij
vseeno sem dal v switch
**/
 if(isset($_GET['semafor'])){
  switch ($_GET['semafor']){
    case "d":
	$podminka=NULL;
     new countPregled($podminka);
    break;
    default:
     echo"semafor GET ni pravi";
  }
 }
 
 if(isset($_POST['semafor'])){
  switch ($_POST['semafor']){
	case "d":
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
       //  new SestevekDela($podminka);	
      new countPregled($podminka);
    break;
    default:
	echo $_POST['semafor'];
     echo"semafor POST ni pravi";	  
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
function __construct($podminka) {
$tabulka = 'bolnikTbl';
$stolpci=["imeZdravnika"];
$grupa=["imeZdravnika"];
//echo var_dump($podminka);
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
	echo"<script>intervalFunction($danes)</script>"; 
//echo"<div id='intervalId'>razdoblje</div>";



 }//od construct  
}//od class VyberImaStevilko
//CCCCCCCCCCCCC KONEC  CLASS SestevekDela  CCCCCCCCCCCCCCCCCCCCCCCCCCC

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
