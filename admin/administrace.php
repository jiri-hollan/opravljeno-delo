<?php
session_start();
require_once('../skupne/database.php');
class Administrace {
	public $conn;
	public $zaklad;	
	public $koren;
	public function __construct($koren) {
	//echo"('KOREN: '.$koren)";
	  $this->conn = new Database();
      $this->zaklad = new stdClass();	  
	  if ($_SERVER['SERVER_NAME']=="localhost"){
		 $this->zaklad->url = 'http://' . $_SERVER['SERVER_NAME'].'/'.$koren.'/admin/';	 
	  }else {
		 $this->zaklad->url = 'http://' . $_SERVER['SERVER_NAME'].'/admin/';  
	  }
	  $casoviLimit = 600;
	  if (isset($_SESSION["uporabnikPrihlasen"])) {
		  $uplinuliCas = time() - $_SESSION["casova_znamka"];
		  if ($uplinuliCas > $casoviLimit) {
			  session_unset();
			  session_destroy();
			  header('Location: ' . $this->zaklad->url . '../frontend/prihlaseni.php?stav=neaktivni');
			  exit();
		  }
	  }
	  $_SESSION["casova_znamka"] = time();
	  $prihlasen = $_SESSION['uporabnikPrihlasen'];
	  if (empty($prihlasen)) {
		  session_unset();
		  session_destroy();
		  header('Location: ' . $this->zaklad->url . '../frontend/prihlaseni.php?stav=odhlasit');		   
		  exit();
	  } else {
		  $this->conn = new Database();
	  }	  
}//od construct	
}//0d class administrace
?>