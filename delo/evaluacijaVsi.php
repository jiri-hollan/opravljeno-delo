<?php
//------upam da naredi primeren jason iz limitiTbl
require_once '../skupne/database.php';
Class PoberZapise{
	public $conn;
	public $zaklad;
	public function __construct() {
 $this->conn = new Database();	
 $this->nameTable = 'limitiTbl';
 $stolpci = array('ime','min', 'max');
 $poradi = "";
 $podminka = array();
   $prebrano = $this->conn->vyber($this->nameTable, $stolpci, $podminka, $poradi);
//var_dump($prebrano);
//______________________________________________________________-
$limiti=array();
for ($i = 0; $i < count($prebrano); $i++) {
  $ime= $prebrano[$i]["ime"];
  $min= $prebrano[$i]["min"];
  $max= $prebrano[$i]["max"];
  $limiti[$ime]=array("min"=>$min,"max"=>$max);
//var_dump ($limiti).'<br>';//izpiše limite na zaslon
}//od for 
//echo '<br>var dump celo ime:<br>';
//var_dump($limiti);
  $limitiJson = json_encode($limiti, JSON_UNESCAPED_UNICODE);
  echo '<script>';
  echo 'var limitiJson= ' . json_encode( $limitiJson, JSON_UNESCAPED_UNICODE) . ';';
//echo 'console.log(limitiJson);';
//echo  'var limitiJsonx = JSON.parse(limitiJson);';
  echo '</script>';
	}//od construct	
	}//od class PoberZapise
new PoberZapise();
 
?>
