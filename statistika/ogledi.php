<?php
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
    	$aktualizuj = new databaseS();
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
   $this->stolpci= array('id', 'vpis_date', 'sifraOpravila', 'opravilo', 'datumOpravila', 'casOpravila');
$vyber = new databaseS();
$vybrano=$vyber->vyber($this->tabulka, $this->stolpci, $this->podminka, $this->poradi );
//echo "<br>";
if(count($vybrano)>0){	
	
foreach(new TableR(new RecursiveArrayIterator($vybrano)) as $k=>$v) {
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
$sestej = new databaseS();
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
}//od construct  
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
     $vloz = new databaseS();
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
	class TableR extends RecursiveIteratorIterator {
    function __construct($it) {
		//echo $_REQUEST["tabulka"];
	echo "<table id='osebe' style='border: solid 1px black;'>";

		
	
	//case "deloTbl":
    /*Glava tabele vseh stolpcev  
	*echo *"<tr><th>Id</th><th>vpis_date</><th>stevilkaZdravnika</th><th>opravilo</th><th>sifraOpravila</th><th>d*atumOpravila</th><th>casOpravila</th></tr>";*/
	
	/* glava za izbrane stolpce ----------------------------------*/
	echo "<tr><th>id</><th>vpisano dne</><th>šifra opravila</th><th>opravilo</th><th>datumOpravila</th><th>casOpravila</th></tr>";

        parent::__construct($it, self::LEAVES_ONLY);
    }
    function current() { 
		 return "<td  >"  . parent::current() . "</td>";
    }
    function beginChildren() {
        echo "<tr>";
    }
    function endChildren() {
        echo "<td class='urediCls' onclick=" . '"izborOgledFunction('. "'edit'".')"'.'"' . ">edit</td>
		<td class='odstraniCls' onclick=" . '"izborOgledFunction('. "'odstrani'".')"'.'"' . ">odstrani</td>
		
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
	 $vyber = new databaseS();
	 $vybrano=$vyber->vyber($this->tabulka, $stolpci, $podminka );
//echo "število izbranih zapisov= " . count($vybrano);
     $dolzina=count($vybrano);
	//------------------------------------------------------------------------	 
  echo "<form  method='post'>";
$skrito=array("id"=>"", "vpis_date"=>"", "stevilkaZdravnika"=>"", "sifraOpravila"=>"");
$result=array_diff_key($vybrano[0],$skrito);
$vidno=array("vpis_date"=>"","opravilo"=>"", "datumOpravila"=>"", "casOpravila"=>"");
$neopazno=array_diff_key($vybrano[0],$vidno);
echo "<b>Številka Zdravnika".$vybrano[0]['stevilkaZdravnika']."</b><br><br>";
//___________________________	
	   foreach ($neopazno as $key => $value) {
			   echo "  <input type='hidden' id=$key name=$key value='".$value."'></input>";
      }//od foreach	
	      foreach ($result as $key => $value) {
		   
// echo "$key: $value\n";
/*--------tu bo koda za izbiro vidnih polj za popravilo vnosa opravila----------*/

/*-------------------------------------------------------------------
*  polja deloTbl
*  "id"=>"", "vpis_date"=>"", "stevilkaZdravnika"=>"", "opravilo"=>"", "sifraOpravila"=>"",     "datumOpravila"=>"", "casOpravila"=>"",
*--------------------------------------------------------------*/
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
	 $odstrani = new databaseS();
    $najdeno=$odstrani->vyber($this->tabulka, $stolpci, $podminka ); 
	print_r($najdeno);
	$odstranjeno=$odstrani->odstrani($this->tabulka, $podminka );
	echo 'Odstranjen je bil '.$odstranjeno.' uporabnik';
	 }//od construct
	 }//od class odstrani
/////////////////////konec class odstrani////////////////////////////////////////////

if (isset($_REQUEST["tabulka"])){  //komentar: se zažene, ko se odpre ta fajl
switch($_REQUEST["tabulka"]){
case "deloTbl":
echo '<script src="../delo/js/ogledDelo.js?'.time().'"></script>'; //komentar: le vlkjuči ogledDelo.js" 
break;
}
}//od if isset request
?>
<!--zapati-->
</body>
</html>	