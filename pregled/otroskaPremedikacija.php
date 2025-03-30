<?php
require_once '../skupne/database.php';
require_once 'sabloni/formaOtroskaPremedikacija.php';
?>
<input id="teza" type="hidden" value="4"></input>
<?php
if(isset($POST_ucinkovina)&&isset($POST_teza)){
    new Premedikace($POST_ucinkovina, $POST_teza);
}//else{echo'Ni določena učinkovina ali teža';}

class Premedikace {
	public $ucinkovina;
	public $teza;	
	function _construct($ucinkovina, $teza){
	$this->ucinkovina = $ucinkovina;
	$this->teza = $teza;
	echo $this->teza;
	}
	
}//od class Premedikace
?>