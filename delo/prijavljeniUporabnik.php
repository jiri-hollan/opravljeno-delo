<?php
session_start();
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
   $stolpci=["bolnisnica","ime","priimek"];
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
	/*	$a = 'onclick="' . "izborFunction('uredi')" . '"';
		$b = 'onclick="' . "izborFunction('odstrani')" . '"';
        echo "<td onclick=" . '"izborFunction('. "'uredi'".')"'.'"' . ">uredi</td>
		<!--<td onclick=" . '"izborFunction('. "'odstrani'".')"'.'"' . ">odstrani</td>-->		
		</tr>" . "\n";*/
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

?>
<script src="js/manipulaceUporabniki.js?<?php echo time(); ?>">
</script>
<?php
require_once '../skupne/sabloni/zapati.php';
?>