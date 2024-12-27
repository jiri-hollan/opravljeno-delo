<?php
session_start();
require_once '../skupne/database.php';
require_once('../skupne/aktivace.php');
require_once('sabloni/izkaz.php');


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
	  
      $this->stolpci = array("id", "vpis_date", "stevilkaZdrav","opravilo", "opraviloSifra"); 
	  
	
	  
	}	
	
}//od class prihlaseni


?>