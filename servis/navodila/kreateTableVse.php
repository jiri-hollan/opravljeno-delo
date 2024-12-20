<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title></title>
</head>
<body>

<h2>Naredi tabelo</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  

  <label for="besedila">besedila</label>
  <input type="radio" id="besedila" name="name" value="besedila">

  <label for="uporabniki">uporabniki</label>
  <input type="radio" id="uporabniki" name="name" value="uporabniki">
  
  <label for="omejitve">omejitve</label>
  <input type="radio" id="omejitve" name="name" value="omejitve"> 
  <br><br>
  <input type="submit" name="submit" value="Submit">  
  <br>
</form>

<?php
// define variables and set to empty values
$name  = "";
$ime  = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = test_input($_POST["name"]);
  $name = naredi($name);
}

function test_input($test) {
  $test = trim($test);
  $test = stripslashes($test);
  $test = htmlspecialchars($test);
  return $test;
}
function naredi($ime) {
require_once '../../skupne/narediTablo.php';	
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

case "omejitve":
$definice= "id INT(3) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    razlog VARCHAR(30) NOT NULL,
    nivo INT(3) NOT NULL";
$databaseGloboka->naredi('omejitveTbl', $definice);

break;

case "":

break;

case "":

break;

case "":

break;

case "":

break;

case "":

break;
default:
    echo "ni izvelo get case"; 
  }//od switch	$ime
 echo "<h2>Your Input: ".$ime."</h2>";
echo "<br>"; 
}// od function naredi($ime)


?>


</body>
</html>
