<?php
require_once 'sabloni/zahlavi.php';
require_once('../skupne/home.php');
echo '<a id="buttonDomov" href="' . $home . '" >Domov</a>';
?>
<h1> Nalaganje besedila </h1>
<h2>
<form action="uploadBesedilo.php" method="post" enctype="multipart/form-data">
	<?php
	//"$_GETrazpored" določi, kam se pdf naloži	
	echo '<input type="hidden" name="direktorij" id="direktorij" value="' . $_GET["direktorij"] . '" readonly>';
	?>
  <label for="besediloNaslov">Naslov besedila: </label><br>
  <input type="text" name="naslov" id="besediloNaslov" value="" placeholder="smiselni naslov"  required><br>
  <br>Izberi pdf ali slikovno datoteko za naložiti:<br>
  <input type="hidden" name="nameTable" id="nameTable" value="besedilaTbl">
  <input type="file" name="fileToUpload" id="fileToUpload" required><br>
  <input type="radio" id="zamenjaj" name="obstojeca" value=1>
  <label for="zamenjaj">Zamenjaj</label><br>
  <input type="radio" id="pusti" name="obstojeca" value=0>
  <label for="pusti">Pusti obstoječo</label><br>
  <input type="submit" value="Naloži besedilo" name="submit">
</form>
</h2>
<?php
require_once '../skupne/sabloni/zapati.php';
?>