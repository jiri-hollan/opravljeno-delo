<!DOCTYPE html>
<html lang="cs-SI">
<head>
<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="../skupne/css/zahlavi.css?<?php echo time(); ?>">
<title>Anestiz</title>
<link rel="shortcut icon" href="../favicon.ico?<?php echo time(); ?>">
</head>
<body>
<div class="topnav">
<?php
if (isset($_GET['nazaj'])){
//$nazaj = $_GET['nazaj'];
      $nazaj = test_input($_GET['nazaj']);	
}elseif (isset($_POST['nazaj'])){		  
      $nazaj = test_input($_POST['nazaj']);	
  	//var_dump($nazaj); 
}else {
     $nazaj = "../frontend/menuFile1.php";
}
echo '
 <a class="active" href=' .$nazaj.'>Nazaj</a>
 ';
function test_input($test) {
  $test = trim($test);
  $test = stripslashes($test);
  $test = htmlspecialchars($test);
  return $test;
} 
 ?>
</div>





