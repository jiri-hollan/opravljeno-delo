<?php
session_start();
$uname = !empty($_SESSION["uname"]) ? $_SESSION["uname"] : "";
require_once '../skupne/sabloni/zahlavi.php';
require_once 'sabloni/forma.php';
require_once '../skupne/database.php';


	$podminka = array("uname"=>$uname);
	///vyberUporabnikaFunction($podminka);
echo'<script src="js/delo.js?<?php echo time(); ?>"></script>';	
	  new VyberUporabnika ($podminka);
	  
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
		
if ($_SERVER["REQUEST_METHOD"] == "GET") {
  $akce = test_input($_GET["akce"]);

echo"
<script>
izborFunction(".$akce.");
</script>";
}//od if GET	


require_once '../skupne/sabloni/zapati.php';
?>