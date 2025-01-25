<?php
session_start();
require_once('databaseS.php');
class Administrace {
	public $conn;
	public $zaklad;
	public $koren;		
	public function __construct($koren) {
	 $this->conn = new DatabaseS();
     $this->zaklad = new stdClass();	 
	  if ($_SERVER['SERVER_NAME']=="localhost"){
		 $this->zaklad->url = 'http://' . $_SERVER['SERVER_NAME'].'/'.$koren.'/frontend/';	 
	  }else {
		 $this->zaklad->url = 'http://' . $_SERVER['SERVER_NAME'].'/frontend/';  
	  }
//echo $this->zaklad->url;
	  $casoviLimit = 600;
	  if (isset($_SESSION["uporabnikPrihlasen"])) {
		  $uplinuliCas = time() - $_SESSION["casova_znamka"];
		  if ($uplinuliCas > $casoviLimit) {
			  session_unset();
			  session_destroy();
			  header('Location: ' . $this->zaklad->url . 'prihlaseni.php?stav=neaktivni');
			  exit();
		  }
	  }
	  $_SESSION["casova_znamka"] = time();
	  $prihlasen = $_SESSION['uporabnikPrihlasen'];
	  if (empty($prihlasen)) {
		  session_unset();
		  session_destroy();
	echo'<script>
	sessionStorage.removeItem("testJSON");	
	sessionStorage.removeItem("bolnikId"); 
	</script>';	  
		  
		  header('Location: ' . $this->zaklad->url . 'prihlaseni.php?stav=odhlasit'); 
		  exit();
	  } else {
		  $this->conn = new DatabaseS();
	  }  
	}//od construct	
}//0d class administrace
?>	