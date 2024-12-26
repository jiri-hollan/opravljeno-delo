<?php
session_start();
$uname = !empty($_SESSION["uname"]) ? $_SESSION["uname"] : "";
require_once '../skupne/sabloni/zahlavi.php';
require_once 'sabloni/forma.php';
require_once '../skupne/database.php';


	$podminka = array("uname"=>$uname);
	///vyberUporabnikaFunction($podminka);
echo'<script src="js/delo.js?time=<?php echo time(); ?>"></script>';	

	  
class VyberUporabnika {
public $podminka;
function __construct($podminka="") {
	    $this->podminka=$podminka;
	    $this->tabulka="uporabnikiTbl";
	    $this->stolpci=["stevilkaZdravnika","ime","priimek","bolnisnica"];
	    $this->vyber=new database();
	    $vybrano=$this->vyber->vyber($this->tabulka, $this->stolpci, $this->podminka );
//echo($vybrano[0]["stevilkaZdravnika"]);		
if(count($vybrano)>0){
//echo($vybrano[0]["stevilkaZdravnika"]);	
$stevilkaZdravnika=($vybrano[0]["stevilkaZdravnika"]);
$ime=($vybrano[0]["ime"]);	
$priimek=($vybrano[0]["priimek"]);
$bolnisnica=($vybrano[0]["bolnisnica"]);	
$identifikace=' '.$stevilkaZdravnika.' '.$ime.' '.$priimek.' '.$bolnisnica;
$GLOBALS['stevilkaZdravnika']=$stevilkaZdravnika;
$GLOBALS['identifikace']=$identifikace;
//echo $GLOBALS['identifikace'];
}//od if(cout)
	else{
   echo "Za izbrano bolnisnico ni zapisa v bazi";	
}//od else
echo'<script>
identifikace="'.$GLOBALS['identifikace'].'";
identifikaceFunction(identifikace);
</script>';
	}//od construct
		}//od class vyber uporabnika
class NovZapis extends VyberUporabnika{
public $podminka;
function __construct($podminka="") {		
		    parent::__construct();
echo"
<script>
stevilkaZdravnika='".$GLOBALS['stevilkaZdravnika']."';
izborFunction('vloz',stevilkaZdravnika);
</script>";		
	}//od construct
		}//od class Vloz		
		
if ($_SERVER["REQUEST_METHOD"] == "GET") {
  $akce = test_input($_GET["akce"]);  

switch ($akce) {  
case "novZapis":
 new NovZapis($podminka);
break;

default:
  echo $akce;
 echo "<br>ni izvelo case";	
}
}//od if GET

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $akce = test_input($_POST["akce"]);  	
switch ($akce) {  
case "vloz":
    $stevilkaZdravnika = test_input($_POST["stevilkaZdravnika"]);
    $datum = test_input($_POST["datum"]);
    $sifra = test_input($_POST["sifra"]);
    $opravilo = test_input($_POST["opravilo"]);  
    $casPosega = test_input($_POST["casPosega"]);  	
    $data= array("stevilkaZdravnika"=>$stevilkaZdravnika, "datum"=>$datum, "sifra"=>$sifra, "opravilo"=>$opravilo, "casPosega"=>$casPosega );
    vlozFunction($data);
 //new NovZapis($podminka);
break;

default:
  echo $akce.' post';
 echo "<br>ni izvelo case";	
}
}//od if POST
require_once '../skupne/sabloni/zapati.php';
?>