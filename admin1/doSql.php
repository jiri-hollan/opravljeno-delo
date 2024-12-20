
<?php
require_once '../skupne/sabloni/zahlavi.php';
// define variables and set to empty values
$kodaSql = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $kodaSql = test_input($_POST["kodaSql"]); 
  echo "<br>";
  echo "kodaSql=" . " " . $kodaSql;
   echo "<br>";
 mojSql($kodaSql);
}
?>

<h2>Vnesi stavek SQL in potrdi</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  Vnesi : 
		<br>
		<textarea name="kodaSql" rows="10" cols="30"></textarea>
		<br>
        <input type="submit" name="Submit" value="potrdi"> 
</form>
<?php
echo "<h2>Your Input:</h2>";
echo $kodaSql;
function mojSql($kodaSql) {
require_once '../skupne/narediTablo.php';	
$databaseGloboka=new DatabaseGloboka;
$databaseGloboka->narediSql($kodaSql);
}
require_once '../skupne/sabloni/zapati.php';
?>