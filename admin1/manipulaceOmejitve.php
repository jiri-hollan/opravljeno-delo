
<?php
require_once '../skupne/sabloni/zahlavi.php';
$nazaj="../admin1/vertikalMenu.php";
?>

<h2>Omejitve</h2>
<button onclick="izborFunction('vyber')">izberi</button>
<button onclick="izborFunction('vloz')">vlož</button>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
 <input type="hidden" id="akceId" name="akce" value="">
 <input type="hidden" id="nazaj" name="nazaj" value="<?php echo $nazaj;?>">
 <p id="demo"></p>
 <p id="posli"></p><!--submit prek JS -->
</form>
 <br>
<p id="demo3"></p>
<?php
 
/* V tom failu so funkcije za spreminjanje tabele databaze*/
require_once '../skupne/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $akce = test_input($_POST["akce"]);
  $razlog = test_input($_POST["razlog"]);

  echo strtoupper($akce) .': ';
  echo strtoupper($razlog) .'<br>';
  
switch ($akce) {
 case "vyber":
   // echo "to je vyber.<br>";
   if ($razlog == "") {
	$podminka = NULL;
} else {
    $podminka = array("razlog"=>$razlog);
}
    vyberFunction($podminka);
  break; 	 
 case "vloz":
    $razlog = test_input($_POST["razlog"]);
    $nivo = test_input($_POST["nivo"]);  
    $data= array("razlog"=>$razlog, "nivo"=>$nivo);
    vlozFunction($data);
    break;
case "uredi":
    $tabulka="omejitveTbl";
    $id=test_input($_POST["id"]);
	$razlog = test_input($_POST["razlog"]);
	$nivo = test_input($_POST["nivo"]);	
	$podminka = array("id"=>$id);
    $data= array("razlog"=>$razlog, "nivo"=>$nivo);	
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
	 echo "id omejitve= " .  $id;
	 echo "<br>";
	// var_dump($id);
	// echo "<br>"; 
	 $podminka = array("id"=>$id);
     editFunction($podminka);
   break;
case "odstrani":
      $id = test_input($_GET["id"]);
	 echo "id omejitve= " .  $id;
	echo "<br>";
    $podminka = array("id"=>$id);
	odstraniFunction($podminka);
    // odstraniFunction();
    break;	
 default:
    echo "ni izvelo get case"; 
  }//od switch	  
}//od if

function vyberFunction($podminka){
   $tabulka="omejitveTbl";
   $stolpci=["*"];
   $vyber = new database();
   $vybrano=$vyber->vyber($tabulka, $stolpci, $podminka );
//echo $vybrano[1];
//echo var_dump($vybrano);
   echo "<br>";
   echo count($vybrano);
//$dolzina=count($vybrano);
//echo $vybrano[1];
echo "<br>";
if(count($vybrano)>0){
  echo "<table id='osebe' style='border: solid 1px black;'>";
  echo "<tr><th>Id</th><th>razlog</th><th>nivo</th></tr>";

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
		<!--<td onclick=" . '"izborFunction('. "'odstrani'".')"'.'"' . ">odstrani</td>-->		
		</tr>" . "\n";
}//od endChildren
}// od class TableRows

foreach(new TableRows(new RecursiveArrayIterator($vybrano)) as $k=>$v) {
        echo $v;

}//od foreach
}//od if(cout)
else{
   echo "Za izbrano bolnisnico ni zapisa v bazi";	
}//od else
}//od vyberFunction  

function vlozFunction($data){
   $tabulka="omejitveTbl";
   $vloz = new database($tabulka,$data);
   $vlozeno=$vloz->vloz($tabulka,$data );
//echo $vlozeno[1];
   echo "<br>";
   echo var_dump($vlozeno);
   echo "<br>";
   echo count($vlozeno);
   echo "<br>";
}//od vlozFunction

function editFunction($podminka){
//	echo 'editFunction pošalje podatke v urediFunction';
   $tabulka="omejitveTbl";
   $stolpci=["*"];
   $vyber = new database($tabulka, $stolpci, $podminka );
   $vyber->vyber($tabulka, $stolpci, $podminka);
   $vybrano=$vyber->vyber($tabulka, $stolpci, $podminka );
//echo $vybrano[1];
//echo var_dump($vybrano);
   echo "<br>";
   echo "število izbranih zapisov= " . count($vybrano);
   $dolzina=count($vybrano);
//echo $vybrano[1];
   echo "<br>";
   echo "<form  method='post'>";
   for ($i = 0; $i < $dolzina; $i++) {
     foreach ($vybrano[$i] as $key => $value) {
      if($key=="id"||$key=="razlog"){
	   echo " $key: <input name=$key value=$value readonly\n></input>";	
}	 
     if($key=="nivo"){	
	  echo " $key: <input name=$key value=$value \n></input>";
}	
}//od foreach
   echo "<input type='hidden' name='akce' value='uredi'></input><br><br><button type='submit'>submit</button><button type='reset'>reset</button> ";
   echo "</form>";
}//od for		
}//od editFunction

function odstraniFunction($podminka){
//odstrani zapis
	$tabulka="omejitveTbl";
	$odstrani = new database();
	$odstranjeno=$odstrani->odstrani($tabulka, $podminka );
	echo 'Odstranjena je bila '.$odstranjeno.' omejitev';
}//od odstraniFunction
?>
<script src="js/manipulaceOmejitve.js?<?php echo time(); ?>">
</script>
<?php
require_once '../skupne/sabloni/zapati.php';
?>