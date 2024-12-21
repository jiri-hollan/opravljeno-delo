<?php
require_once '../skupne/sabloni/zahlavi.php';
?>
<h2>pregledovalci</h2>
<button onclick="izborFunction('vyber')">izberi</button>
<button onclick="izborFunction('vloz')">vlož</button>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
<input type="hidden" id="akceId" name="akce" value="">
<p id="demo"></p>
<p id="posli"></p>
</form>
<p id="demo3"></p>
<?php 
$uname = !empty($_SESSION["uname"]) ? $_SESSION["uname"] : "";
/* V tom failu so funkcije za spreminjanje tabele databaze*/
require_once '../skupne/database.php';

	 echo $uname;  
	   
	   

	$podminka = array("uname"=>$uname);
	vyberFunction($podminka);
	
	


function vyberFunction($podminka){
  $tabulka="uporabnikiTbl";
  $stolpci=["*"];
  $vyber = new database();
  $vybrano=$vyber->vyber($tabulka, $stolpci, $podminka );
//echo $vybrano[1];
//echo var_dump($vybrano);
 // echo "<br>";
  echo 'Število zapisov: '. count($vybrano);
//$dolzina=count($vybrano);
//echo $vybrano[1];
  echo "<br>";
 if(count($vybrano)>0){
  echo "<table id='osebe' style='border: solid 1px black;'>";
  echo "<tr><th>Id</th><th>bolnišnica</><th>ime</th><th>priimek</th><th>pregledovalciStatus</th></tr>";
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

function vlozFunction($data){
  $tabulka="pregledovalciTbl";
  $vloz = new database($tabulka,$data);
  $vlozeno=$vloz->vloz($tabulka,$data );
//echo $vlozeno[1];
echo "<br>";
echo var_dump($vlozeno);
echo "<br>";
echo 'Vloženo: '.count($vlozeno);
echo "<br>";
}//od vlozFunction

function editFunction($podminka){
//	echo 'editFunction opšalje podatke v urediFunction';
  $tabulka="pregledovalciTbl";
  $stolpci=["*"];
  $vyber = new database($tabulka, $stolpci, $podminka );
  $vyber->vyber($tabulka, $stolpci, $podminka);
  $vybrano=$vyber->vyber($tabulka, $stolpci, $podminka );
//echo $vybrano[1];
//echo var_dump($vybrano);
 // echo "<br>";
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
	$tabulka="pregledovalciTbl";
	$odstrani = new database();
	$odstranjeno=$odstrani->odstrani($tabulka, $podminka );
	echo 'Odstranjen je bil '.$odstranjeno.' uporabnik';
}//od odstraniFunction
?>
<script src="js/manipulacePregledovalci.js?<?php echo time(); ?>">
</script>
<?php
require_once '../skupne/sabloni/zapati.php';
?>