<?php
require_once '../skupne/sabloni/zahlavi.php';
?>
<!--konec zahlavi-->
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
<input type="hidden" id="akceId" name="akce" value="vyber">
<p id="demo"></p>
<button type="submit" name="submit" value="Submit"><h2>izberi uporabnika</h2></button>
<!--submit iz js -->
</form>
<p id="demo3"></p>
<?php 
/* V tom failu so funkcije za spreminjanje tabele databaze*/
require_once '../skupne/database.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $akce = test_input($_POST["akce"]);
  echo strtoupper($akce) .': ';
switch ($akce) {
  case "vyber":
// echo "to je vyber.<br>";
  $podminka = NULL;
  vyberFunction($podminka);
  break;
/*case "vloz":
    $tabulka="uporabnikiTbl";
    $nazivB = test_input($_POST["nazivB"]);
    $bolnisnicaStatus = test_input($_POST["bolnisnicaStatus"]);  
    $data= array("mesto"=>$mesto, "nazivB"=>$nazivB, "bolnisnicaStatus"=>$bolnisnicaStatus);
    vlozFunction($tabulka, $data);
    break;*/
case "uredi":
    $tabulka="uporabnikiTbl";
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
/* case "odstrani":
    $id = test_input($_GET["id"]);
	echo "id v bazi= " .  $id;
	echo "<br>";
    $podminka = array("id"=>$id);
	odstraniFunction($podminka);
    break;	*/
  default:
    echo "ni izvelo get case"; 
}//od switch	  
}//od if

function vyberFunction($podminka){
  $tabulka="uporabnikiTbl";
  $stolpci=["id", "ime", "priimek"];
  $vyber = new database();
  $vybrano=$vyber->vyber($tabulka, $stolpci, $podminka );
//echo $vybrano[1];
//echo var_dump($vybrano);
  echo count($vybrano);
//echo $vybrano[1];
  if(count($vybrano)>0){
   echo "<table id='osebe' style='border: solid 1px black;'>";
   echo "<tr><th>Id</th><th>ime</><th>priimek</th></tr>";
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
        echo "<td onclick=" . '"izborFunction('. "'uredi'".')"'.'"' . ">uredi</td>
		<!--<td onclick=" . '"izborFunction('. "'odstrani'".')"'.'"' . ">odstrani</td>-->	
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

/*function vlozFunction($tabulka,$data){
  $vloz = new database($tabulka,$data);
//$vloz->vloz($tabulka,$data);
  $vlozeno=$vloz->vloz($tabulka,$data );
//echo $vlozeno[1];
  echo "<br>";
  echo var_dump($vlozeno);
  echo "<br>";
  echo count($vlozeno);
  echo "<br>";
}//od vlozFunction*/

function editFunction($podminka){
//	echo 'editFunction opšalje podatke v urediFunction';
  $tabulka="uporabnikiTbl";
  $stolpci=["id", "uname", "ime", "priimek"];
  $vyber = new database($tabulka, $stolpci, $podminka );
  $vyber->vyber($tabulka, $stolpci, $podminka);
  $vybrano=$vyber->vyber($tabulka, $stolpci, $podminka );
//echo $vybrano[0];
//echo var_dump($vybrano);
  $vybrano = $vybrano[0];
  echo "<br>";
  $dolzina=count($vybrano);  
  echo "število izbranih stolpcev= " . $dolzina;

//echo $vybrano[1];
  echo "<br>";
  echo "<form id='gesloForm' method='post'>";
 /* 
  for ($i = 0; $i < $dolzina; $i++) {
   foreach ($vybrano[$i] as $key => $value) {
// echo "$key: $value\n";
//echo " $key:<input id=$key name=$key value='".$value."'></input>";
	echo " <input id=$key name=$key value='".$value."'></input>";
}//od foreach
}//od for  */
//var_dump($vybrano);
	echo " <input id='id' name='id' value='".$vybrano['id']."' readonly></input>";
	echo " <input id='uname' name='uname' value='".$vybrano['uname']."' readonly></input>";
	echo " ".$vybrano['ime']." ";
	echo " ".$vybrano['priimek']." ";
  echo "<input type='hidden' name='akce' value='uredi'></input><br><br><button type='submit'>submit</button><button type='reset'>reset</button> ";
  echo "</form>";
	
}//od editFunction

/*function odstraniFunction($podminka){
//echo 'odstraniFunction še ni napisana';
	$tabulka="uporabnikiTbl";
	$odstrani = new database();
	$odstranjeno=$odstrani->odstrani($tabulka, $podminka );
	echo 'Odstranjen je bil '.$odstranjeno.' uporabnik';
}//od odstraniFunction*/

echo'
<script src="js/resetGesla.js?'.time().'">
</script>
';
require_once '../skupne/sabloni/zapati.php';
?>