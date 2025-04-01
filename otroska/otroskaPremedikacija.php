<?php
require_once '../skupne/database.php';
require_once 'sabloni/formaOtroskaPremedikacija.php';
if(isset($_POST['ucinkovina'])&&isset($_POST['teza'])){
	$ucinkovina=$_POST['ucinkovina'];
	$teza=$_POST['teza'];
	/*	echo 'Teža= '.$teza;
		echo'<br>';
		echo 'Učinkovina= '.$ucinkovina;	*/	
    $prem=new Premedikace($ucinkovina, $teza);
	echo'<br>'. $prem->get_name();
}//else{echo'Ni določena učinkovina ali teža';}

class Premedikace {
	public $ucinkovina = '';
	public $teza = '';	
	public Function __construct($ucinkovina, $teza){	
	$this->ucinkovina = $ucinkovina;
	$this->teza = $teza;
	echo 'Teža= '.$this->teza ;
	echo'<br>';
	echo 'Učinkovina= '.$this->ucinkovina;	
	}
	function get_name() {
    return $this->ucinkovina;
	}
}//od class Premedikace
?>