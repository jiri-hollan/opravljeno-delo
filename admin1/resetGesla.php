<?php
require_once '../skupne/sabloni/zahlavi.php';
?>
<!--konec zahlavi-->
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
<input type="hidden" id="akceId" name="akce" value="vyber">
<p id="demo"></p>
<button type="submit" name="submit" value="Submit"><h2>izberi uporabnika</h2></button>
Če ni drugače, je geslo za reset: anestiz12345
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

case "uredi":
    $tabulka="uporabnikiTbl";
    $id=test_input($_POST["id"]);
    $uname=test_input($_POST["uname"]);
    $geslo=test_input($_POST["geslo"]);
	$geslo = md5($geslo);
	$podminka = array("id"=>$id, "uname"=>$uname);
    $data= array("geslo"=>$geslo);
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
//echo "<br>";
// var_dump($id);
	 $podminka = array("id"=>$id);
     editFunction($podminka);
    break;

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
    function current():mixed { 
		 return "<td  >"  . parent::current() . "</td>";
    }
    function beginChildren():void {
        echo "<tr>";
    }
    function endChildren():void {
        echo "<td onclick=" . '"izborFunction('. "'uredi'".')"'.'"' . ">uredi</td>
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
//echo "<br>";
  $dolzina=count($vybrano);  
//echo "število izbranih stolpcev= " . $dolzina;
//echo $vybrano[1];
  echo "<br>";
  echo "<form id='gesloForm' method='post'>";
//var_dump($vybrano);
  echo " ".$vybrano['ime']." ";
  echo " ".$vybrano['priimek']." ";
  echo " <input type='hidden' id='id' name='id' value='".$vybrano['id']."' readonly></input>";
  echo " <input id='uname' name='uname' value='".$vybrano['uname']."' readonly></input>";
//echo" začasno geslo: <input id='geslo' name='geslo' value='' ></input>";
  echo" začasno geslo: <input id='geslo' placeholder='Novo geslo' name='geslo' autocomplete='off' pattern='(?=.*\d)(?=.*[a-z]).{8,}' title='Mora vsebovati vsaj številke in male črke skupaj najmanj 8 znakov' required>";
  echo "<input type='hidden' name='akce' value='uredi'></input><br><br><button type='submit'>submit</button><button type='reset'>reset</button> ";
  echo "</form>";
}//od editFunction
echo'<script src="js/resetGesla.js?'.time().'"></script>';
require_once '../skupne/sabloni/zapati.php';
?>