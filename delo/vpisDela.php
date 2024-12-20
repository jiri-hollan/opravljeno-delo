<?php
require_once '../skupne/database.php';
require_once('../skupne/aktivace.php');


Class VpisDela {
	public $conn;
	public $zaklad;
	public $upstatus;
	public $pristop;
	
	public function __construct() {
	  $this->conn = new Database();
	  $this->zaklad = new stdClass();
	  if ($_SERVER['SERVER_NAME']=="localhost"){
		 $this->zaklad->url = 'http://' . $_SERVER['SERVER_NAME'].'/anestiz/frontend/'; 
	  }else {
		 $this->zaklad->url = 'http://' . $_SERVER['SERVER_NAME'].'/frontend/';  
	  } 
	  $this->nameTable = 'deloTbl';
	  
      $this->stolpci = array("datPregleda", "imeZdravnika", "stevMaticna","ustanova", "EMSO", "dan", "mesec", "leto", "datRojstva", "starost", "ime", "priimek", "oddelek", "dgOperativna", "opNacrtovana", "teza", "visina", "bmi", "krvniTlak", "pulz", "spo2", "hb", "ks", "inr", "aptc", "trombociti", "kreatinin", "laktat", "pbnp", "pct", "crp", "na", "k", "drugiIzvidi", "ekg", "rtg", "dgPridruzene", "terPredhodna", "asa", "mallampati", "opiati", "dovisnosti", "alergija", "izvidiInOpombe", "premedVecer", "premedPredOp", "navodila", "sklep"); 
	  
	}	
	
}//od class prihlaseni


?>