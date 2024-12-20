<!DOCTYPE html>
<html lang="cs-SI">
<head>
<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin</title>
<link rel="shortcut icon" href="../favicon.ico?<?php echo time(); ?>">
<link rel="stylesheet" href="../admin/sabloni/css/zahlavi.css?<?php echo time(); ?>">
<link rel="stylesheet" href="../admin/sabloni/css/menuFile.css?<?php echo time(); ?>">
<script src="../admin/js/uporabnikiVse.js?<?php echo time(); ?>"></script> 
<link rel="stylesheet" href="../admin/sabloni/css/uporabnikiNov.css?<?php echo time(); ?>">
</head>
<body>
<div class="topnav">
  <a class="active" href="../frontend/menuFile1.php">Domov</a>
  <a href="../frontend/prihlaseni.php?r=logout&stav=odhlasit">Odjava in prijava</a>
</div>
 <?php require_once('../admin/sabloni/oznamovaci-oblast.php');  
 function test_input($test) {
  $test = trim($test);
  $test = stripslashes($test);
  $test = htmlspecialchars($test);
  return $test;
} 
 ?> 


