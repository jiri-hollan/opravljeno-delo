 <?php 
 require_once('sabloni/vkladane/zahlavi.php');
 //require_once '../skupne/sabloni/zahlavi.php';
/* V tom failu so funkcije za spreminjanje tabele databaze*/
 require_once('sabloni/formBaze.php');
 require_once '../skupne/database.php';

//_____________________________________________________________
if (isset($_REQUEST["akce"])) {
	  $akce = new Test_input($_REQUEST["akce"]);
	  $akce = $akce->get_test();
  if (isset($_REQUEST["bolnisnica"])){
	  $bolnisnica = new Test_input($_REQUEST['bolnisnica']); 
      $bolnisnica = $bolnisnica->get_test();
	  
  }else {
	 $bolnisnica = "";   
  }
 if (isset($tabulka)){
	  $tabulka= $tabulka; 
  }else if (isset($_REQUEST["tabulka"])){
	  $tabulka= new Test_input($_REQUEST["tabulka"]);
	  $tabulka = $tabulka->get_test();
  }else {
	  echo "ni tabulke v post";
  }
  //var_dump($akce);
    echo strtoupper($akce) .': ';
  echo strtoupper($bolnisnica) .'<br>';
 
  new $akce($bolnisnica, $tabulka);

	  
}//od if
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

//____________________________________________________________________________________________
 
 ?>
<?php 
 class DostopPost{
  public $bolnisnica;		
  public $tabulka;
  function __construct($bolnisnica="", $tabulka="") {
	    $bolnisnica=strtolower($bolnisnica); 
        $bolnisnica=ucfirst($bolnisnica); 
	    $this->bolnisnica = $bolnisnica;
        $this->tabulka = $tabulka; 
		 switch($this->tabulka){
	  case "pregledovalciTbl":
	  $this->dataPreg= '["bolnisnica", "ime", "priimek", "pregledovalciStatus"]';
	  break;
	  case "sklepiTbl":
	  $this->dataPreg= '["bolnisnica", "sklep", "sklepiStatus"]';
	  break;
	  
	  case "ocenaTbl":
	  $this->dataPreg= '["bolnisnica", "ime", "ocena", "ocenaStatus"]';
	  break;
	  
	  case "limitiTbl":
	  $this->dataPreg= '["bolnisnica", "skupina", "ime", "min", "max"]';
	  break;
	  default:
	  echo "tabulka ni določena";
  }
		
  } //od construct
}//od class dostopPost
//____________________________________________________________________________________________
	class Uredi extends DostopPost{
  public $id;
  public $ime;
  public $priimek;
  //public $status; 
  public function __construct($bolnisnica, $tabulka) {
	parent::__construct($bolnisnica, $tabulka);	
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
}

	
	
    $this->podminka = array("id"=>$this->id);
	//$this->data = array("bolnisnica"=>$this->bolnisnica, "ime"=>$this->ime, "priimek"=>$this->priimek, "status"=>$this->status);
	    $this->data = $data;
    	$aktualizuj = new database();
		$aktualizovano=$aktualizuj->aktualizuj($this->tabulka,$this->data,$this->podminka);
}
}// od class uredi
//_____________________________________________________________________________________

	class Vyber extends DostopPost{
  public $stolpci;
  public $bolnisnica; 
  public $tabulka;
  public $poradi;
  function __construct($bolnisnica, $tabulka, $stolpci=["*"], $poradi=NULL) {
	parent::__construct($bolnisnica, $tabulka);
    $this->stolpci = $stolpci;	
	//echo "v class vyber";
	if ($this->bolnisnica == "") {
	$this->podminka = NULL;
   } else {
    $this->podminka = array("bolnisnica"=>$this->bolnisnica);
   }//od else
   $this->poradi=$poradi;
   $this->tabulka=$tabulka;
$vyber = new database();
$vybrano=$vyber->vyber($this->tabulka, $this->stolpci, $this->podminka, $this->poradi );
echo "<br>";
if(count($vybrano)>0){	
	
foreach(new TableRows(new RecursiveArrayIterator($vybrano)) as $k=>$v) {
        echo $v;

}//od foreach
}//od if(cout)
else{
echo "Za izbrano bolnisnico ni zapisa v bazi";	
}//od else
}//od vyberFunction  
}//od class vyber

//________________________________________________________________________________________	
	class Vloz extends DostopPost {

  function __construct($bolnisnica, $tabulka) {
	parent::__construct($bolnisnica, $tabulka);
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
		  case "pregledovalciTbl":
    echo "<tr><th>Id</th><th>bolnišnica</><th>ime</th><th>priimek</th><th>pregledovalciStatus</th></tr>";
    break;
	case "sklepiTbl":
    echo "<tr><th>Id</th><th>bolnišnica</><th>sklep</th><th>sklepiStatus</th></tr>";
    break;
	
	case "ocenaTbl":
    echo "<tr><th>Id</th><th>bolnišnica</><th>ime</th><th>ocena</th><th>ocenaStatus</th></tr>";
    break;
	
	
	case "limitiTbl":
    echo "<tr><th>Id</th><th>bolnišnica</><th>skupina</th><th>ime</th><th>min</th><th>max</th></tr>";
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
     for ($i = 0; $i < $dolzina; $i++) {
       foreach ($vybrano[$i] as $key => $value) {
// echo "$key: $value\n";
	   echo " $key:<br> <input id=$key name=$key value='".$value."'></input><br>";
      }//od foreach	 
	 echo "<input type='hidden' name='akce' value='uredi'></input><button class='submit' type='submit'>potrdi</button><button type='reset'>reset</button> ";
     echo "</form>";
       }//od for	
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
case "sklepiTbl":
echo '<script src="js/manipulaceSklepi.js?<?php echo time(); ?>"></script>'; 
break;
case "pregledovalciTbl":
echo '<script src="js/manipulacePregledovalci.js?<?php echo time(); ?>"></script>'; 
break;

case "ocenaTbl":
echo '<script src="js/manipulaceOcena.js?<?php echo time(); ?>"></script>'; 
break;

case "limitiTbl":
echo '<script src="js/manipulaceLimiti.js?<?php echo time(); ?>"></script>'; 
break;
}
}
?>
<!--zapati-->
</body>
</html>	