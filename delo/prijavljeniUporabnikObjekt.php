<?php
session_start();
$uname = !empty($_SESSION["uname"]) ? $_SESSION["uname"] : "";
require_once '../skupne/sabloni/zahlavi.php';
require_once 'sabloni/forma.php';
require_once '../skupne/database.php';


	$podminka = array("uname"=>$uname);
	///vyberUporabnikaFunction($podminka);
echo'<script src="js/delo.js?<?php echo time(); ?>"></script>';	
	  new VyberUporabnika ($podminka);
	class VyberUporabnika {
	public $podminka;

function __construct($podminka="") {
	    $this->podminka=$podminka;
	    $this->tabulka="uporabnikiTbl";
	    $this->stolpci=["stevilkaZdravnika","ime","priimek","bolnisnica"];
	    $this->vyber=new database();
	    $vybrano=$this->vyber->vyber($this->tabulka, $this->stolpci, $this->podminka );
if(count($vybrano)>0){
$identifikace="";

foreach(new TableRows(new RecursiveArrayIterator($vybrano)) as $k=>$v) {
       // echo $v;
$identifikace =$identifikace . $v;
//echo $identifikace;
$GLOBALS['identifikace']=$identifikace;
}//od foreach
//echo $GLOBALS['identifikace'];
}//od if(cout)
	else{
   echo "Za izbrano bolnisnico ni zapisa v bazi";	
}//od else
echo'<script>
identifikace="'.$GLOBALS['identifikace'].'";
identifikaceFunction(identifikace);
</script>';

if ($_SERVER["REQUEST_METHOD"] == "GET") {
  $akce = test_input($_GET["akce"]);

echo"
<script>
izborFunction(".$akce.");
</script>";
}//od if GET	


	}//od construct
	


	}//od class vyber uporabnika
	class TableRows extends RecursiveIteratorIterator {
    function __construct($it) {
        parent::__construct($it, self::LEAVES_ONLY);
    }
    function current() { 
		 return "<b>  "  . parent::current() . " </>";
    }

}// od class TableRows	
require_once '../skupne/sabloni/zapati.php';
?>