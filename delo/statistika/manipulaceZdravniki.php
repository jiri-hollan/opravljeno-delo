<?php
require_once 'sabloni/zahlavi.php';
require_once '../../skupne/database.php';
require_once 'sabloni/forma.php';
$nazaj="../../frontend/menuFile1.php";
/*****************************************************/
	class VyberImaStevilko {
  public $tabulka;
  function __construct( $podminka) {
	    $tabulka="uporabnikiTbl";
   /* stolpci se morajo ujemati z nadpisi stlpcev v "if(count)" linija 105*/
   $stolpci=["id", "bolnisnica", "ime", "priimek", "stevilkaZdravnika"];
   $vyber = new database();
   $vybrano=$vyber->vyberPogoj($tabulka, $stolpci, $podminka );
//echo $vybrano[1];
//echo var_dump($vybrano);
 //  echo "<br>";
   echo count($vybrano);
//$dolzina=count($vybrano);
//echo $vybrano[1];
//echo "<br>";
if(count($vybrano)>0){
	 
  echo "<table id='osebe' style='border: solid 1px black;'>";
  /* nadpisi se morajo ujemati s prikazanimi stlpci v vyberFunction*/
  echo "<tr class='glavaTable'><th>Id</th><th>bolnisnica</th><th>ime</th><th>priimek</th><th>stevilkaZdravnika</th></tr>";
  foreach(new TableRows(new RecursiveArrayIterator($vybrano)) as $k=>$v) {
        echo $v;

}//od foreach
}//od if(cout) 
  }//od construct  
	  
	}//od class VyberImaStevilko
/*******************************************************/
 

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

        echo "<td onclick=" . '"izberiStevilkoZdravnikaFunction('. "'vyber'".')"'.'"' . ">izberi</td>
			</tr>" . "\n";
}//od endChildren
}// od class TableRows


$stevilkaZdravnika=6027;
 
   if ($stevilkaZdravnika == "") {
	$podminka = NULL;
} else {
	    //$podminka = array("stevilkaZdravnika>"=>$stevilkaZdravnika);
		$podminka = array("stevilkaZdravnika>"=>0);
}
new VyberImaStevilko($podminka);

	

echo'
<script src="js/manipulaceZdravniki.js?'.time().'">
</script>';
require_once '../../skupne/sabloni/zapati.php';
?>