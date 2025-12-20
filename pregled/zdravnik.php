<?php
@session_start();
echo'
<!DOCTYPE html>
<html lang="sl-SI">
<head>
<meta http-equiv="cache-control" content="No-Cache">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Anestiz-set</title> 
<link rel="shortcut icon" href="../favicon.ico?'.time().'">
<script src="js/prijava.js?'.time().'"></script> 
<script src="js/odjava.js?'.time().'"></script>
<link rel="stylesheet" type="text/css" href="css/zdravnik.css?'.time().'">
<link rel="stylesheet" type="text/css" href="css/uporabnik.css?'.time().'">
</head>
<body>';

/************************************************************************************
ZA DOLOČITEV BOLNIŠNICE JE POTREBNO VPISATI PARAMETR FUNKCIJE sbFunction ZA IZOLO "i" ZA JESENICE "j"
oziroma to določi izbira NAV bara, če je ta aktivirana
***********************************************************************************/
//$uname = !empty($_SESSION["uname"]) ? "prijavljen je: ".$_SESSION["uname"] : "Niste prijavljeni";
if(!empty($_SESSION["uname"])){
$uname = "<span id='stanjeDa'>prijavljen je: ".$_SESSION["uname"]."</span>";
}else{
$uname = "<span id='stanjeNe'>Niste prijavljeni</span>";
//echo "<button class='knof' onclick='schovej(\'id02\')' style='width:auto;'>Prijava<button/>";
}

?>
<div id="prijava" >
<p id="aktBolnisnica">.</p>
<p id="pregledovalec"> </p>
<h1>Identifikacija izvajalca</h1>
	 <!-- Izbira bolnišnice -->
<label for="bolnisnica" >Bolnišnica:</label> 
<input id="bolnisnica"  list="bolnisnice" name="bolnisnica"  onkeyup="sbFunction(1)" required autocomplete="off"> 
  <datalist id="bolnisnice">  
    <option value='Bolnišnica'>    
  </datalist>
	 <!-- Izbira zdravnika -->
<br><br><label for="zdravnik" > Zdravnik:</label> 
<input id="zdravnik"  list="zdravniki" name="zdravnik"  onkeyup="zdravnikFunction()"autocomplete="off"  required> 
  <datalist id="zdravniki">  
    <option value='ime zdravnika'>    
  </datalist>
<p> <button onclick="naprejFunction()">Naprej</button>
</div>
<div class="navbar" id="navBolnisnice" style='display:z-index:1;'>
<?php
require_once('../skupne/home.php');
require_once('zapisVsi.php');
require_once('bolnisnice.php');
require_once('sabloni/pFormular.php');
echo '<button id="buttonDomov" onclick="window.location.href=' . "'" . $home . "'" . ';"> Domov </button>';
	
?>
 <script>
   var seznamBolnisnicx = JSON.parse(seznamBolnisnicJson);
// alert(seznamBolnisnicJson);
   var mestoBolnisniceX = JSON.parse(mestoBolnisniceJson);
   listaBolnisnicFunction(mestoBolnisniceX );
// alert("celo ime Json:" + celoImeJson);
  var zdravListX = JSON.parse(celoImeJson);
//alert(zdravListX);
  listaZdravnikovFunction(zdravListX);
//alert(localStorage.getItem("bazeBolnisnice"));
  </script>
     <span class="" id="odjava" onclick="odjavaFunction()">RESET</span>
	 <!--<span class='knof' onclick='schovej("id02")' style='width:auto;'>Prijava</span>-->
<?php
if(empty($_SESSION["uname"])){
	 echo"<span class='knof' onclick='schovej(\"id02\")' style='width:auto'>Prijava</span>";
}

echo"$uname";
?>
 </div>	 
</body>
</html>
