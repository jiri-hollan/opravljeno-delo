<?php
require_once '../skupne/sabloni/zahlavi.php';
?>
<h2>Urejanje limitov</h2>
<button onclick="izborFunction('vyber')">izberi</button>
<button onclick="izborFunction('vloz')">vlož</button>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
<input type="hidden" id="akceId" name="akce" value="">
<p id="demo"></p>
<p id="posli"></p>
</form>
 <br>
<p id="demo3"></p>
<?php
/* V tom failu so funkcije za spreminjanje tabele databaze*/
require_once '../skupne/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $akce = test_input($_POST["akce"]);
  $bolnisnica = test_input($_POST["bolnisnica"]);
  //echo  strtoupper($akce) .': ';
switch ($akce) {
  case "vyber":
	$podminka = NULL;
    vyberFunction($podminka);
    break;
case "vloz":
    $skupina = test_input($_POST["skupina"]);
    $ime = test_input($_POST["ime"]);
    $min = test_input($_POST["min"]);
    $max = test_input($_POST["max"]);  
    $data= array("bolnisnica"=>$bolnisnica, "skupina"=>$skupina, "ime"=>$ime, "min"=>$min, "max"=>$max);
    vlozFunction($data);
    break;
case "uredi":
    $tabulka="limitiTbl";
    $id=test_input($_POST["id"]);
    $skupina=test_input($_POST["skupina"]);	
    $bolnisnica=test_input($_POST["bolnisnica"]);
    $ime = test_input($_POST["ime"]);
	$min = test_input($_POST["min"]);
	$max = test_input($_POST["max"]); 
	$podminka = array("id"=>$id);
    $data= array("bolnisnica"=>$bolnisnica, "skupina"=>$skupina, "ime"=>$ime, "min"=>$min, "max"=>$max);
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
$tabulka="limitiTbl";
$stolpci=["*"];
$vyber = new database();
$vybrano=$vyber->vyber($tabulka, $stolpci, $podminka );
//echo $vybrano[1];
//echo var_dump($vybrano);
//echo "<br>";
echo 'Število zapisov: '.count($vybrano);
//echo $vybrano[1];
echo "<br>";
if(count($vybrano)>0){
echo "<table id='osebe' style='border: solid 1px black;'>";
echo "<tr><th>Id</th><th>bolnisnica</><th>skupina</><th>ime</th><th>min</th><th>max</th></tr>";

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
    }//od funkcije endChildern
}//od class TableRows
foreach(new TableRows(new RecursiveArrayIterator($vybrano)) as $k=>$v) {
        echo $v;
}//od foreach
}//od if(cout)
else{
echo "Za izbrano bolnisnico ni zapisa v bazi";	
}//od else
}//od vyberFunction  

function vlozFunction($data){
$tabulka="limitiTbl";
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
//	echo 'editFunction opšalje podatke v urediFunction';
$tabulka="limitiTbl";
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
	echo " $key:<br> <input id=$key name=$key value='".$value."'></input><br>";
}//od foreach
echo "<input type='hidden' name='akce' value='uredi'></input><br><br><button type='submit'>submit</button><button type='reset'>reset</button> ";
echo "</form>";
}//od for		
}//od editFunction

function odstraniFunction($podminka){
	$tabulka="limitiTbl";
	$odstrani = new database();
	$odstranjeno=$odstrani->odstrani($tabulka, $podminka );
	echo 'Odstranjen je bil '.$odstranjeno.' uporabnik';
}//od odstraniFunction
?>
<script src="js/manipulaceLimiti.js?<?php echo time(); ?>">
</script>
<?php
require_once '../skupne/sabloni/zapati.php';
?>