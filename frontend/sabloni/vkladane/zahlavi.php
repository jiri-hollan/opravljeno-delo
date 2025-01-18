<?php
echo'
<!DOCTYPE html>
<html lang="cs-SI">
<head>
<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Anestiz</title>
<link rel="shortcut icon" href="../favicon.ico?'.time().'">
<link rel="stylesheet" href="sabloni/css/zahlavi.css?'.time().'">
<link rel="stylesheet" href="../css/menuFile.css?'.time().'">
<script src="../frontend/js/uporabnikiVse.js?'.time().'"></script> 
<script src="../pregled/js/prijava.js?'.time().'"></script>
<link rel="stylesheet" href="sabloni/css/uporabnikiNov.css?'.time().'">
</head>
<body>
<div class="topnav">
  <a id="dom" class="active" href="../frontend/menuFile1.php">Domov</a>
  <a id="prij" href="../frontend/prihlaseni.php?r=logout&stav=odhlasit">Prijava</a>
  <a href="../frontend/prihlaseni.php?r=profil">Moj profil</a>
  <span id="uname">odjavljen</span>
</div>';
?> 
