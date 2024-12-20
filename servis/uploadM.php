<!DOCTYPE html>
<html lang="sl-SI">
<head>
<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

<?php
//---------spremeni ime datoteke na ime izbranega meseca-------
echo "<h2>Tarčna datoteka: " . $_POST["meseci"]. "</h2><br>";
//$target_dir = "../../oddelek/dezurstva/mesPdf/";
$target_dir = $_POST["direktorij"];
$target_fileIme = $_POST["meseci"];
$target_file = $target_dir . $target_fileIme;
//$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
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
if ($_FILES["fileToUpload"]["size"] > 500000) {
  echo "<h2>Sorry, your file is too large.</h2>";
  $uploadOk = 0;
}

 //Check for pdf format---zakomentirani so slikovni formati-----
            if (!empty($_FILES['fileToUpload']['tmp_name'])) {
                $finfo = finfo_open(FILEINFO_MIME_TYPE);
                $mime = finfo_file($finfo, $_FILES['fileToUpload']['tmp_name']);
                if (($mime != 'application/pdf') /*&& ($mime != 'image/jpg') && ($mime != 'image/jpeg') && ($mime != 'image/gif') && ($mime != 'image/png')*/) {

                    $uploadOk = 0;
                    echo "<div class=\"alert alert-danger\" role=\"alert\"><strong>This file is not a valid file.</strong></div>";

                    //exit();

                }} //this bracket was missing I think
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "<h1>Sorry, your file was not uploaded.</h1>";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    echo "<h1>The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " je bila naložena kot: " . $target_fileIme . "</h1>";
  } else {
    echo "<h1>Sorry, there was an error uploading your file.</h1>";
  }
}
?>


</body>
</html>