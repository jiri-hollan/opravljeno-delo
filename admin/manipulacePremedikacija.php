<?php
require_once '../skupne/sabloni/zahlavi.php';
?>
<h2>Otroška premedikacija</h2>
<?php 
require_once 'sabloni/izbira.php';
/* V tom failu so funkcije za spreminjanje tabele databaze*/
require_once '../skupne/database.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $akce = test_input($_POST["akce"]);
  //$bolnisnica = test_input($_POST["bolnisnica"]);
 // echo strtoupper($akce) .': ';
 // echo strtoupper($bolnisnica) .'<br>';
//echo var_dump($teza) .'<br>';
//$akce = naredi($akce);
switch ($akce) {
  case "vyber":
// echo "to je vyber.<br>";
/* if ($bolnisnica == "") {
	$podminka = NULL;
} else {
    //$podminka = array("bolnisnica"=>$bolnisnica);
}*/
    vyberFunction($podminka=NULL);
    break;
case "vloz":
    $ucinkovina = test_input($_POST["ucinkovina"]); 
    $teza = test_input($_POST["teza"]); 
    $doza = test_input($_POST["doza"]);
    $koncentracija = test_input($_POST["koncentracija"]);
    $navodila = test_input($_POST["navodila"]);
    
/*
	"ucinkovina", "teza", "doza", "koncentracija", "navodila"
	*/
 
    $data= array("ucinkovina"=>$ucinkovina, "teza"=>$teza, "doza"=>$doza, "koncentracija"=>$koncentracija, "navodila"=>$navodila);
    vlozFunction($data);
    break;
case "uredi":
    $tabulka="premedikacija1Tbl";
    $id=test_input($_POST["id"]);
	$ucinkovina = test_input($_POST["ucinkovina"]); 	
	$teza = test_input($_POST["teza"]); 	
    $doza = test_input($_POST["doza"]);
    $koncentracija = test_input($_POST["koncentracija"]);
    $navodila = test_input($_POST["navodila"]);

	$podminka = array("id"=>$id);
     $data= array("ucinkovina"=>$ucinkovina, "teza"=>$teza, "doza"=>$doza, "koncentracija"=>$koncentracija, "navodila"=>$navodila);
	$aktualizuj = new database($tabulka,$data,$podminka);
	$aktualizovano=$aktualizuj->aktualizuj($tabulka,$data,$podminka);
    break;
  default:
    echo "ni izvelo case";	
}//od switch
}//od if

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["akce"])) {
  $akce = test_input($_GET["akce"]);
  switch ($akce) {
	   case "uredi":
     $id = test_input($_GET["id"]);
	 echo "id v bazi= " .  $id;
// var_dump($id);
// echo "<br>"; 
	 $podminka = array("id"=>$id);
     editFunction($podminka);
    break;
 case "odstrani":
    $id = test_input($_GET["id"]);
    echo "id v bazi= " .  $id;
	echo "<br>";
    $podminka = array("id"=>$id);
	odstraniFunction($podminka);
    break;	
  default:
    echo "ni izvelo get case"; 
  }//od switch	  
}//od if

function vyberFunction($podminka){
 $tabulka="premedikacija1Tbl";
 $stolpci=["*"];
 $vyber = new database();
 $vybrano=$vyber->vyber($tabulka, $stolpci, $podminka );
//echo $vybrano[1];
//echo var_dump($vybrano);
 echo 'Število zapisov: '. count($vybrano);
//$dolzina=count($vybrano);
//echo $vybrano[1];
if(count($vybrano)>0){
 echo "<table id='osebe' style='border: solid 1px black;'>";
 
 echo "<tr><th>id</th><th>ucinkovina</th><th>teza</th><th>doza</th><th>koncentracija</th><th>navodila</th></tr>";

 class TableRows extends RecursiveIteratorIterator {
    function __construct($it) {
        parent::__construct($it, self::LEAVES_ONLY);
    }
    function current():mixed { 
		 return "<td  >"  . parent::current() . "</td>";
    }
    function beginChildren():void {
        echo "<tr>";
    }
    function endChildren():void {
		$a = 'onclick="' . "izborFunction('uredi')" . '"';
		$b = 'onclick="' . "izborFunction('odstrani')" . '"';
        echo "<td onclick=" . '"izborFunction('. "'uredi'".')"'.'"' . ">uredi</td>
		<td onclick=" . '"izborFunction('. "'odstrani'".')"'.'"' . ">odstrani</td>		
		</tr>" . "\n";
    }
}// od class tableRows
  foreach(new TableRows(new RecursiveArrayIterator($vybrano)) as $k=>$v) {
        echo $v;
}//od foreach
}//od if(cout)
  else{
  echo "Za izbrano bolnisnico ni zapisa v bazi";	
}//od else
}//od vyberFunction  

function vlozFunction($data){
 $tabulka="premedikacija1Tbl";
 $vloz = new database($tabulka,$data);
 $vlozeno=$vloz->vloz($tabulka,$data );
//echo $vlozeno[1];
 echo "<br>";
 echo var_dump($vlozeno);
 echo "<br>";
 echo 'Število zapisov: '. count($vlozeno);
 echo "<br>";
}//od vlozFunction

function editFunction($podminka){
//	echo 'editFunction opšalje podatke v urediFunction';
 $tabulka="premedikacija1Tbl";
 $stolpci=["*"];
 $vyber = new database($tabulka, $stolpci, $podminka );
 $vyber->vyber($tabulka, $stolpci, $podminka);
 $vybrano=$vyber->vyber($tabulka, $stolpci, $podminka );
//echo $vybrano[1];
//echo var_dump($vybrano);
 echo "število izbranih zapisov= " . count($vybrano);
 $dolzina=count($vybrano);
//echo $vybrano[1];
 echo "<form  method='post'>";
 for ($i = 0; $i < $dolzina; $i++) {
  foreach ($vybrano[$i] as $key => $value) {
// echo "$key: $value\n";
	echo " $key:<br> <input id=$key name=$key value='".$value."'></input><br>";
}//od foreach
  echo "<input type='hidden' name='akce' value='uredi'></input><button type='submit'>submit</button><button type='reset'>reset</button> ";
  echo "</form>";
}//od for		
}//od editFunction

function odstraniFunction($podminka){
	//echo 'odstraniFunction še ni napisana';
	$tabulka="premedikacija1Tbl";
	$odstrani = new database();
	$odstranjeno=$odstrani->odstrani($tabulka, $podminka );
	echo 'Odstranjen je bil '.$odstranjeno.' uporabnik';
}//od odstraniFunction
echo'
<script src="js/manipulacepremedikacija.js?'.time().'">
</script>
';
require_once '../skupne/sabloni/zapati.php';
?>