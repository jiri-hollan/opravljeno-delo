<?php
//----naloži datoteko besedila pod originalnim imenom----
$nameTable = $_POST["nameTable"];
$nalozi['naslov'] = $_POST["naslov"];
$nalozi['direktorij'] = $_POST["direktorij"];
$nalozi['fajl'] = basename($_FILES["fileToUpload"]["name"]);
//$nalozi[''] = '';
//$nalozi[''] = '';
echo "<h2>Naslov prispevka: " . $_POST["naslov"]. "</h2><br>";
//$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$target_file = $nalozi['direktorij'] . $nalozi['fajl'];
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if file already exists
if (file_exists($target_file)) {
echo "<h2>" . $target_file . " že obstaja.</h2><br> ";
   if (!empty($_POST["obstojeca"] )){
	   $uploadOk = $_POST["obstojeca"] ;
   }else{
  $uploadOk = 0;
   }
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 2000000) {
  echo "<h2>Sorry, your file is too large.</h2>";
  $uploadOk = 0;
}
//Check for pdf format
if (!empty($_FILES['fileToUpload']['tmp_name'])) {
  $finfo = finfo_open(FILEINFO_MIME_TYPE);
  $mime = finfo_file($finfo, $_FILES['fileToUpload']['tmp_name']);
  if (($mime != 'application/pdf') && ($mime != 'image/jpg') && ($mime != 'image/jpeg') && ($mime != 'image/gif') && ($mime != 'image/png')) {
    $uploadOk = 0;
    echo "<div class=\"alert alert-danger\" role=\"alert\"><strong>This file is not a valid file.</strong></div>";
   }//od if ime...
} //od if empty
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "<h1>Sorry, your file was not uploaded.</h1>";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
//vstavi($nameTable,$nalozi['naslov'] ,$nalozi['direktorij'],$nalozi['fajl']);
vstavi($nameTable,$nalozi);
    echo "<h1>The file ". $nalozi['fajl']. " je bila naložena kot: " . $target_file . "</h1>";
  } else {
    echo "<h1>Sorry, there was an error uploading your file.</h1>";
  }//od drugega else
}//od prvega else
function vstavi($nameTable,$nalozi){
//echo var_dump($nalozi);
$nameTable;
$naslov;
$direktorij;
$fajl;
try {		
require_once '../skupne/database.php';
$tabulka=$nameTable;
//$data= array("naslov"=>$naslov, "direktorij"=>$direktorij, "fajl"=>$fajl);
  $data= $nalozi;
  $vloz = new database($tabulka,$data);
  $vlozeno=$vloz->vloz($tabulka,$data );
//echo $vlozeno[1];
echo "<br>";
echo var_dump($vlozeno);
echo "<br>";
echo count($vlozeno);
echo "<br>";
echo "New record created successfully";
    }// od tray
catch(PDOException $e) { 
    echo $sql . "<br>" . $e->getMessage();
    }
$conn = null;
}//od function vstavi
?>
