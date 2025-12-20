 <?php
@session_start();
require_once('../skupne/database.php');
require_once('../koren.php');
global $r;
require_once('sabloni/prihlasovaci-formular.php');
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
Class odjava extends Prihlaseni {
		
	public function __construct($koren) {
		    parent::__construct($koren);
	

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

Class Registrace extends Prihlaseni {
    public $data;
    public $nameTable;
   
	public function __construct($koren) {
		    parent::__construct($koren);
			
			
$registracija=true;
$email=$geslo=$ime=$priimek=$uname=0;
$upstatus = 0;
$pristop = 0;
$upGdpr = 0;
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
  if (!empty($_POST["stevilkaZdravnika"])) {
    $data['stevilkaZdravnika'] = $this->test_input($_POST["stevilkaZdravnika"]);
  } //od if !empty
  
    $data['upstatus'] = $upstatus;
	$data['pristop'] = $pristop;
	$data['gdpr'] = $upGdpr;	
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
			echo 'uspešno ste se registrirali,<br> pravice do dostopa vam bodo dodeljene po posvetu <br>z obveščevalnimi agencijami.<br>';

require_once('../skupne/posta.php');
new Posta($data['ime'], $data['priimek'], $data['email']);
			echo'
			<audio id="myVideo" autoplay>
			<source src="../zvoki/konj.mp3" type="audio/mpeg">			
			ni našlo zvočne datoteke
			</audio>
			';
		}   
	 }
}

// od class Registrace	
}

//____________________________konec Registrace_______________________________

Class Profil extends Prihlaseni {
    public $data;
    public $nameTable;
   
	public function __construct($koren) {
		    parent::__construct($koren);
			
			
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

 public function __construct($koren) {
		    parent::__construct($koren);
			
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
	 }// od if $uporabnikiTbl
  }//od else
	}//od if isset session
	else {
	echo 'Niste prijavljeni, ali je vnos gesla napačen';	
	}//od else
}//od if $ server
else {
	echo "nekaj je narobe";
}//od else	
 }//od construct
}//od class spremembaG
//new SpremembaG;

//_____________________konec clas spremembaG___________________________

//cccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccc


class SpremembaU extends Prihlaseni  {
	public $tabulka;
    public $data;
    public $podminka;

 public function __construct($koren) {
		    parent::__construct($koren);
			
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
	 }//od if $uporabnikiTbl
  }//od else
	}//od if isset session
	else {
	echo 'Niste prijavljeni, ali je vnos gesla napačen';	
	}
}//od if $ server request metod
else {
	echo "nekaj je narobe";
}	
 }//od construct
}//od class SpremembaU
//new SpremembaU;

//_____________________konec clas SpremembaU___________________________



//ssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssss
//cccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccc


class SpremembaZdr extends Prihlaseni  {
	public $tabulka;
    public $data;
    public $podminka;

 public function __construct($koren) {
		    parent::__construct($koren);
			
    $tabulka = 'uporabnikiTbl';
	$stevilkaZdravnika=0;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	//echo 'v server rekvest';
	//var_dump($_POST["sStevilkaZdravnika"]);
	//var_dump($_POST["id"]);
	if (isset($_SESSION["uname"]) && !empty($_POST["sStevilkaZdravnika"])) {
	$podminka['uname'] = $_SESSION["uname"];
	$sStevilkaZdravnika = $_POST["sStevilkaZdravnika"];
    //var_dump($podminka);
	//if ($_POST["stevilkaZdravnika"]!=$_POST["unm-repeat"]) {
    //echo "napačen vnos stevilkaZdravnika";
	//$registracija=false;	
     $stevilkaZdravnika = $_POST["sStevilkaZdravnika"];
	//var_dump($stevilkaZdravnika);
	$data['stevilkaZdravnika'] = $stevilkaZdravnika;
	//var_dump($data);
	new Database;
$uporabnikiTbl = $this->conn->aktualizuj($tabulka,$data,$podminka);
//aktualizuj($tabulka,$data,$podminka);
//echo 'Število aktualiziranih zapisov: ' . $uporabnikiTbl
     if ($uporabnikiTbl == 1) {
		echo 'Vaša številka zdravnika je:<bh>'.strtoupper($stevilkaZdravnika).'</b>';
	 }// od if uporabniki
	}//od if isset session
	else {
	echo 'Niste prijavljeni, ali je vnos gesla napačen';	
	}
}//od if $ server
else {
	echo "nekaj je narobe";
}	
 }//od construct
}//od class SpremembaZdr
//new SpremembaZdr;

//_____________________konec clas SpremembaZdr___________________________



//sssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssss







//$prihlaseni = new Prihlaseni;
if (isset($_GET['r'])) {
	 // echo 'poskus GET' . $_GET['r'];
	  $r = $_GET['r'];
switch ($r) {
  case "login":
    
      $prihlaseni = new Prijava($koren);
    //echo "poskušate se logirati!"; 
   break;
   
 case "singin":
  $prihlaseni = new Registrace($koren);
    //echo "Poskušate se registrirati!";
   break;
   
case "logout":
  $prihlaseni = new Odjava($koren);
    //echo "Poskušate se odjaviti!"; 
   break;  
   
case "profil":
  $prihlaseni = new Profil($koren);
    //echo "V profilu"; 
   break;  
   
case "spremembaG":
  $prihlaseni = new SpremembaG($koren);
    //echo "V profilu"; 
   break;  
   
 case "spremembaU":
  $prihlaseni = new SpremembaU($koren);
    //echo "V profilu"; 
   break;    
   
 case "spremembaZdr":
  $prihlaseni = new SpremembaZdr($koren);
    //echo "V profilu"; 
   break;    
      
  default:
    //echo "Your favorite color is neither red, blue, nor green!";
}
}