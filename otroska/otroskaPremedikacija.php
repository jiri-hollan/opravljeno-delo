<?php
require_once '../skupne/database.php';
require_once 'sabloni/formaOtroskaPremedikacija.php';
if(isset($_POST['ucinkovina'])&&isset($_POST['teza'])){
	$ucinkovina=$_POST['ucinkovina'];
	$teza=$_POST['teza'];
	$poradi='teza';
	/*	echo 'Teža= '.$teza;
		echo'<br>';
		echo 'Učinkovina= '.$ucinkovina;	*/	
    //$prem=new Premedikace($ucinkovina, $teza);
	//echo'<br>'. $prem->get_name();
	switch ($ucinkovina) {
  case 'midazolam':
   $midazolam = new Midazolam($teza, $poradi);
   $midazolam->tabulkaFunction();
    break;
  case 'deksmedetomidin':
   new Deksmedetomidin($teza, $poradi);
    break;
  case 'ketamin':
   new Ketamin($teza, $poradi);
    break;
  default:
    echo "ni prepoznalo učinkovine";
}
}//else{echo'Ni določena učinkovina ali teža';}
//poskusni class Premedikace:
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

abstract class VyberTezo {
public $tabulka;
public $teza;
public $poradi;
public function __construct( $teza, $poradi) {
	    $this->tabulka="premedikacijaTbl";
		$this->teza = $teza;
		$this->poradi = $poradi;	
	    $this->podminka["teza<="] = $this->teza;
		$this->vyber = new database();

//$stolpci=["id", "teza", "midazolamDoza", "midazolamKoncentracija", "midazolamNavodila", "dexmedetomidinDoza", "dexmedetomidinKoncentracija", "dexmedetomidinNavodila", "ketaminDoza", "ketaminKoncentracija", "ketaminNavodila"];
//echo"<tr class='glavaTable'><th>id</th><th>teza</th><th>midazolamDoza</th><th>midazolamKoncentracija</th><th>midazolamNavodila</th><th>dexmedetomidinDoza</th><th>dexmedetomidinKoncentracija</th><th>dexmedetomidinNavodila</th><th>ketaminDoza</th><th>ketaminKoncentracija</th><th>ketaminNavodila</th></tr>";

//echo $vybrano[1];
//echo var_dump($vybrano);
//  echo "<br>";
//echo count($vybrano);
//$dolzina=count($vybrano);
//echo $vybrano[1];
//echo "<br>";

 }//od construct  
}//od class VyberTezo
//CCCCCCCCCCCCC KONEC  CLASS VyberTezo CCCCCCCCCCCCCCCCCCCCCCCCCCC
 class Midazolam extends VyberTezo {
	    public function __construct( $teza, $poradi) {
        parent::__construct( $teza, $poradi);

		$stolpci=["id", "teza", "midazolamDoza", "midazolamKoncentracija", "midazolamNavodila"];
        $this->vybrano=$this->vyber->otroska($this->tabulka,$stolpci, $this->podminka, $this->poradi );
//echo $vybrano[1];
//echo var_dump($vybrano);
//  echo "<br>";
//echo count($vybrano);
//$dolzina=count($vybrano);
//echo $vybrano[1];
//echo "<br>";
 
    }//od construct
  public function tabulkaFunction() {
	 if(count($this->vybrano)>0){
//echo'Število izbranih zapisov= '. count($vybrano);	  
  echo "<table id='osebe' style='border: solid 1px black;'>";
/* nadpisi se morajo ujemati s prikazanimi stlpci v vyberFunction*/
 echo"<tr class='glavaTable'><th>id</th><th>teza</th><th>midazolamDoza</th><th>midazolamKoncentracija</th><th>midazolamNavodila</th><th></tr>";
    foreach(new TableRows(new RecursiveArrayIterator($this->vybrano)) as $k=>$v) {
        echo $v;
   }//od foreach
  }//od if(cout) 
  else{
  echo'v bazi ni odgovarajočih zapisov';  
  }  
  }	
	
  public function message() {
    echo "Am I a fruit or a berry? ";
  }
}//od class Midazolam
 class Deksmedetomidin extends VyberTezo {
	 	     public function __construct( $teza, $poradi) {
        parent::__construct( $teza, $poradi);

		$stolpci=["id", "teza", "dexmedetomidinDoza", "dexmedetomidinKoncentracija", "dexmedetomidinNavodila"];
        $vybrano=$this->vyber->otroska($this->tabulka,$stolpci, $this->podminka, $this->poradi );
//echo $vybrano[1];
//echo var_dump($vybrano);
//  echo "<br>";
//echo count($vybrano);
//$dolzina=count($vybrano);
//echo $vybrano[1];
//echo "<br>";
  if(count($vybrano)>0){
//echo'Število izbranih zapisov= '. count($vybrano);	  
  echo "<table id='osebe' style='border: solid 1px black;'>";
/* nadpisi se morajo ujemati s prikazanimi stlpci v vyberFunction*/
 echo"<tr class='glavaTable'><th>id</th><th>teza</th><th>dexmedetomidinDoza</th><th>dexmedetomidinKoncentracija</th><th>dexmedetomidinNavodila</th></tr>";
    foreach(new TableRows(new RecursiveArrayIterator($vybrano)) as $k=>$v) {
        echo $v;
   }//od foreach
  }//od if(cout) 
  else{
  echo'v bazi ni odgovarajučih zapisov';  
  }		
    }
  public function message() {
    echo "Am I a fruit or a berry? ";
  }
}//od class Dexmedetomidin

 class Ketamin extends VyberTezo {
	 	     public function __construct( $teza, $poradi) {
        parent::__construct( $teza, $poradi);

		$stolpci=["id", "teza", "ketaminDoza", "ketaminKoncentracija", "ketaminNavodila"];
        $vybrano=$this->vyber->otroska($this->tabulka,$stolpci, $this->podminka, $this->poradi );
//echo $vybrano[1];
//echo var_dump($vybrano);
//  echo "<br>";
//echo count($vybrano);
//$dolzina=count($vybrano);
//echo $vybrano[1];
//echo "<br>";
  if(count($vybrano)>0){
//echo'Število izbranih zapisov= '. count($vybrano);	  
  echo "<table id='osebe' style='border: solid 1px black;'>";
/* nadpisi se morajo ujemati s prikazanimi stlpci v vyberFunction*/
 echo"<tr class='glavaTable'><th>id</th><th>teza</th><th>ketaminDoza</th><th>ketaminKoncentracija</th><th>ketaminNavodila</th></tr>";
    foreach(new TableRows(new RecursiveArrayIterator($vybrano)) as $k=>$v) {
        echo $v;
   }//od foreach
  }//od if(cout) 
  else{
  echo'v bazi ni odgovarajučih zapisov';  
  }		
    }
  public function message() {
    echo "Am I a fruit or a berry? ";
  }
}//od class Ketamin

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