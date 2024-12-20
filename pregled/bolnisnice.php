<?php
//------seznam bolnišnic
require_once '../skupne/database.php';
Class spisekBolnisnic{
	public $conn;
	public $zaklad;
	public $bolnisnicaStatus; //vključena+baza=2, vljučena=1, nevključena=0
	public function __construct() {
  $this->bolnisnicaStatus = '1';
  $this->conn = new Database();	
  $this->nameTable = 'bolnisniceTbl'; 
  $stolpci = array('mesto','nazivB');
  $poradi = "mesto";
  $podminka = "bolnisnicaStatus";
  $vrednosti = array(1,2);
  $prebrano = $this->conn->vyberIn($this->nameTable, $stolpci, $podminka, $vrednosti, $poradi);
//var_dump ($prebrano);
  $nazivBolnisnice=array();
  $sezamBolnisnic=array();
  $mestoBolnisnice=array();
  for ($i = 0; $i < count($prebrano); $i++) {
//echo $prebrano[$i]["mesto"].'<br>';	

array_push($nazivBolnisnice,$prebrano[$i]["nazivB"] );
array_push($mestoBolnisnice,$prebrano[$i]["mesto"]);
//var_dump($mestoBolnisnice);
    }//od for 
	//echo '<br>var dump mesto Bolnišnice:<br>';
//var_dump($mestoBolnisnice);
//_______________________________________________________________________________
$stolpci = array('nazivB');
$vrednosti = array(2);
$prebrano = $this->conn->vyberIn($this->nameTable, $stolpci, $podminka, $vrednosti, $poradi);
//var_dump($prebrano);
$bazeBolnisnice=array();
 for ($i = 0; $i < count($prebrano); $i++) {
//echo $prebrano[$i]["nazivB"].'<br>';	
array_push($bazeBolnisnice,$prebrano[$i]["nazivB"] );
//var_dump($bazeBolnisnice);
    }//od for 
//var_dump($bazeBolnisnice);
//__________________________________________________________________________
$seznamBolnisnic=array_combine($mestoBolnisnice,$nazivBolnisnice);
//var_dump($seznamBolnisnic);
$mestoBolnisniceJson = json_encode($mestoBolnisnice, JSON_UNESCAPED_UNICODE);
$seznamBolnisnicJson = json_encode($seznamBolnisnic, JSON_UNESCAPED_UNICODE);
$bazeBolnisniceJson = json_encode($bazeBolnisnice, JSON_UNESCAPED_UNICODE);
//var_dump($bazeBolnisniceJson);
echo '<script>';
echo 'var mestoBolnisniceJson= ' . json_encode( $mestoBolnisniceJson, JSON_UNESCAPED_UNICODE) . ';';
echo 'var seznamBolnisnicJson= ' . json_encode( $seznamBolnisnicJson, JSON_UNESCAPED_UNICODE) . ';';
echo 'var bazeBolnisniceJson= ' . json_encode( $bazeBolnisniceJson, JSON_UNESCAPED_UNICODE) . ';';
echo 'const bazeBolnisnice=JSON.parse(bazeBolnisniceJson);';
echo 'localStorage.setItem("bazeBolnisnice",bazeBolnisnice);';
//echo 'alert(seznamBolnisnicJson);';
//echo 'alert(bazeBolnisniceJson);';
echo '</script>';
	}//od construct			
	}//od class spisekBolnisnic
	new spisekBolnisnic();
?>