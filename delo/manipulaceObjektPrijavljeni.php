 <?php 
 session_start();
$uname = !empty($_SESSION["uname"]) ? $_SESSION["uname"] : "";
 require_once('../skupne/sabloni/zahlavi.php');
/* V tom failu so funkcije za spreminjanje tabele databaze*/
 require_once('../servis/sabloni/formBaze.php');
 require_once ('../skupne/database.php');
 require_once ('identifikace.php');
 echo'<script src="js/delo.js?'.time().'"></script>';
 	$podminka = array("uname"=>$uname);
	   new VyberUporabnika($podminka);
//_____________________________________________________________
if (isset($_REQUEST["akce"])) {
	  $akce = new Test_input($_REQUEST["akce"]);
	  $akce = $akce->get_test();

  
  //______________________________________________________
   if (isset($_REQUEST["datumVpisa"])){
	  $datumOpravila = new Test_input($_REQUEST['datumVpisa']); 
      $datumOpravila = $datumOpravila->get_test();
	  
  }else {
	 $datumOpravila = "";   
  }
  //------------------------------------------------------
 if (isset($tabulka)){
	  $tabulka= $tabulka; 
  }else if (isset($_REQUEST["tabulka"])){
	  $tabulka= new Test_input($_REQUEST["tabulka"]);
	  $tabulka = $tabulka->get_test();
  }else {
	  echo "ni tabulke v post";
  }
  //var_dump($akce);
 // echo strtoupper($akce) .': ';
  echo '<b>dne: </b>'.($datumOpravila) .'<br>';
 //$stevilkaZdravnika=11111;
  new $akce($stevilkaZdravnika, $datumOpravila, $tabulka);

	  
}//od if akce
/*else {
	 echo'akce ni določena'; 
  }*/
//_________________________________
 
 	class Test_input {
	public $test;	
  function __construct($test) {
	//parent::__construct($test);
   $test = trim($test);
  $test = stripslashes($test);
  $this->test = htmlspecialchars($test);
  }//od construct
  function get_test() {
    return $this->test;
  }  
}//od class Test_input
//echo($uname);

