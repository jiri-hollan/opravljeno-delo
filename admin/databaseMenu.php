<?php
require_once('../frontend/sabloni/vkladane/zahlavi.php');
echo 'Menipulacija z bazo';
require_once('administrace.php');

class Manipulace extends Administrace {
   public function __construct() {
	       parent::__construct();		   
  if (isset($_SESSION["upstatus"]) && $_SESSION["upstatus"] == 3)  {
$nazaj="../admin/databaseMenu.php";
echo '
<div id="manipulace">
<h1>ogled</h1>
<form method="post" action="../skupne/ogledTabele.php">
<input type="hidden"  name="nazaj" value="'.$nazaj.'">
<input type="submit"  name="imeTable" value="besedilaTbl">
<input type="submit"  name="imeTable" value="uporabnikiTbl">
<input type="submit"  name="imeTable" value="pregledovalciTbl">
<input type="submit"  name="imeTable" value="limitiTbl">
<!--<input type="submit"  name="imeTable" value="ocenaTbl">-->
<input type="submit"  name="imeTable" value="sklepiTbl">
<input type="submit"  name="imeTable" value="bolnisniceTbl">
</form>
';
echo '
<h1>manipulace</h1>
<ul id="linky">
<li><a href="../admin/manipulacePregledovalci.php?nazaj='.$nazaj.'">pregledovalci</a></li>
<li><a href="../admin/manipulaceLimiti.php?nazaj='.$nazaj.'">limiti</a></li>
<!--<li><a href="../admin/manipulaceOcena.php?nazaj='.$nazaj.'">ocena</a></li>-->
<li><a href="../admin/manipulaceSklepi.php?nazaj='.$nazaj.'">sklepi</a></li>
<li><a href="../admin/manipulaceBolnisnice.php?nazaj='.$nazaj.'">bolnišnice</a></li><br>
</ul>
<a href="../admin1/vertikalMenu.php?nazaj='.$nazaj.'">.</a>
</div>
';
    } else {
	   echo	' <h2>za ta del niste pooblaščeni</h2>';
}
}//od construct 
}//od class Manipulace  
 $adminManipulace = new Manipulace(); 
require_once('sabloni/vkladane/zapati.php'); 
?>