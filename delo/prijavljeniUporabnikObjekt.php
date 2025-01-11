<?php
session_start();
$uname = !empty($_SESSION["uname"]) ? $_SESSION["uname"] : "";
$nazaj="../frontend/deloMenu.php";
require_once '../skupne/sabloni/zahlavi.php';
require_once 'sabloni/forma.php';
require_once '../skupne/database.php';
require_once('opraviloVsi.php');
require_once('identifikace.php');
echo'<script src="js/delo.js?'.time().'"></script>';
 
//echo('<br>uname= '.$uname);
	$podminka = array("uname"=>$uname);
//echo('<br>na začetku kode $podminka= ');	
//var_dump($podminka);	
	//vyberUporabnikaFunction($podminka);

 //_______________________________________________________________________________________
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

//________________________________________________________________________________________		
class NovZapis extends VyberUporabnika{
public $podminka;
function __construct($podminka) {		
		    parent::__construct($podminka);
//echo"stevilka zdravnika->:".$this->stevilkaZdravnika;
echo"
<script>
stevilkaZdravnika='".$this->stevilkaZdravnika."';
izborFunction('vloz',stevilkaZdravnika);
</script>";		
	}//od construct
		}//od class NovZapis		
//-------------------------------------------------------------------------------------------
class DnevniZapis extends VyberUporabnika{
public $podminka;
function __construct($podminka) {		
		    parent::__construct($podminka);
echo"
<script>
stevilkaZdravnika='".$this->stevilkaZdravnika."';

//izborFunction('vloz',stevilkaZdravnika);
</script>";		
	}//od construct
		}// od class DnevniZapis		
//_______________________________________________________________________________________


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
   //echo $vlozeno['pocetVlozenych'];
  // echo'<br>';
   //var_dump ($vlozeno);
 //echo "<br>";
    // print_r($vlozeno);
	
	if ($vlozeno['pocetVlozenych']==1){
     //echo "<br>";
	 echo 'število vloženih zapisov: '.$vlozeno['pocetVlozenych'];
     echo "<br>";
	 echo "Opravilo vpisano v bazo";
	}else{
		echo'nekaj je narobe!';
	}
  }	    
}// od class Vloz
//____________________________________________________________________
	
	if ($_SERVER["REQUEST_METHOD"] == "GET") {
  $akce = test_input($_GET["akce"]);  

switch ($akce) {  
case "novZapis":
//echo('<br>linija 95 podminka= ');
//var_dump($podminka);
 new NovZapis($podminka);
break;

case "dnevni":
echo "koda še ni zapisana";
 new DnevniZapis($podminka);
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
	
	
	

require_once '../skupne/sabloni/zapati.php';
?>