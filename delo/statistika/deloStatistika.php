<?php
require_once 'administrace.php';
require_once 'databaseS.php';
//require_once '../../skupne/database.php';
$nazaj="statistikaMenu.php";
require_once('sabloni/zahlavi.php');
//require_once 'sabloni/forma.php';
require_once('sabloni/formaPogoji.php');
require_once('opraviloVsiS.php');
require_once ('ogledStatistika.php');
echo'<script src="js/statistika.js?'.time().'"></script>';
echo'<script src="js/poDatumu.js?'.time().'"></script>';
echo'<script src="js/ogledStatistika.js?'.time().'"></script>';
/**
*V prvem bloku pobere iz uporabnikiTbl vse zapise v katerih je vnesena številka zdravnika
*in prikaže ime, priimek, številka zdravnika, upstatus in gdpr.
*s klikom na določenega zdravnika se odpre menu, kje se lahko: 
*1.Izbere število ur v določenem dnevu ali v dnevih od do. 
*2.Lahko se pogleda, kaj vse je bilo v določenem dnevu (dnevih) vpisano.
*3.Lahko se pogleda po šifri oravila trajanje le tega po dnedih ali v odstotku
**/
/**
variable:

public $tabulka = deloTbl;
public $zacDatum;
public $koncDatum;
public $stevilkaZdravnika;
public SqlCasDela = '


SELECT datumOpravila, SUM(casOpravila) 
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
 //$podminka ["datumOpravila="]=date("Y-m-d");
//var_dump($podminka);
	    /* stolpci se morajo ujemati z nadpisi stlpcev v "if(count)" linija 105*/
   $stolpci=["datumOpravila","stevilkaZdravnika","SUM(casOpravila)"];
   $sumaSumarum = new databaseS();
   $vybrano=$sumaSumarum->sumaSumarum($tabulka, $stolpci, $podminka );
//echo "<br>";
//echo var_dump($vybrano);
//echo "<br>";
//echo var_dump($vybrano[0]);
//echo "<br>"
//echo 'deloStatistika.php linija 72 '. count($vybrano);
//echo "<br>";
//echo "<br>";
  if(count($vybrano)>0){
  echo "<table id='osebe' style='border: solid 1px black;'>";
/* nadpisi se morajo ujemati s prikazanimi stlpci v vyberFunction*/
  echo "<tr class='glavaTable'><th>datum</th><th>številka zdr.</th><th>minute</th></tr>";
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
        echo '<td onclick="poDatumuFunction('."'vyber'".')">izberi</td></tr>';
    }//od endChildren
}// od class DeloRows
//CCCCCCCCCCCCCCC KONEC CLASS TABLE ROWS CCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCC

//CCCCCCCCCCCCCCCCCCCCCC CLASS podminka   CCCCCCCCCCCCCCCCCCCCCCCCCCCCCC

class Podminka {
 function __construct() {
//echo" deloStatistika.php linija 93 ";
if(isset($_REQUEST['semafor'])){
	$this_semafor=$_REQUEST['semafor'];
	}else{
	$this_semafor="";	
	}
switch ($this_semafor){
case 'semaforZdravnik':	
	 if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['stevilkaZdravnika'])){	
//echo $_GET['semafor'];
	 $this_stevilkaZdravnika = $_GET['stevilkaZdravnika'];
//echo'linija 114';
	 echo'<input type="hidden" id="stevilkaZdravnikaIdId" name="stevilkaZdravnika" value="'.$this_stevilkaZdravnika.'" form="formaPogojiId">';
     echo'<br>Številka zdravnika= '.$this_stevilkaZdravnika.'<br>'; 
	 	 $podminka = [];
       if ($this_stevilkaZdravnika >0) {
       //$podminka = array("stevilkaZdravnika="=>$this_stevilkaZdravnika);
	   $podminka["stevilkaZdravnika="] = $this_stevilkaZdravnika;
	   //$podminka["datumOpravila="]=date("Y-m-d");
//echo 'podminka'. $podminka ["datumOpravila="];  
       } else {
	   $podminka = NULL;
              }
//echo" deloStatistika.php linija 106 ";

	$danes='"'.date("Y-m-d").'"';
	echo"<script>pogojFunction($danes, 'vnos',$this_stevilkaZdravnika)</script>";
new SestevekDela($podminka);
	 }//od if GET
break;
case'semaforDatum':
	 if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['stevilkaZdravnika'])){
		 $podminka = [];
		 $this_stevilkaZdravnika = $_POST['stevilkaZdravnika'];
		 echo'<input type="hidden" id="stevilkaZdravnikaIdId" name="stevilkaZdravnika" value="'.$this_stevilkaZdravnika.'" form="formaPogojiId">';
// echo'<br>Številka zdravnika= '.$this_stevilkaZdravnika.'<br>'; 
	 	 $podminka = [];
         if ($this_stevilkaZdravnika >0) {
	        $podminka["stevilkaZdravnika="] = $this_stevilkaZdravnika;
           }
	     $danes='"'.date("Y-m-d").'"';
	     echo"<script>pogojFunction($danes, 'vnos',$this_stevilkaZdravnika)</script>"; 
		 $podminka["stevilkaZdravnika="] = $this_stevilkaZdravnika;
		 if(isset($_POST['zacDatum'])){
		 $this_zacDatum = $_POST['zacDatum'];
		 $podminka["datumOpravila>="] = $this_zacDatum;
		 }else{$this_zacDatum =NULL;}
		 if(isset($_POST['koncDatum'])){
		 $this_koncDatum = $_POST['koncDatum'];
		 $podminka["datumOpravila<="] = $this_koncDatum;
		  }else{$this_koncDatum =NULL;}
		 if(isset($_POST['sifraOpravila'])&& is_numeric($_POST['sifraOpravila'])){
		 $this_sifraOpravila = $_POST['sifraOpravila'];	
		 $podminka["sifraOpravila="] = $this_sifraOpravila;
		  }else{$this_sifraOpravila =NULL;}
         echo'<input type="hidden" id="stevilkaZdravnikaIdId" name="stevilkaZdravnika" value="'.$this_stevilkaZdravnika.'" form="formaPogojiId">';
         echo'<br>ŠTEVILKA ZDRAVNIKA= '.$this_stevilkaZdravnika.'<br>'; 
//var_dump($podminka); 
         new SestevekDela($podminka);
	    }//od if POST 
break;
case'semaforPregled':
if(isset($_GET['stevilkaZdravnika'])){
echo"<br>";	
echo $_GET['stevilkaZdravnika'];
$this_stevilkaZdravnika=$_GET['stevilkaZdravnika'];
echo"<br>";
echo $_GET['datumOpravila'];
$this_datumOpravila=$_GET['datumOpravila'];
echo"<br>";
echo $_GET['sifraOpravila'];
$this_sifraOpravila=$_GET['sifraOpravila'];
echo"<br>";
}
//echo $stevilkaZdravnika;
new Vyber($this_stevilkaZdravnika,$this_datumOpravila,'deloTbl');
break;

default:
echo'linija167';	 
 	 }//od switch semafor	 
 }//od construct  
}//od class Podminka
//CCCCCCCCCCCCCCCCCCCC KONEC CLASS PODMINKA CCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCC

new Podminka();
echo'<script src="js/manipulaceZdravniki.js?'.time().'"></script>';
require_once 'sabloni/prijavljenJe.php';
require_once '../../skupne/sabloni/zapati.php';
?>