 <?php
session_start();
require_once('../skupne/database.php');
global $r;
	  require_once('sabloni/prihlasovaci-formular.php');
Class Prihlaseni {
	public $conn;
	public $zaklad;
	public $upstatus;
	public $pristop;
	public $gdpr;
	
	public function __construct() {
	  $this->conn = new Database();
	  $this->zaklad = new stdClass();
	  if ($_SERVER['SERVER_NAME']=="localhost"){
		 $this->zaklad->url = 'http://' . $_SERVER['SERVER_NAME'].'/anestiz/frontend/'; 
	  }else {
		 $this->zaklad->url = 'http://' . $_SERVER['SERVER_NAME'].'/frontend/';  
	  }
	  

	}	
	
}//od class prihlaseni

//___________________________________- potomstvo_______________________________________________
Class odjava extends Prihlaseni {
		
	public function __construct() {
		    parent::__construct();
	

	  //echo 'odhlašovani';
	  if (null !== ($_GET['stav'] || $_GET['stav'] == 'odhlasit')) {
	  $this->odhlasi();
     }	
		}//od __construct	
		
		 public function odhlasi() {
			//echo 'Odhlasi';
		echo'<script>
	sessionStorage.removeItem("testJSON");	
	sessionStorage.removeItem("bolnikId"); 
	</script>';	
		 session_unset();
		 session_destroy();
            echo 'Odjavljen';
		  $oznameni = 'Ste odjavljeni, ' . 'ponovno se prijavite.';	
//		header('Location: ' . $this->zaklad->url . 'prihlaseni.php?stav=odhlasit');  

	  require_once('sabloni/prihlasovaci-formular.php');
	
	}//od function odhlasi		
	}//od clas odjava


//____________________________________konec clas odjava_______________________________________
Class Prijava extends Prihlaseni {
	
	
	public function __construct() {
		    parent::__construct();
	 if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		  $chiba = $this->overUdaje();
		  //echo var_dump($chiba);
	  }else if (!empty($_GET['stav'] && $_GET['stav'] == 'neaktivni')){
		  $oznameni = 'Ste odjavljeni zaradi neaktivnosti. ' . 'Ponovno se prijavite.';		  
	  }
	  require_once('sabloni/prihlasovaci-formular.php');
	//od function inicializuj		
	}
	
	public function prihlaseniUspesne($upstatus, $pristop, $gdpr, $uname){
	   $_SESSION['uporabnikPrihlasen'] = true;
	   $_SESSION["casova_znamka"] = time();
	   $_SESSION["upstatus"] = $upstatus;
	   $_SESSION["pristop"] = $pristop;
	   $_SESSION["uporabnikGdpr"] = $gdpr;
	   $_SESSION["uname"] = $uname;
	  //echo $upstatus;
	echo '<script type="text/JavaScript"> 
     location.replace("menuFile1.php"); 
     </script>';
	   exit();
	}	
	public function prihlaseniSelhalo() {
		echo 'Napačno uporabniško ime ali geslo. ';
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
			$gdpr=$uporabnikiTbl[0]['gdpr'];			
			//echo $gdpr;			
			$uname=$uporabnikiTbl[0]['uname'];
			echo $uname;
		// echo $upstatus;
			$this->prihlaseniUspesne($upstatus, $pristop, $gdpr, $uname);
		} else {
			//echo 'iz funkcije overUdaje';
			return $this->prihlaseniSelhalo();
		}   
	  }
	}
	
	
// od class Prijava	
}
//_____________________________________konec Prijava_______________________________________________

