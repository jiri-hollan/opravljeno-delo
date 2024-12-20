
<?php
require_once '../skupne/sabloni/zahlavi.php';

echo '
<h2>Naredi tabelo</h2>
<form method="post" action="'. htmlspecialchars($_SERVER["PHP_SELF"]).'">  

  <label for="besedila"><span class="imenaFilov">besedila</span></label>
  <input type="radio" id="besedila" name="name" value="besedila">

  <label for="uporabniki"><span class="imenaFilov">uporabniki</span></label>
  <input type="radio" id="uporabniki" name="name" value="uporabniki">
  
   <label for="limiti"><span class="imenaFilov">limiti</span></label>
   <input type="radio" id="limiti" name="name" value="limiti">
   
    <label for="ocena"><span class="imenaFilov">ocena</span></label>
   <input type="radio" id="ocena" name="name" value="ocena">

   <label for="pregledovalci"><span class="imenaFilov">pregledovalci</span></label>
   <input type="radio" id="pregledovalci" name="name" value="pregledovalci">
   
   <label for="bolnisnice"><span class="imenaFilov">bolnisnice</span></label>
   <input type="radio" id="bolnisnice" name="name" value="bolnisnice">  
    
   <label for="sklepi"><span class="imenaFilov">sklepi</span></label>
   <input type="radio" id="sklepi" name="name" value="sklepi"> 
      
   <label for="bolnik"><span class="imenaFilov">bolnik</span></label>
   <input type="radio" id="bolnik" name="name" value="bolnik"> 
   <input type="hidden" name="nazaj" value='. $nazaj.'>
  <br><br>
  <input type="submit" name="submit" value="Submit">  
  <br>
</form>';
?>
<?php
// define variables and set to empty values
$name  = "";
$ime  = "";
if ($_SERVER["REQUEST_METHOD"] == "POST"&& isset($_POST["name"])) {
  $name = test_input($_POST["name"]);    
  $name = naredi($name);

}

function naredi($ime) {
require_once '../skupne/narediTablo.php';	
$databaseGloboka=new DatabaseGloboka;	
switch ($ime) {	
case "besedila":
$definice= "id INT(3) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    naslov VARCHAR(30) NOT NULL,
    direktorij VARCHAR(30) NOT NULL,
	fajl VARCHAR(30) NOT NULL,
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP";
$databaseGloboka->naredi('besedilaTbl', $definice);
break;

case "uporabniki":
$definice= "id INT(3) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	`email` varchar(255) CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL,
	`uname` varchar(255) CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL,
	`geslo` varchar(255) CHARACTER SET utf8 COLLATE utf8_slovenian_ci NOT NULL,
	`ime` varchar(255) CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL,
	`priimek` varchar(255) CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL,
    `upstatus` int(3) NOT NULL,
    `pristop` int(3) NOT NULL,	
	UNIQUE (email, uname)";
$databaseGloboka->naredi('uporabnikiTbl', $definice);
break;

case "limiti":
$definice= "id INT(3) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	`bolnisnica` varchar(255) CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL,	
	`skupina` varchar(255) CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL,	
	`ime` varchar(255) CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL,
    `min` float(4) NOT NULL,
	`max` float(4) NOT NULL";
$databaseGloboka->naredi('limitiTbl', $definice);
break;
/*.............................................................*/

case "ocena":
$definice= "id INT(3) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	`bolnisnica` varchar(255) CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL,		
	`ime` varchar(255) CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL,
	`ocena` varchar(255) CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL,	
    `ocenaStatus` int(3) NOT NULL";
$databaseGloboka->naredi('ocenaTbl', $definice);
break;

/*...............................................................*/
case "pregledovalci":
$definice= "id INT(3) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	`bolnisnica` varchar(255) CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL,	
	`ime` varchar(255) CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL,
	`priimek` varchar(255) CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL,
    `pregledovalciStatus` int(3) NOT NULL";
$databaseGloboka->naredi('pregledovalciTbl', $definice);
break;

case "bolnisnice":
$definice= "id INT(3) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	mesto varchar(255) CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL,
	nazivB varchar(255) CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL,
    bolnisnicaStatus int(3) NOT NULL,
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP";
$databaseGloboka->naredi('bolnisniceTbl', $definice);
break;

case "sklepi":
$definice= "id INT(3) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	`bolnisnica` varchar(255) CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL,	
	`sklep` varchar(255) CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL,
    `sklepiStatus` int(3) NOT NULL";
$databaseGloboka->naredi('sklepiTbl', $definice);
break;

case "bolnik":
$definice= "pregledId int NOT NULL AUTO_INCREMENT PRIMARY KEY,
datPregleda DATE,
imeZdravnika VARCHAR(100),
stevMaticna INTEGER,
ustanova VARCHAR(30),
EMSO NUMERIC(20), 
dan INTEGER,
mesec INTEGER,
leto INTEGER,
datRojstva VARCHAR(100),
starost NUMERIC(3),
ime VARCHAR(100),
priimek VARCHAR(100),
oddelek VARCHAR(100),
dgOperativna VARCHAR(100),
opNacrtovana VARCHAR(100),
teza DECIMAL(5),
visina DECIMAL(4,2),
bmi INTEGER,
krvniTlak VARCHAR(100),
pulz NUMERIC(3),
spo2 NUMERIC(3),
hb DECIMAL(3),
ks DECIMAL(3,1),
inr DECIMAL(3,1),
aptc DECIMAL(3),
trombociti DECIMAL(4),
kreatinin DECIMAL(3),
laktat NUMERIC(2,1),
pbnp NUMERIC(3),
pct NUMERIC(3,1),
crp NUMERIC(3),
na NUMERIC(3),
k NUMERIC(2,1),
drugiIzvidi VARCHAR(100),
ekg VARCHAR(255),
rtg VARCHAR(255),
dgPridruzene VARCHAR(255),
terPredhodna VARCHAR(255),
asa INTEGER,
mallampati INTEGER,
alergija VARCHAR(100),
izvidiInOpombe BLOB(2147483647),
premedVecer VARCHAR(100),
premedPredOp VARCHAR(100),
premedikacija VARCHAR(255),
sklep VARCHAR(255),
bolnikStatus CHARACTER(15)";
$databaseGloboka->naredi('bolnikTbl', $definice);
break;

/*
case "":
$definice= "";
$databaseGloboka->naredi('', $definice);
break;
*/
default:
    echo "ni izvelo get case"; 
  }//od switch	$ime
 echo "<h2>Your Input: ".$ime."</h2>";
echo "<br>"; 
}// od function naredi($ime)

require_once '../skupne/sabloni/zapati.php';
?>
