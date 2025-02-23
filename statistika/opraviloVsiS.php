<?php
//------na temelju pregledId pobere podatke iz zapisa z bolnišnice
Class PoberZapis{
	public $conn;
	public $pristop;
	public function __construct($bolnisnica) {
 $this->conn = new DatabaseS();	
 $this->nameTable = 'opravilaTbl';
 $stolpci = array('sifraOpravila','opravilo');
 $poradi = "";
//bolnisnicapregledId je obsoječa bolnisnica v tabeli pregledovalciKomb
 $podminka = array(""); 
 $prebrano = $this->conn->vyber($this->nameTable, $stolpci, $podminka, $poradi);  
//var_dump($prebrano); 
 $opravilo=[];
 for ($i = 0; $i < count($prebrano); $i++) {
//echo $prebrano[$i]["opravilo"].'<br>';	
 //$opravilo= $prebrano[$i]["sifraOpravila"].':'.$prebrano[$i]["opravilo"];
 $sifra=$prebrano[$i]["sifraOpravila"];
 //echo'šifra= '.$sifra;
 $oprav=$prebrano[$i]["opravilo"];
  $opravilo[$sifra]=$oprav;
//echo '<br> $opravilo: '.var_dump($opravilo).'<br>';//izpiše  opravilo na zaslon
//echo'<br>';

}//od for 
//echo'<br>';
//var_dump($opravilo);
//echo'<br>';
  $opraviloJson = json_encode($opravilo, JSON_UNESCAPED_UNICODE);
// echo $opraviloJson;
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
