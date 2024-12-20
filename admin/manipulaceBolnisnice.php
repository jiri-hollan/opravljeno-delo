<?php
require_once '../skupne/sabloni/zahlavi.php';
?>
<!--konec zahlavi-->
<h2>izberi bolnišnico</h2>
<button onclick="izborFunction('vyber')">izberi</button>
<button onclick="izborFunction('vloz')">vlož</button>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
<input type="hidden" id="akceId" name="akce" value="">
<p id="demo"></p>
<p id="posli"></p>
<!--submit iz js -->
</form>
<p id="demo3"></p>
<?php 
/* V tom failu so funkcije za spreminjanje tabele databaze*/
require_once '../skupne/database.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $akce = test_input($_POST["akce"]);
  $mesto = test_input($_POST["mesto"]);
  echo strtoupper($akce) .': ';
  echo strtoupper($mesto) .'<br>';
//echo var_dump($bolnisnicaStatus) .'<br>';
switch ($akce) {
  case "vyber":
// echo "to je vyber.<br>";
   if ($mesto == "") {
	$podminka = NULL;
} else {
    $podminka = array("mesto"=>$mesto);
}
    vyberFunction($podminka);
    break;
case "vloz":
    $tabulka="bolnisniceTbl";
    $nazivB = test_input($_POST["nazivB"]);
    $bolnisnicaStatus = test_input($_POST["bolnisnicaStatus"]);  
    $data= array("mesto"=>$mesto, "nazivB"=>$nazivB, "bolnisnicaStatus"=>$bolnisnicaStatus);
    vlozFunction($tabulka, $data);
    break;
case "uredi":
    $tabulka="bolnisniceTbl";
    $id=test_input($_POST["id"]);
    $mesto=test_input($_POST["mesto"]);
    $nazivB = test_input($_POST["nazivB"]);
	$bolnisnicaStatus = test_input($_POST["bolnisnicaStatus"]); 
	$podminka = array("id"=>$id);
    $data= array("mesto"=>$mesto, "nazivB"=>$nazivB, "bolnisnicaStatus"=>$bolnisnicaStatus);
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
	 echo "<br>";
// var_dump($id);
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
  $tabulka="bolnisniceTbl";
  $stolpci=["*"];
  $vyber = new database();
  $vybrano=$vyber->vyber($tabulka, $stolpci, $podminka );
//echo $vybrano[1];
//echo var_dump($vybrano);
  echo count($vybrano);
//echo $vybrano[1];
  if(count($vybrano)>0){
   echo "<table id='osebe' style='border: solid 1px black;'>";
   echo "<tr><th>Id</th><th>mesto</><th>nazivB</th><th>bolnisnicaStatus</th></tr>";
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
}// od function endChildren
}// od class TableRows
  foreach(new TableRows(new RecursiveArrayIterator($vybrano)) as $k=>$v) {
        echo $v;
}//od foreach
}//od if(cout)
  else{
  echo "Za izbrano bolnisnico ni zapisa v bazi";	
}//od else
}//od vyberFunction  

function vlozFunction($tabulka,$data){
  $vloz = new database($tabulka,$data);
//$vloz->vloz($tabulka,$data);
  $vlozeno=$vloz->vloz($tabulka,$data );
//echo $vlozeno[1];
  echo "<br>";
  echo var_dump($vlozeno);
  echo "<br>";
  echo count($vlozeno);
  echo "<br>";
}//od vlozFunction

function editFunction($podminka){
//	echo 'editFunction opšalje podatke v urediFunction';
  $tabulka="bolnisniceTbl";
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
// echo "$key: $value\n";
	echo " $key:<input id=$key name=$key value='".$value."'></input>";
}//od foreach
  echo "<input type='hidden' name='akce' value='uredi'></input><br><br><button type='submit'>submit</button><button type='reset'>reset</button> ";
  echo "</form>";
}//od for		
}//od editFunction

function odstraniFunction($podminka){
//echo 'odstraniFunction še ni napisana';
	$tabulka="bolnisniceTbl";
	$odstrani = new database();
	$odstranjeno=$odstrani->odstrani($tabulka, $podminka );
	echo 'Odstranjen je bil '.$odstranjeno.' uporabnik';
}//od odstraniFunction
?>
<script src="js/manipulaceBolnisnice.js?<?php echo time(); ?>">
</script>
<?php
require_once '../skupne/sabloni/zapati.php';
?>