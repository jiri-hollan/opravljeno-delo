<?php
	
require_once '../skupne/database.php';

if(isset($_GET['ucinkovina'])&&isset($_GET['teza'])&&isset($_GET['sprememba'])){
	$ucinkovina=$_GET['ucinkovina'];
	$teza=$_GET['teza']*$_GET['sprememba'];
	$poradi='teza';
	/*	echo 'Teža= '.$teza;
		echo'<br>';S
		echo 'Učinkovina= '.$ucinkovina;	*/	
    //$prem=new Premedikace($ucinkovina, $teza);
	//echo'<br>'. $prem->get_name();
	switch ($ucinkovina) {
	  case 'midazolam':
	   $midazolam = new Midazolam($teza, $poradi);
	   $midazolam->izracunFunction();
		die();
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
} else {
	require_once 'sabloni/formaOtroskaPremedikacija.php';
}
//poskusni class Premedikace:
/*
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
}//od class Premedikace  */

abstract class VyberTezo {
public $tabulka;
public $teza;
public $poradi;
public function __construct( $teza, $poradi) {
	    $this->tabulka="premedikacija1Tbl";
		$this->teza = $teza;
		$this->poradi = $poradi;	
	    $this->podminka["teza<="] = $this->teza;
		$this->vyber = new database();

//$stolpci=["id", "ucinkovina", "teza", "doza", "koncentracija", "navodila"];
//echo"<tr class='glavaTable'><th>id</th><th>ucinkovina</th><th>teza</th><th>doza</th><th>koncentracija</th><th>navodila</th></tr>";
 }//od construct  
}//od class VyberTezo
//CCCCCCCCCCCCC KONEC  CLASS VyberTezo CCCCCCCCCCCCCCCCCCCCCCCCCCC
 class Midazolam extends VyberTezo {
	    public function __construct( $teza, $poradi) {
        parent::__construct( $teza, $poradi);
        $this->podminka+= ["ucinkovina=" => "midazolam"];
		$stolpci=["id", "ucinkovina", "teza", "doza", "koncentracija", "navodila"];
        $this->vybrano=$this->vyber->otroska($this->tabulka,$stolpci, $this->podminka, $this->poradi );
    }//od construct
public function izracunFunction() {
	if(count($this->vybrano)>0){
	 $dozaMg=$this->vybrano[0]["doza"]*$this->teza;
	  $dozaMl= round($dozaMg/$this->vybrano[0]['koncentracija'],1);
	  $premedikacija = "Midazolam $dozaMg mg to je $dozaMl ml";	  
	  $navodila=$this->vybrano[0]["navodila"];
	  $navodila= "$navodila oralno"; 
	  echo json_encode([
			"premedikacija" => $premedikacija,
			"navodila" => $navodila
		]);
	//var_dump( $this->vybrano);
	}else{
		echo json_encode([
		"error" => "za to težo ni navodil"
		]);	 
	}
  } //od izracunFunction
}//od class Midazolam
/*...........................................................................*/

 class Dexmedetomidin extends VyberTezo {
	 	     public function __construct( $teza, $poradi) {
        parent::__construct( $teza, $poradi);
        $this->podminka+= ["ucinkovina=" => "dexmedetomidin"];
		$stolpci=["id", "ucinkovina", "teza", "doza", "koncentracija", "navodila"];
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
	 $dozaMg=$this->vybrano[0]["doza"]*$this->teza;
	  $dozaMl= round($dozaMg/$this->vybrano[0]['koncentracija'],1);
	  if($dozaMl>=0.6){
		 $premedikacija = "Dexmedetomidin $dozaMg mg to je $dozaMl ml razpodelimo v obe nosnici"; 
	  }else{
		 $premedikacija = "Dexmedetomidin $dozaMg mg to je $dozaMl ml";  
	  }
	  //$premedikacija = "Dexmedetomidin $dozaMg mg to je $dozaMl ml";	  
	  $navodila=$this->vybrano[0]["navodila"];
	  $navodila = "$navodila nasalno";
	  echo json_encode([
			"premedikacija" => $premedikacija,
			"navodila" => $navodila
		]);
	//var_dump( $this->vybrano);
	}else{
		echo json_encode([
		"error" => "za to težo ni navodil"
		]);			 
	}
  } //od izracunFunction
}//od class dexmedetomidin
/*............................................................................*/

 class Ketamin extends VyberTezo {
	 	     public function __construct( $teza, $poradi) {
        parent::__construct( $teza, $poradi);
        $this->podminka+= ["ucinkovina=" => "ketamin"];
		$stolpci=["id", "ucinkovina", "teza", "doza", "koncentracija", "navodila"];
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
	if(count($this->vybrano)>0&& $this->vybrano[0]['koncentracija']>0){
	 $dozaMg=$this->vybrano[0]["doza"]*$this->teza;
	  $dozaMl= round($dozaMg/$this->vybrano[0]['koncentracija'],1);
	  $premedikacija = "Ketamin $dozaMg mg to je $dozaMl ml";	  
	  $navodila=$this->vybrano[0]["navodila"];
	  $navodila= "$navodila oralno"; 
	  
	
	  echo json_encode([
			"premedikacija" => $premedikacija,
			"navodila" => $navodila 
		]);
	} else {
		echo json_encode([
		"error" => "za to težo ni navodil"
		]);
	}
  } //od izracunFunction
}//od class Ketamin
?>