Class Registrace extends Prihlaseni {
    public $data;
    public $nameTable;
   
	public function __construct() {
		    parent::__construct();
			
			
$registracija=true;
$email=$geslo=$ime=$priimek=$uname=0;
$upstatus = 0;
$pristop = 0;
$gdpr = 0;
$nameTable = "uporabnikiTbl";

	
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	
		//echo $_POST["bolnisnica"];	
if (empty($_POST["bolnisnica"])) {
    echo"bolnisnica is required";
	$registracija=false;	
  } else {
	$data['bolnisnica'] = $this->test_input($_POST["bolnisnica"]);
   // $bolnisnica = $this->test_input($_POST["bolnisnica"]);
  }	

	//echo $_POST["ime"];	
if (empty($_POST["ime"])) {
    echo"ime is required";
	$registracija=false;	
  } else {
	$data['ime'] = $this->test_input($_POST["ime"]);
   // $ime = $this->test_input($_POST["ime"]);
  }	

if (empty($_POST["priimek"])) {
    echo "priimek is required";
	$registracija=false;
  } else {
    $data['priimek'] = $this->test_input($_POST["priimek"]);  
  }
if (empty($_POST["email"])) {
    echo "Email is required";
	$registracija=false;	
  } else {
    $data['email'] = $this->test_input($_POST["email"]);
  }
  if (empty($_POST["uname"])) {
    echo "Uporabniško ime je obvezno";
	$registracija=false;	
  } else {
    $data['uname'] = $this->test_input($_POST["uname"]);
  }
  
if ($_POST["geslo"]!=$_POST["psw-repeat"]) {
    echo "napačen vnos gesla";
	$registracija=false;	
  } else {
    $geslo = $this->test_input($_POST["geslo"]);
	$data['geslo'] = md5($geslo);
  }
    $data['upstatus'] = $upstatus;
	$data['pristop'] = $pristop;
	$data['gdpr'] = $gdpr;	
  //echo '<br>upstatus: ' .$upstatus;
  //echo'<br>data: '. $data["upstatus"].'<br>';
}


if ($registracija){
	//echo $values.'<br>'; 
	 //echo '<br>'.'V if registracija: '.$nameTable.var_dump($data).'<br>';
  //  $this->registracija($nameTable,$keys,$values);
      $chiba = $this->overUdaje($nameTable, $data);
     // $ulozeno = $this->conn->vloz($nameTable, $data);
	}
// od construct
}

function test_input($test) {
  $test = trim($test);
  $test = stripslashes($test);
  $test = htmlspecialchars($test);
  return $test;
}
public function overUdaje($nameTable, $data) {
	if (!empty($data['uname'])){
		echo $data['ime'] .' '. $data['priimek'].', ';

			$uporabnikiTbl = $this->conn->vyberOr($nameTable, array('id'), array('uname'=>$data['uname'], 'email'=>$data['email'] ));

		if (count($uporabnikiTbl) > 0)	{
			//$this->prihlaseniUspesne();
			echo 'To uporabniško ime ali email je že v upoabi.';
			
		} else {
			//echo 'iz funkcije overUdaje';
			//return $this->prihlaseniSelhalo();
			$ulozeno = $this->conn->vloz($nameTable, $data);
			echo 'uspešno ste se registrirali,<br> pravice do dostopa vam bodo dodeljene po posvetu <br>z obveščevalnimi agencijami.';
require_once('../skupne/posta.php');		
		}   
	  }
}

// od class Registrace	
}

//____________________________konec Registrace_______________________________

Class Profil extends Prihlaseni {
    public $data;
    public $nameTable;
   
	public function __construct() {
		    parent::__construct();
			
			
//$registracija=true;
//$email=$geslo=$ime=$priimek=$uname=0;
//$upstatus = 0;
//$nameTable = "uporabnikiTbl";
//echo 'Uname: '. $_SESSION["uname"];

if (isset($_SESSION["uname"])) {
$data['uname'] = $_SESSION["uname"];
//var_dump ($data);
require_once 'uporabnikWhere2.php';
new UporabnikiWhere($data);
require_once 'sabloni/spremembaGesla.php';
echo '
<script>
    document.getElementById("prij").innerHTML = "Odjava";
	document.getElementById("uname").innerHTML = "prijavljen";
	document.getElementById("uname").innerHTML = "prijavljen: ";

	//alert (<?php echo JSON_encode ($_SESSION["uname"])  ;?>);
     </script>';

} else{
echo 'NISTE PRIJAVLJENI';	
}
//new SpremembaG;
  }// od construct
}// od class profil
//________________________________konec Profil________________________

class SpremembaG extends Prihlaseni  {
	public $tabulka;
    public $data;
    public $podminka;

