<?php
session_start();
$uname = !empty($_SESSION["uname"]) ? $_SESSION["uname"] : "";
require_once '../skupne/sabloni/zahlavi.php';
require_once 'sabloni/forma.php';
require_once '../skupne/database.php';

	$podminka = array("uname"=>$uname);
	vyberUporabnikaFunction($podminka);
	
function vyberUporabnikaFunction($podminka){
   $tabulka="uporabnikiTbl";
   $stolpci=["stevilkaZdravnika","ime","priimek","bolnisnica"];
   $vyber = new database();
   $vybrano=$vyber->vyber($tabulka, $stolpci, $podminka );
//echo $vybrano[1];
//echo var_dump($vybrano);,
 //  echo "<br>";
 //  echo count($vybrano);
//$dolzina=count($vybrano);
//echo $vybrano[1];
//echo "<br>";
if(count($vybrano)>0){

  //echo "<table id='osebe' style='border: solid 1px black;'>";

$identifikace="";
class TableRows extends RecursiveIteratorIterator {
    function __construct($it) {
        parent::__construct($it, self::LEAVES_ONLY);
    }
    function current() { 
		 return "<b>  "  . parent::current() . " </>";
    }

}// od class TableRows

foreach(new TableRows(new RecursiveArrayIterator($vybrano)) as $k=>$v) {
       // echo $v;
$identifikace = $identifikace . $v;
$GLOBALS['identifikace']=$identifikace;
}//od foreach
//echo $GLOBALS['identifikace'];
}//od if(cout)
else{
   echo "Za izbrano bolnisnico ni zapisa v bazi";	
}//od else

}//od vyberUporabnikaFunction  

?>
<script src="js/delo.js?<?php echo time(); ?>"></script>

<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
  $akce = test_input($_GET["akce"]);


echo"
<script>
izborFunction(".$akce.");
</script>";
}
require_once '../skupne/sabloni/zapati.php';
?>