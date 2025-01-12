<?php
echo'
<!DOCTYPE html>
<html lang="sl-SI">
<head>
<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="../css/navodila.css?'.time().'">
<link rel="stylesheet" href="../css/vnos.css?'.time().'">
</head>
<body>
';
require_once('../skupne/home.php');
echo '<a id="buttonDomov" href="' . $home . '" >Domov</a>';
?>
<h1><form action="uploadM.php" method="post" enctype="multipart/form-data">
	<?php
	//"$_GETrazpored" določi, kam se pdf naloži
	echo '<input type="hidden" name="direktorij" value="' . $_GET["direktorij"] . '" required><br>';
	?>
<label for="meseci">Izberi mesec:</label><br>
  <select id="meseci" name="meseci"  required>
    <option value=""></option>
    <option value="januar.pdf">Januar</option>
    <option value="februar.pdf">Februar</option>
    <option value="marec.pdf">Marec</option>
	<option value="april.pdf">April</option>
    <option value="maj.pdf">Maj</option>
    <option value="junij.pdf">Junij</option>
    <option value="julij.pdf">Julij</option>
    <option value="avgust.pdf">Avgust</option>
    <option value="september.pdf">September</option>	
	<option value="oktober.pdf">Oktober</option>
    <option value="november.pdf">November</option>
    <option value="december.pdf">December</option>	
  </select>
  <br>Izberi pdf za naložiti:<br>
  <input type="file" name="fileToUpload" id="fileToUpload" required><br>
  <input type="radio" id="zamenjaj" name="obstojeca" value=1>
  <label for="zamenjaj">Zamenjaj</label><br>
  <input type="radio" id="pusti" name="obstojeca" value=0>
  <label for="pusti">Pusti obstoječo</label><br>
  <input type="submit" value=<?php   echo '"' . $_GET["vrstaRazpisa"] . '"'?> name="submit">
</form></h1>

</body>
</html>