//____________________________________________________________________________________________
 

 class DostopPost{
  public $stevilkaZdravnika;
  public $datumOpravila;		 		
  public $tabulka;
  function __construct($stevilkaZdravnika, $datumOpravila="",$tabulka="") {
	    $datumOpravila=strtolower($datumOpravila); 
        $datumOpravila=ucfirst($datumOpravila); 
	    $this->datumOpravila = $datumOpravila;
        $this->tabulka = $tabulka; 

		//echo 'Tabulka= '.$this->tabulka;
		 switch($this->tabulka){
	 
	  
	   case "deloTbl":	   
	  $this->dataPreg= '["stevilkaZdravnika", "opravilo", "sifraOpravila", "datumOpravila",  "casOpravila"]';
	  break;
	  
	  default:
	  echo "tabulka ni določena";
  }
		
  } //od construct
}//od class dostopPost
//____________________________________________________________________________________________
	class Uredi extends DostopPost{
  public $stevilkaZdravnika;		
  public $datumOpravila;	
  public $id;
  public $ime;
  public $priimek;
  //public $status; 
  public function __construct($stevilkaZdravnika, $datumOpravila, $tabulka) {
	parent::__construct($stevilkaZdravnika, $datumOpravila, $tabulka);	
	echo "case uredi <br>";
print_r($_POST);
echo "<br>";
    $id= new test_input($_POST["id"]);
	$this->id = $id->get_test();
	$data=array();
 function array_push_assoc($data, $key, $value){
   $data[$key] = $value;
   return $data;
}
foreach (json_decode($this->dataPreg) as $key) {
 //echo "$key <br>";
    $value= new Test_input($_REQUEST[$key]); 
	$value= $value->get_test();	
    $data =array_push_assoc($data, $key, $value);
//var_dump($data);	
}

    $this->podminka = array("id"=>$this->id);
	    $this->data = $data;
    	$aktualizuj = new database();
		$aktualizovano=$aktualizuj->aktualizuj($this->tabulka,$this->data,$this->podminka);
}
}// od class uredi
//_____________________________________________________________________________________

	class Vyber extends DostopPost{
  public $stolpci;
  public $datumOpravila;
  public $stevilkaZdravnika;  
  public $tabulka;
  public $poradi;
  function __construct($stevilkaZdravnika, $datumOpravila, $tabulka, $stolpci=["*"], $poradi=NULL) {
	parent::__construct($stevilkaZdravnika, $datumOpravila, $tabulka);
    $this->stolpci = $stolpci;	
	//echo "v class vyber";
	
	
	
	if ($this->datumOpravila == "") {
	    $this->podminka = array("stevilkaZdravnika"=>$stevilkaZdravnika);	
   } else {
    $this->podminka = array("stevilkaZdravnika"=>$stevilkaZdravnika, "datumOpravila"=>$this->datumOpravila);
   }//od else
   $this->poradi=$poradi;
   $this->tabulka=$tabulka;
   $this->stolpci= array('id', 'vpis_date', 'opravilo', 'datumOpravila', 'casOpravila');
$vyber = new database();
$vybrano=$vyber->vyber($this->tabulka, $this->stolpci, $this->podminka, $this->poradi );
echo "<br>";
if(count($vybrano)>0){	
	
foreach(new TableRows(new RecursiveArrayIterator($vybrano)) as $k=>$v) {
        echo $v;

}//od foreach
//..............................................
	if ($this->datumOpravila == "") {
	$this->podminka = NULL;
   } else {
    $this->podminka = array("stevilkaZdravnika"=>$stevilkaZdravnika, "datumOpravila"=>$this->datumOpravila);
   }//od else
   $this->stolpec=array("casOpravila");   
   $this->tabulka=$tabulka;
$sestej = new database();
$sesteto=$sestej->suma($this->tabulka, $this->stolpec, $this->podminka);
$sestevek= $sesteto[0]["SUM(casOpravila)"];
//echo "<br>".$sestevek;
echo'<b>';
echo'opravljeni čas: ';
echo intdiv($sestevek, 60).'h';
echo(fmod($sestevek, 60) ).'min';
echo'</b>';
echo'<br><br>';
//..............................................
}//od if(cout)
else{
echo "Za izbrani datum ni zapisa v bazi";	
}//od else
}//od vyberFunction  
}//od class vyber

//________________________________________________________________________________________	
	class Vloz extends DostopPost {

  function __construct($stevilkaZdravnika, $datumOpravila, $tabulka) {
	parent::__construct($stevilkaZdravnika, $datumOpravila, $tabulka);
	echo $tabulka;
	$this->tabulka = $tabulka;
	$data=array();
 function array_push_assoc($data, $key, $value){
   $data[$key] = $value;
   return $data;
}
foreach (json_decode($this->dataPreg) as $key) {
 //echo "$key <br>";
    $value= new Test_input($_REQUEST[$key]); 
	$value= $value->get_test();	
    $data =array_push_assoc($data, $key, $value);
}
     $this->data = $data;
     $vloz = new database();
     $vlozeno=$vloz->vloz($this->tabulka,$this->data);
    //echo $vlozeno[1];
     echo "<br>";
     print_r($vlozeno);
     echo "<br>";
     echo count($vlozeno);
     echo "<br>";	 
  }	    
}// od class Vloz

