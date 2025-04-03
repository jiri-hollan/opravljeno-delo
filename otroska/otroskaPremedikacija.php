<?php
require_once '../skupne/database.php';
require_once 'sabloni/formaOtroskaPremedikacija.php';
if(isset($_POST['ucinkovina'])&&isset($_POST['teza'])){
	$ucinkovina=$_POST['ucinkovina'];
	$teza=$_POST['teza'];
	/*	echo 'Teža= '.$teza;
		echo'<br>';
		echo 'Učinkovina= '.$ucinkovina;	*/	
    //$prem=new Premedikace($ucinkovina, $teza);
	//echo'<br>'. $prem->get_name();
	$poradi='teza';
   new VyberTezo($teza, $poradi);
	
}//else{echo'Ni določena učinkovina ali teža';}

class Premedikace {
	public $ucinkovina = '';
	public $teza = '';	
	public Function __construct($ucinkovina, $teza){
	$podminka = [];	
	$this->ucinkovina = $ucinkovina;
	$this->teza = $teza;
	$podminka["teza>="] = $this_teza;
	echo 'Teža= '.$this->teza ;
	echo'<br>';
	echo 'Učinkovina= '.$this->ucinkovina;	
	}
	function get_name() {
    return $this->ucinkovina;
	}
}//od class Premedikace

class VyberTezo {
public $tabulka;
 function __construct( $teza, $poradi) {
	    $tabulka="premedikacijaTbl";
		//$stolpci=["id", "teza", "midazolamDoza", "midazolamKoncentracija", "midazolamNavodila", "dexmedetomidinDoza", "dexmedetomidinKoncentracija", "dexmedetomidinNavodila", "ketaminDoza", "ketaminKoncentracija", "ketaminNavodila"];
		$stolpci=["id", "teza", "midazolamDoza", "midazolamKoncentracija", "midazolamNavodila"];
		$podminka = [];	
		$this->teza = $teza;
	    $podminka["teza<="] = $this->teza;
   /* stolpci se morajo ujemati z nadpisi stlpcev v "if(count)" linija 105*/
   //$stolpci=["id", "teza", "midazolamDoza", "midazolamKoncentracija", "midazolamNavodila", "dexmedetomidinDoza", "dexmedetomidinKoncentracija", "dexmedetomidinNavodila", "ketaminDoza", "ketaminKoncentracija", "ketaminNavodila"];
   //echo"<tr class='glavaTable'><th>id</th><th>teza</th><th>midazolamDoza</th><th>midazolamKoncentracija</th><th>midazolamNavodila</th><th>dexmedetomidinDoza</th><th>dexmedetomidinKoncentracija</th><th>dexmedetomidinNavodila</th><th>ketaminDoza</th><th>ketaminKoncentracija</th><th>ketaminNavodila</th></tr>";
   $vyber = new database();
   $vybrano=$vyber->otroska($tabulka,$stolpci, $podminka, $poradi );
//echo $vybrano[1];
//echo var_dump($vybrano);
 //  echo "<br>";
 //echo count($vybrano);
//$dolzina=count($vybrano);
//echo $vybrano[1];
//echo "<br>";
  if(count($vybrano)>0){
//echo'Število zdravnikov z vpisano zdravniško številko= '. count($vybrano);	  
  echo "<table id='osebe' style='border: solid 1px black;'>";
/* nadpisi se morajo ujemati s prikazanimi stlpci v vyberFunction*/
 echo"<tr class='glavaTable'><th>id</th><th>teza</th><th>midazolamDoza</th><th>midazolamKoncentracija</th><th>midazolamNavodila</th><th>dexmedetomidinDoza</th><th>dexmedetomidinKoncentracija</th><th>dexmedetomidinNavodila</th><th>ketaminDoza</th><th>ketaminKoncentracija</th><th>ketaminNavodila</th></tr>";
    foreach(new TableRows(new RecursiveArrayIterator($vybrano)) as $k=>$v) {
        echo $v;
   }//od foreach
  }//od if(cout) 
  else{
  echo'v bazi ni zdravnikov z vpisano zdravniško številko';  
  }
 }//od construct  
}//od class VyberTezo
//CCCCCCCCCCCCC KONEC  CLASS VYBER IMA STEVIKLO CCCCCCCCCCCCCCCCCCCCCCCCCCC
 
//CCCCCCCCCCCCCCC CLASS TABLE ROWS CCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCC
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
        echo "<td onclick=" . '"izberiStevilkoZdravnikaFunction('. "'vyber'".')"'.'"' . ">izberi</td></tr>" . "\n";
    }//od endChildren
}// od class TableRows
//CCCCCCCCCCCCCCC KONEC CLASS TABLE ROWS CCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCC


?>