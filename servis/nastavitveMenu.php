<?php
require_once('sabloni/vkladane/zahlavi.php');
require_once('../admin/administrace.php');
require_once('../koren.php');
echo 'Menipulacija z bazo';
class Manipulace extends Administrace {
   public function __construct($koren) {
	       parent::__construct($koren);
		   
  if (isset($_SESSION["upstatus"]) && $_SESSION["upstatus"] > 1)  {			   
echo '
<div id="manipulace">
<h1>Menu servis</h1>
<ul id="linky1">

<li><a href="manipulaceObjektUniverzal.php?tabulka=pregledovalciTbl">upravljanje z pregledovalci</a></li>
<li><a href="manipulaceObjektUniverzal.php?tabulka=sklepiTbl">pripravljeni sklepi</a></li>
<li><a href="manipulaceObjektUniverzal.php?tabulka=limitiTbl">nastavitve mejnih vrednosti</a></li>
</ul>
</div>
';
     } else {
	echo	' <h2>za ta del niste pooblaščeni</h2>';
	}
   }//od construct 
}//od class Manipulace  
 $servisManipulace = new Manipulace($koren); 

?>