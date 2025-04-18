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
   $midazolam->izracunFunction();
    break;
  case 'dexmedetomidin':
   $dexmedetomidin=new dexmedetomidin($teza, $poradi);
   $dexmedetomidin->izracunFunction();
    break;
  case 'ketamin':
   $ketamin=new ketamin($teza, $poradi);
   $ketamin->izracunFunction();
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
 }//od construct  
}//od class VyberTezo
//CCCCCCCCCCCCC KONEC  CLASS VyberTezo CCCCCCCCCCCCCCCCCCCCCCCCCCC
 class Midazolam extends VyberTezo {
	    public function __construct( $teza, $poradi) {
        parent::__construct( $teza, $poradi);

		$stolpci=["id", "teza", "midazolamDoza", "midazolamKoncentracija", "midazolamNavodila"];
        $this->vybrano=$this->vyber->otroska($this->tabulka,$stolpci, $this->podminka, $this->poradi );
//echo $this->vybrano[1];
//echo var_dump($this->vybrano);
//  echo "<br>";
//echo count($this->vybrano);
//$dolzina=count($this->vybrano);
//var_dump( $this->vybrano[0]);
//echo "<br>";
 
    }//od construct
public function izracunFunction() {
	if(count($this->vybrano)>0){
	 $dozaMg=$this->vybrano[0]["midazolamDoza"]*$this->teza;
	  $dozaMl= round($dozaMg/$this->vybrano[0]['midazolamKoncentracija'],1);
	  $navodila=$this->vybrano[0]["midazolamNavodila"];
	  echo "Midazolam $dozaMg mg to je $dozaMl ml";
	  echo "<br>";
	  echo $navodila;
	//var_dump( $this->vybrano);
	}else{
			 
	}
  } //od izracunFunction
	
  public function tabulkaFunction() {
	 if(count($this->vybrano)>0){
//echo'Število izbranih zapisov= '. count($this->vybrano);	  
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

}//od class Midazolam
 class dexmedetomidin extends VyberTezo {
	 	     public function __construct( $teza, $poradi) {
        parent::__construct( $teza, $poradi);

		$stolpci=["id", "teza", "dexmedetomidinDoza", "dexmedetomidinKoncentracija", "dexmedetomidinNavodila"];
        $this->vybrano=$this->vyber->otroska($this->tabulka,$stolpci, $this->podminka, $this->poradi );
//echo $this->vybrano[1];
//echo var_dump($this->vybrano);
//  echo "<br>";
//echo count($this->vybrano);
//$dolzina=count($this->vybrano);
//echo $this->vybrano[1];
//echo "<br>";
 
    }//od construct
	public function izracunFunction() {
	if(count($this->vybrano)>0){
	 $dozaMg=$this->vybrano[0]["dexmedetomidinDoza"]*$this->teza;
	  $dozaMl= round($dozaMg/$this->vybrano[0]['dexmedetomidinKoncentracija'],1);
	  $navodila=$this->vybrano[0]["dexmedetomidinNavodila"];
	  echo "dexmedetomidin $dozaMg mg to je $dozaMl ml";
	  echo "<br>";
	  echo $navodila;
	//var_dump( $this->vybrano);
	}else{
			 
	}
  } //od izracunFunction
}//od class dexmedetomidin

 class Ketamin extends VyberTezo {
	 	     public function __construct( $teza, $poradi) {
        parent::__construct( $teza, $poradi);

		$stolpci=["id", "teza", "ketaminDoza", "ketaminKoncentracija", "ketaminNavodila"];
        $this->vybrano=$this->vyber->otroska($this->tabulka,$stolpci, $this->podminka, $this->poradi );
//echo $this->vybrano[1];
//echo var_dump($this->vybrano);
//  echo "<br>";
//echo count($this->vybrano);
//$dolzina=count($this->vybrano);
//echo $this->vybrano[1];
//echo "<br>";

    }//od construct
	public function izracunFunction() {
	if(count($this->vybrano)>0&& $this->vybrano[0]['ketaminKoncentracija']>0){
	 $dozaMg=$this->vybrano[0]["ketaminDoza"]*$this->teza;
	  $dozaMl= round($dozaMg/$this->vybrano[0]['ketaminKoncentracija'],1);
	  $navodila=$this->vybrano[0]["ketaminNavodila"];
	  echo "ketamin $dozaMg mg to je $dozaMl ml";
	  echo "<br>";
	  echo $navodila;
	//var_dump( $this->vybrano);
	}else{
	echo "premedikacija z ketaminom še ni določena";		 
	}
  } //od izracunFunction
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