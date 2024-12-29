<?php
session_start();
$uname = !empty($_SESSION["uname"]) ? $_SESSION["uname"] : "";
require_once '../skupne/sabloni/zahlavi.php';
require_once 'sabloni/forma.php';
require_once '../skupne/database.php';
require_once('opraviloVsi.php');

	$podminka = array("uname"=>$uname);
	///vyberUporabnikaFunction($podminka);
 echo'<script src="js/delo.js?'.time().'"></script>';	
 	class Test_input {
	public $test;	
  function __construct($test) {
	//parent::__construct($test);
   $test = trim($test);
  $test = stripslashes($test);
  $this->test = htmlspecialchars($test);
  }//od construct
  function get_test() {
    return $this->test;
  }  
}//od class Test_input

//____________________________________________________________________________________________
 	  
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
		}//od class NovZapis		
		
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
    $datumOpravila = test_input($_POST["datumOpravila"]);
    $sifraOpravila = test_input($_POST["sifraOpravila"]);
    $opravilo = test_input($_POST["opravilo"]);  
    $casOpravila = test_input($_POST["casOpravila"]);  	
    $data= array("stevilkaZdravnika"=>$stevilkaZdravnika, "datumOpravila"=>$datumOpravila, "sifraOpravila"=>$sifraOpravila, "opravilo"=>$opravilo, "casOpravila"=>$casOpravila );
    //vlozFunction($data);
 new Vloz($data);
break;

default:
  echo $akce.' post';
 echo "<br>ni izvelo case";	
}
}//od if POST

 class DeloPost{
	  public $tabulka;
  function __construct($tabulka="deloTbl") {
      $this->tabulka = $tabulka; 
	  $this->dataDelo= '["stevilkaZdravnika", "datumOpravila", "sifraOpravila", "opravilo", "casOpravila"]';
  
		
  } //od construct
}//od class DeloPost
//________________________________________________________________________________________	
	class Vloz extends DeloPost {

  function __construct($tabulka="deloTbl") {
	parent::__construct($tabulka="deloTbl");
	//echo $tabulka;
	$this->tabulka = $tabulka;
	$data=array();
 function array_push_assoc($data, $key, $value){
   $data[$key] = $value;
   return $data;
}
foreach (json_decode($this->dataDelo) as $key) {
 //echo "$key <br>";
    $value= new Test_input($_REQUEST[$key]); 
	$value= $value->get_test();	
    $data =array_push_assoc($data, $key, $value);
}
     $this->data = $data;
     $vloz = new database();
     $vlozeno=$vloz->vloz($this->tabulka,$this->data);
    //echo $vlozeno[1];
   /*  echo "<br>";
     print_r($vlozeno);
     echo "<br>";
     echo count($vlozeno);
     echo "<br>";	*/
	 echo "Opravilo vpisano v bazo";
  }	    
}// od class Vloz


require_once '../skupne/sabloni/zapati.php';
?>