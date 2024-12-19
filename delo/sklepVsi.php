<?php
//------na temelju pregledId pobere podatke iz zapisa z bolnišnice
require_once '../skupne/database.php';
Class PoberZapis{
	public $conn;
	public $zaklad;
	public $sklepiStatus;
	public $pristop;
	public function __construct($bolnisnica) {
 $this->sklepiStatus = '1';
 $this->conn = new Database();	
 $this->nameTable = 'sklepiTbl';
 $stolpci = array('*');
 $poradi = "";
//bolnisnicapregledId je obsoječa bolnisnica v tabeli pregledovalciKomb
 $podminka = array(""); 
 $prebrano = $this->conn->vyber($this->nameTable, $stolpci, $podminka, $poradi);     
 $sklep=array();
 for ($i = 0; $i < count($prebrano); $i++) {
//echo $prebrano[$i]["sklep"].'<br>';	
   $sklep1= $prebrano[$i]["sklep"];
//echo $sklep1.'<br>';//izpiše  sklep na zaslon
   array_push($sklep,$sklep1);	
}//od for 
//var_dump($sklep);
  $sklepJson = json_encode($sklep, JSON_UNESCAPED_UNICODE);
  echo '<script>';
  echo 'var sklepJson= ' . json_encode( $sklepJson, JSON_UNESCAPED_UNICODE) . ';';
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
