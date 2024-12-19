<?php
//------na temelju pregledId pobere podatke iz zapisa s tem id
require_once '../skupne/database.php';
Class PoberZapis{
	public $conn;
	public $zaklad;
	public $upstatus;
	public $pristop;	
	public function __construct($id) {
 $this->id = $id;
 $this->conn = new Database();	
 $this->nameTable = 'bolnikTbl';
 $stolpci = array('*');
//pregledId je obsoječi Id v tabeli bolnikTbl
 $podminka = array("pregledId"=>$this->id);
 $prebrano = $this->conn->vyber($this->nameTable, $stolpci, $podminka);
 echo '<br>Število najdenih zapisov zapis po id: '.count($prebrano);	
//var_dump($podminka);
 json_encode($prebrano);	
 $vrstica = json_encode($prebrano);	
 echo ' Najdeno'.$vrstica.' zapisov';
}//od construct		
}//od class PoberZapis
?>