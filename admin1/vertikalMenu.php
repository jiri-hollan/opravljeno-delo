<?php
require_once('../admin/sabloni/vkladane/zahlavi.php');
echo 'napredna manipulacija z bazo';
require_once('../admin/administrace.php');

class Vertikal extends Administrace {
   public function __construct() {
	       parent::__construct();
		   
  if (isset($_SESSION["upstatus"]) && $_SESSION["upstatus"] == 3)  {
$nazaj="../admin1/vertikalMenu.php";	  
echo '

<h1>Menu servis</h1>
<ul id="linky1">
<li><a href="konekt.php?nazaj='.$nazaj.'">Pripoji se na server</a></li>
<li><a href="odklop.php?nazaj='.$nazaj.'">Odpoji se od serverja</a></li>
<li><a href="selektPrikazi.php?nazaj='.$nazaj.'">prikazi izbrano tabelo</a></li>
<li><a href="doSql.php?nazaj='.$nazaj.'">vnesi in poženi SQL</a></li>
<li><a href="pokaziTable.php?nazaj='.$nazaj.'">pokaži Table</a></li>
<li><a href="pokaziStolpce.php?nazaj='.$nazaj.'">pokaži Stolpce</a></li>
<li><a href="serverInformace.php?nazaj='.$nazaj.'">Informace o serveru</a></li>
</ul>
<h1>Menu premedikacija</h1>
<ul id="linky1">
<li><a href="../admin1/manipulaceOmejitve.php?nazaj='.$nazaj.'">Omejitve</a></li>
<li><a href="../admin1/manipulaceUporabniki.php?nazaj='.$nazaj.'">uporabniki</a></li>
<li><a href="kreateBasepremedikacija.php?nazaj='.$nazaj.'">naredi bazo: premedikacija</a></li>
<li><a href="kreateTableVse.php?nazaj='.$nazaj.'">naredi tabele</a></li>
</ul>
';
     } else {
	echo	' <h2>za ta del niste pooblaščeni</h2>';
	}
   }//od construct 
}//od class vertikal  
 $adminVnertikal = new Vertikal(); 
require_once('../admin/sabloni/vkladane/zapati.php'); 
?>