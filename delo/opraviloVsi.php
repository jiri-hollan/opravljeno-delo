<?php
//------na temelju pregledId pobere podatke iz zapisa z bolnišnice
require_once '../skupne/database.php';
Class PoberZapis{
	public $conn;
	public $zaklad;
	public $pristop;
	public function __construct($bolnisnica) {
 $this->conn = new Database();	
 $this->nameTable = 'opravilaTbl';
 $stolpci = array('sifraOpravila','opravilo');
 $poradi = "";
//bolnisnicapregledId je obsoječa bolnisnica v tabeli pregledovalciKomb
 $podminka = array(""); 
 $prebrano = $this->conn->vyber($this->nameTable, $stolpci, $podminka, $poradi);  
echo '$prebrano: ---';
//var_dump($prebrano);
echo '<br>-----------------------<br>';
 $opravilo=array();
 $opravilo1="";
/* for ($i = 0; $i < count($prebrano); $i++) {
//echo $prebrano[$i]["opravilo"].'<br>';	
 $opravilo1= $prebrano[$i]["sifraOpravila"].':'.$prebrano[$i]["opravilo"];
echo '<br>'.$opravilo1.'<br>';//izpiše  opravilo na zaslon
   array_push($opravilo,$opravilo1);	
}//od for */
foreach ($prebrano as $x => $vrstica) {
	//$x je številka (index) araya vrstice 0=prva vrstica
//echo 'forič: --';
//echo'<br> x= '.$x;
// $vrstica je array v vrstici
//echo'<br>vrstica= ';
//var_dump($vrstica);
//echo'<br>';
foreach ($vrstica as $x => $y) {
//var_dump($x);	
//echo'<br>';
//var_dump($y);	
//echo $x.'=';
//echo $y;
 $opravilo1=$opravilo1.$y;

}

//echo'<br>';
}//od prvega forič
$opravilo=$opravilo1;
 echo $opravilo;


//var_dump($opravilo);
  $opraviloJson = json_encode($opravilo, JSON_UNESCAPED_UNICODE);
 //echo $opraviloJson;
  echo '<script>';
  echo 'var opraviloJson= ' . json_encode( $opraviloJson, JSON_UNESCAPED_UNICODE) . ';';
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