 public function __construct() {
		    parent::__construct();
			
    $tabulka = 'uporabnikiTbl';
	$geslo=0;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	//echo 'v server rekvest';
	//var_dump($_POST["sGeslo"]);
	//var_dump($_POST["id"]);
	if (isset($_SESSION["uname"]) && !empty($_POST["sGeslo"])) {
	$podminka['uname'] = $_SESSION["uname"];
	$sGeslo = md5($_POST["sGeslo"]);
	$podminka['geslo'] = $sGeslo;
	
	
	if ($_POST["geslo"]!=$_POST["psw-repeat"]) {
    echo "napačen vnos gesla";
	//$registracija=false;	
  } else {
    $geslo = $_POST["geslo"];
	$data['geslo'] = md5($geslo);
	//var_dump($data);
	new Database;
$uporabnikiTbl = $this->conn->aktualizuj($tabulka,$data,$podminka);
//aktualizuj($tabulka,$data,$podminka);
//echo 'Število aktualiziranih zapisov: ' . $uporabnikiTbl
     if ($uporabnikiTbl == 1) {
		echo 'Vaše geslo je bilo spremenjeno'; 
	 }
  }
	
	}//od if isset session
	else {
	echo 'Niste prijavljeni, ali je vnos gesla napačen';	
	}

	
}//od if $ server
else {
	echo "nekaj je narobe";
}	
 }//od construct
}//od class spremembaG
//new SpremembaG;

//_____________________konec clas spremembaG___________________________

//cccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccc


class SpremembaU extends Prihlaseni  {
	public $tabulka;
    public $data;
    public $podminka;

 public function __construct() {
		    parent::__construct();
			
    $tabulka = 'uporabnikiTbl';
	$uname=0;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	//echo 'v server rekvest';
	//var_dump($_POST["sUname"]);
	//var_dump($_POST["id"]);
	if (isset($_SESSION["uname"]) && !empty($_POST["sUname"])) {
	$podminka['uname'] = $_SESSION["uname"];
	$sUname = $_POST["sUname"];
	$podminka['uname'] = $sUname;
	
	
	if ($_POST["uname"]!=$_POST["unm-repeat"]) {
    echo "napačen vnos uname";
	//$registracija=false;	
  } else {
    $uname = $_POST["uname"];
	$data['uname'] = $uname;
	//var_dump($data);
	new Database;
$uporabnikiTbl = $this->conn->aktualizuj($tabulka,$data,$podminka);
//aktualizuj($tabulka,$data,$podminka);
//echo 'Število aktualiziranih zapisov: ' . $uporabnikiTbl
     if ($uporabnikiTbl == 1) {
		echo 'Vaše novo uporabniško ime je:<bh>'.strtoupper($uname).'</b>';
; 
	 }
  }
	
	}//od if isset session
	else {
	echo 'Niste prijavljeni, ali je vnos gesla napačen';	
	}

	
}//od if $ server
else {
	echo "nekaj je narobe";
}	
 }//od construct
}//od class SpremembaU
//new SpremembaU;

//_____________________konec clas SpremembaU___________________________



//ssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssss
//$prihlaseni = new Prihlaseni;
if (isset($_GET['r'])) {
	 // echo 'poskus GET' . $_GET['r'];
	  $r = $_GET['r'];
switch ($r) {
  case "login":
    
      $prihlaseni = new Prijava;
    //echo "poskušate se logirati!"; 
   break;
   
 case "singin":
  $prihlaseni = new Registrace;
    //echo "Poskušate se registrirati!";
   break;
   
case "logout":
  $prihlaseni = new Odjava;
    //echo "Poskušate se odjaviti!"; 
   break;  
   
case "profil":
  $prihlaseni = new Profil;
    //echo "V profilu"; 
   break;  
   
case "spremembaG":
  $prihlaseni = new SpremembaG;
    //echo "V profilu"; 
   break;  
   
 case "spremembaU":
  $prihlaseni = new SpremembaU;
    //echo "V profilu"; 
   break;    
   
  default:
    //echo "Your favorite color is neither red, blue, nor green!";
}
}