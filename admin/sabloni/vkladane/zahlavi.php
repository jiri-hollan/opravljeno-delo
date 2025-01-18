<?php
echo'
<!DOCTYPE html>
<html lang="cs-SI">
<head>
<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin</title>
<link rel="shortcut icon" href="../favicon.ico?'.time().'">
<link rel="stylesheet" href="../admin/sabloni/css/zahlavi.css?'.time().'">
<link rel="stylesheet" href="../admin/sabloni/css/menuFile.css?'.time().'">
<script src="../admin/js/uporabnikiVse.js?'.time().'"></script> 
<link rel="stylesheet" href="../admin/sabloni/css/uporabnikiNov.css?'.time().'">
</head>
<body>
<div class="topnav">
  <a class="active" href="../frontend/menuFile1.php">Domov</a>
  <a href="../frontend/prihlaseni.php?r=logout&stav=odhlasit">Odjava in prijava</a>
</div>';

 function test_input($test) {
  $test = trim($test);
  $test = stripslashes($test);
  $test = htmlspecialchars($test);
  return $test;
} 
 ?> 


