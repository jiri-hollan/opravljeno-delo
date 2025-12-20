 <?php
@session_start();
require_once('../skupne/database.php');
require_once('../koren.php');
//require_once('zdravnik.php');
  	  echo '<script>console.log("prihlaseni 6");</script>';
//echo '<script>alert("linija7");</script>';
/*global $r;
$r = $_GET['r'];
var_dump ($r);*/
	  
//require_once('sabloni/prihlasovaci-formular.php');
Class Prihlaseni {
	public $conn;
	public $zaklad;
	public $upstatus;
	public $pristop;
	public $upGdpr;
	public $koren;	
	public function __construct($koren) {
	//echo"('KOREN: '.$koren)";	
	  $this->conn = new Database();
	  $this->zaklad = new stdClass();
	  if ($_SERVER['SERVER_NAME']=="localhost"){
		 $this->zaklad->url = 'http://' . $_SERVER['SERVER_NAME'].'/'.$koren.'/frontend/'; 
	  }else {
		 $this->zaklad->url = 'http://' . $_SERVER['SERVER_NAME'].'/frontend/';  
	  }
	  

	}	
	
}//od class prihlaseni

//___________________________________- potomstvo_______________________________________________


Class Prijava extends Prihlaseni {
	
	
	public function __construct($koren) {
		    parent::__construct($koren);
	 if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		  $chiba = $this->overUdaje();
		  //echo var_dump($chiba);
	  }else if (!empty($_GET['stav'] && $_GET['stav'] == 'neaktivni')){
		  $oznameni = 'Ste odjavljeni zaradi neaktivnosti. ' . 'Ponovno se prijavite.';		  
	  }
	  require_once('sabloni/prihlasovaci-formular.php');
	//od function inicializuj		
	}
	
	public function prihlaseniUspesne($upstatus, $pristop, $upGdpr, $uname){
	   $_SESSION['uporabnikPrihlasen'] = true;
	   $_SESSION["casova_znamka"] = time();
	   $_SESSION["upstatus"] = $upstatus;
	   $_SESSION["pristop"] = $pristop;
	   $_SESSION["uporabnikGdpr"] = $upGdpr;
	   $_SESSION["uname"] = $uname;
	  //echo $upstatus;
	header('Location: bolnik.php');
	   exit();
	}	
	public function prihlaseniSelhalo() {
		//echo 'Napačno uporabniško ime ali geslo. ';
		echo '
		<script>
		alert("Napačno uporabniško ime ali geslo.");
		window.history.back();
		</script> ';
		
	   return ;
	}	
	public function overUdaje() {
		if (!empty($_POST['uname']) && !empty($_POST['geslo'])){
			$geslo = md5($_POST['geslo']);
			$uporabnikiTbl = $this->conn->vyber('uporabnikiTbl', array('upstatus', 'pristop', 'gdpr', 'uname'), array('uname'=>$_POST['uname'], 'geslo'=>$geslo));

		if (count($uporabnikiTbl) == 1)	{
			$upstatus=$uporabnikiTbl[0]['upstatus'];			
			//echo $upstatus;
			$pristop=$uporabnikiTbl[0]['pristop'];			
			//echo $pristop;
			$upGdpr=$uporabnikiTbl[0]['gdpr'];			
			echo $upGdpr;			
			$uname=$uporabnikiTbl[0]['uname'];
			echo $uname;
		// echo $upstatus;
			$this->prihlaseniUspesne($upstatus, $pristop, $upGdpr, $uname);
		} else {
			//echo 'iz funkcije overUdaje';
			return $this->prihlaseniSelhalo();
		}   
	  }
	}
	
	
// od class Prijava	
}
//_____________________________________konec Prijava_______________________________________________




//sssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssss







//$prihlaseni = new Prihlaseni;
if (isset($_GET['r'])) {
	 // echo 'poskus GET' . $_GET['r'];
	  $r = $_GET['r'];
switch ($r) {
  case "login":
 	  echo '<script>console.log("prihlaseni 112");</script>';   
      $prihlaseni = new Prijava($koren);

	 
    //echo "poskušate se logirati!"; 
   break;
 
  default:
  	  echo '<script>console.log("prihlaseni 118");</script>';
}
}else{echo '<script>console.log("prihlaseni 120");</script>';}