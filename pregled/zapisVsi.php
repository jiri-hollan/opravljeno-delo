<?php
//------na temelju pregledId pobere podatke iz zapisa z bolnišnice
require_once '../skupne/database.php';
Class PoberZapis{
	public $conn;
	public $zaklad;
	//public $pregledovalciStatus;
	public $pristop;
	public function __construct($bolnisnica) {
 $this->bolnisnica = $bolnisnica;
 //$this->pregledovalciStatus = '1';
 $this->conn = new Database();	
 $this->nameTable = 'pregledovalciKomb';
 $stolpci = array('ime','priimek');
 $poradi = "priimek";
//bolnisnicapregledId je obsoječa bolnisnica v tabeli pregledovalciKomb
 //$podminka = array("bolnisnica"=>$this->bolnisnica,"pregledovalciStatus"=>$this->pregledovalciStatus); 
 $podminka = array("bolnisnica"=>$this->bolnisnica); 
 $prebrano = $this->conn->vyber($this->nameTable, $stolpci, $podminka, $poradi);     
 $celoIme=array();
for ($i = 0; $i < count($prebrano); $i++) {
//echo $prebrano[$i]["ime"].' '.$prebrano[$i]["priimek"].'<br>';	
   $celoIme1= $prebrano[$i]["ime"].' '.$prebrano[$i]["priimek"];
//echo $celoIme1.'<br>';//izpiše celo ime na zaslon
   array_push($celoIme,$celoIme1);	
}//od for 
//echo '<br>var dump celo ime:<br>';
//var_dump($celoIme);
  $celoImeJson = json_encode($celoIme, JSON_UNESCAPED_UNICODE);
  echo '<script>';
    echo 'var celoImeJson= ' . json_encode( $celoImeJson, JSON_UNESCAPED_UNICODE) . ';';
  echo '</script>';
	}//od construct	
	}//od class PoberZapis
if (isset($_GET['aktivnaBolnisnica'])) {
	$aktivnaBolnisnica = $_GET['aktivnaBolnisnica'];
}else {$aktivnaBolnisnica = '';
}
//var_dump($aktivnaBolnisnica);
new PoberZapis($aktivnaBolnisnica); 
?>
