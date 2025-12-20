<?php
@session_start();
require_once('../skupne/database.php');
require_once('../skupne/administrace.php');
require_once('../koren.php');
//require_once('sabloni/vkladane/zahlavi.php');
//$koren = $_REQUEST["q"];
//echo "sessionKontrola linija 7 dolarKoren: ".$koren;
new administrace($koren);
?>