//-------------------------iterator-----------------------------------------------------
	class TableRows extends RecursiveIteratorIterator {
    function __construct($it) {
		//echo $_REQUEST["tabulka"];
	echo "<table id='osebe' style='border: solid 1px black;'>";
	switch ($_REQUEST["tabulka"]){
		
	
	case "deloTbl":
    /*Glava tabele vseh stolpcev  */
	//echo "<tr><th>Id</th><th>vpis_date</><th>stevilkaZdravnika</th><th>opravilo</th><th>sifraOpravila</th><th>datumOpravila</th><th>casOpravila</th></tr>";
	/* glava za izbrane stolpce */
	//---------------------------------------------------------
	echo "<tr><th>id</><th>vpisano dne</><th>opravilo</th><th>datumOpravila</th><th>casOpravila</th></tr>";
    break;
	default:
	echo "";
	}
        parent::__construct($it, self::LEAVES_ONLY);
    }
    function current() { 
		 return "<td  >"  . parent::current() . "</td>";
    }
    function beginChildren() {
        echo "<tr>";
    }
    function endChildren() {
        echo "<td class='urediCls' onclick=" . '"izborFunction('. "'edit'".')"'.'"' . ">edit</td>
		<td class='odstraniCls' onclick=" . '"izborFunction('. "'odstrani'".')"'.'"' . ">odstrani</td>
		
		</tr>" . "\n";
    }
	
} // od class TableRows

//____________________________________________________________________________________________________

    class Edit {
	public $id;	
	public $tabulka;
	 function __construct($tabulka, $id) {
    $id = new test_input($_GET["id"]);
	$this->id = $id->get_test();
//echo "id uporabnika= " .  $id;
	$tabulka = new test_input($_GET["tabulka"]);
	 $this->tabulka = $tabulka->get_test();	 
	 $podminka = array("id"=>$this->id);	
	 $stolpci=["*"];
	 $vyber = new database();
	 $vybrano=$vyber->vyber($this->tabulka, $stolpci, $podminka );
//echo "število izbranih zapisov= " . count($vybrano);
     $dolzina=count($vybrano);
     echo "<form  method='post'>";

	//------------------------------------------------------------------------

$skrito=array("id"=>"", "vpis_date"=>"", "stevilkaZdravnika"=>"", "sifraOpravila"=>"");
$result=array_diff_key($vybrano[0],$skrito);
$vidno=array("vpis_date"=>"", "opravilo"=>"", "datumOpravila"=>"", "casOpravila"=>"");
$neopazno=array_diff_key($vybrano[0],$vidno);
//___________________________	
	   foreach ($neopazno as $key => $value) {
			   echo "  <input type='hidden' id=$key name=$key value='".$value."'></input>";
      }//od foreach	
	
       foreach ($result as $key => $value) {
		   
// echo "$key: $value\n";
/*--------tu bo koda za izbiro vidnih polj za popravilo vnosa opravila*/

/*

polja deloTbl
"id"=>"", "vpis_date"=>"", "stevilkaZdravnika"=>"", "opravilo"=>"", "sifraOpravila"=>"", "datumOpravila"=>"", "casOpravila"=>"",

-------*/
	   echo " $key:<br> <input id=$key name=$key value='".$value."'></input><br>";
      }//od foreach	 
	 echo "<input type='hidden' name='akce' value='uredi'></input><button class='submit' type='submit'>potrdi</button><button type='reset'>reset</button> ";
     echo "</form>";

	 }//od construct	
	}//od class edit
//________________________________________________________________________________________________

    class odstrani {
	public $id;	
	public $tabulka;
	 function __construct($tabulka, $id) {		 
	 $tabulka = new test_input($_GET["tabulka"]);
	 $this->tabulka = $tabulka->get_test();
     $id = new test_input($_GET["id"]);
	 $this->id = $id->get_test();
	// echo "id uporabnika= " .  $id;
	 echo "<br>";
	 $stolpci=["*"];	 
	 $podminka = array("id"=>$this->id);
	 $odstrani = new database();
    $najdeno=$odstrani->vyber($this->tabulka, $stolpci, $podminka );
	print_r($najdeno);
	$odstranjeno=$odstrani->odstrani($this->tabulka, $podminka );
	echo 'Odstranjen je bil '.$odstranjeno.' uporabnik';
	 }//od construct
	 }//od class odstrani
if (isset($_REQUEST["tabulka"])){

switch($_REQUEST["tabulka"]){


case "deloTbl":
echo '<script src="js/manipulaceDelo.js?'.time().'"></script>'; 
break;

}
}
?>
<!--zapati-->
</body>
</html>	