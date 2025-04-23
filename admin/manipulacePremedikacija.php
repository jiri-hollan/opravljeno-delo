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
    $teza = test_input($_POST["teza"]); 
    $midazolamDoza = test_input($_POST["midazolamDoza"]);
    $midazolamKoncentracija = test_input($_POST["midazolamKoncentracija"]);
    $midazolamNavodila = test_input($_POST["midazolamNavodila"]);
    $dexmedetomidinDoza = test_input($_POST["dexmedetomidinDoza"]);
    $dexmedetomidinKoncentracija = test_input($_POST["dexmedetomidinKoncentracija"]);
    $dexmedetomidinNavodila = test_input($_POST["dexmedetomidinNavodila"]);
    $ketaminDoza = test_input($_POST["ketaminDoza"]);
    $ketaminKoncentracija = test_input($_POST["ketaminKoncentracija"]);
    $ketaminNavodila = test_input($_POST["ketaminNavodila"]);
/*
	"teza", "midazolamDoza", "midazolamKoncentracija", "midazolamNavodila", "dexmedetomidinDoza", "dexmedetomidinKoncentracija", "dexmedetomidinNavodila", "ketaminDoza", "ketaminKoncentracija", "ketaminNavodila"
	
	*/
 
    $data= array("teza"=>$teza, "midazolamDoza"=>$midazolamDoza, "midazolamKoncentracija"=>$midazolamKoncentracija, "midazolamNavodila"=>$midazolamNavodila, "dexmedetomidinDoza"=>$dexmedetomidinDoza, "dexmedetomidinKoncentracija"=>$dexmedetomidinKoncentracija, "dexmedetomidinNavodila"=>$dexmedetomidinNavodila, "ketaminDoza"=>$ketaminDoza, "ketaminKoncentracija"=>$ketaminKoncentracija, "ketaminNavodila"=>$ketaminNavodila);
    vlozFunction($data);
    break;
case "uredi":
    $tabulka="premedikacijaTbl";
    $id=test_input($_POST["id"]);
	$teza = test_input($_POST["teza"]); 	
    $midazolamDoza = test_input($_POST["midazolamDoza"]);
    $midazolamKoncentracija = test_input($_POST["midazolamKoncentracija"]);
    $midazolamNavodila = test_input($_POST["midazolamNavodila"]);
    $dexmedetomidinDoza = test_input($_POST["dexmedetomidinDoza"]);
    $dexmedetomidinKoncentracija = test_input($_POST["dexmedetomidinKoncentracija"]);
    $dexmedetomidinNavodila = test_input($_POST["dexmedetomidinNavodila"]);
    $ketaminDoza = test_input($_POST["ketaminDoza"]);
    $ketaminKoncentracija = test_input($_POST["ketaminKoncentracija"]);
    $ketaminNavodila = test_input($_POST["ketaminNavodila"]);

	$podminka = array("id"=>$id);
     $data= array("teza"=>$teza, "midazolamDoza"=>$midazolamDoza, "midazolamKoncentracija"=>$midazolamKoncentracija, "midazolamNavodila"=>$midazolamNavodila, "dexmedetomidinDoza"=>$dexmedetomidinDoza, "dexmedetomidinKoncentracija"=>$dexmedetomidinKoncentracija, "dexmedetomidinNavodila"=>$dexmedetomidinNavodila, "ketaminDoza"=>$ketaminDoza, "ketaminKoncentracija"=>$ketaminKoncentracija, "ketaminNavodila"=>$ketaminNavodila);
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
 $tabulka="premedikacijaTbl";
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
 
 echo "<tr><th>id</th><th>teza</th><th>midazolamDoza</th><th>midazolamKoncentracija</th><th>midazolamNavodila</th><th>dexmedetomidinDoza</th><th>dexmedetomidinKoncentracija</th><th>dexmedetomidinNavodila</th><th>ketaminDoza</th><th>ketaminKoncentracija</th><th>ketaminNavodila</th></tr>";

 class TableRows extends RecursiveIteratorIterator {
    function __construct($it) {
        parent::__construct($it, self::LEAVES_ONLY);
    }
    function current() { 
		 return "<td  >"  . parent::current() . "</td>";
    }
    function beginChildren() {
        echo "<tr>";
    }
    function endChildren() {
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
 $tabulka="premedikacijaTbl";
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
 $tabulka="premedikacijaTbl";
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
	$tabulka="premedikacijaTbl";
	$odstrani = new database();
	$odstranjeno=$odstrani->odstrani($tabulka, $podminka );
	echo 'Odstranjen je bil '.$odstranjeno.' uporabnik';
}//od odstraniFunction
echo'
<script src="js/manipulacePremedikacija.js?'.time().'">
</script>
';
require_once '../skupne/sabloni/zapati.php';
?>