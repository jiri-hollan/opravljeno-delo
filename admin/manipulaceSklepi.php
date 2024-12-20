<?php
require_once '../skupne/sabloni/zahlavi.php';
?>
<h2>Prednastavljeni sklepi</h2>
<button onclick="izborFunction('vyber')">izberi</button>
<button onclick="izborFunction('vloz')">vlož</button>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
<input type="hidden" id="akceId" name="akce" value="">
<p id="demo"></p>
<p id="posli"></p>
</form>
<p id="demo3"></p>
<?php 
/* V tom failu so funkcije za spreminjanje tabele databaze*/
require_once '../skupne/database.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $akce = test_input($_POST["akce"]);
  $bolnisnica = test_input($_POST["bolnisnica"]);
 // echo strtoupper($akce) .': ';
  echo strtoupper($bolnisnica) .'<br>';
//echo var_dump($sklepiStatus) .'<br>';
//$akce = naredi($akce);
switch ($akce) {
  case "vyber":
// echo "to je vyber.<br>";
   if ($bolnisnica == "") {
	$podminka = NULL;
} else {
    $podminka = array("bolnisnica"=>$bolnisnica);
}
    vyberFunction($podminka);
    break;
case "vloz":
    $sklep = test_input($_POST["sklep"]);
    $sklepiStatus = test_input($_POST["sklepiStatus"]);  
    $data= array("bolnisnica"=>$bolnisnica, "sklep"=>$sklep, "sklepiStatus"=>$sklepiStatus);
    vlozFunction($data);
    break;
case "uredi":
    $tabulka="sklepiTbl";
    $id=test_input($_POST["id"]);
    $bolnisnica=test_input($_POST["bolnisnica"]);
    $sklep = test_input($_POST["sklep"]);
	$sklepiStatus = test_input($_POST["sklepiStatus"]); 
	$podminka = array("id"=>$id);
    $data= array("bolnisnica"=>$bolnisnica, "sklep"=>$sklep, "sklepiStatus"=>$sklepiStatus);
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
 $tabulka="sklepiTbl";
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
 echo "<tr><th>Id</th><th>bolnišnica</><th>sklep</th><th>sklepiStatus</th></tr>";

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
 $tabulka="sklepiTbl";
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
 $tabulka="sklepiTbl";
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
	$tabulka="sklepiTbl";
	$odstrani = new database();
	$odstranjeno=$odstrani->odstrani($tabulka, $podminka );
	echo 'Odstranjen je bil '.$odstranjeno.' uporabnik';
}//od odstraniFunction
?>
<script src="js/manipulaceSklepi.js?<?php echo time(); ?>">
</script>
<?php
require_once '../skupne/sabloni/zapati.php';
?>