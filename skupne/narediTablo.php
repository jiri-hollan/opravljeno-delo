<?php

class DatabaseGloboka {
	public $servername = '';
	public $username = '';
	public $password = '';
	public $dbname = '';
	public $connn = '';
	public Function __construct(){
	require_once 'streznik.php';
      //$this->servername = "sh17.neoserv.si"; 
		$this->conn = new PDO("mysql:host=" . $this->servername . ";dbname=" . $this->dbname . ';charset=UTF8', $this->username, $this->password);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);		
	}//uzavírací zavorky __construct	
//-----------------konec construct--------------

public function naredi($tabulka, $definice) {
$tabulka ;
//$dbname="navodila";
try {
    // sql to create table
    $sql = "CREATE TABLE". " " . $tabulka . " " . " ($definice)";
// uporabljen exec() ker nič ne vrača
    $this->conn->exec($sql);
    echo "Tabela" . " " . $tabulka . " uspešno narejena";
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }
$conn = null;
}//uzavírací zavorky  naredi
//-------------------konec function naredi-------

public function narediSql($kodaSql) {
try {    
    $sql = $kodaSql;
	echo "<br>";
	echo $sql . "<br>" ;
// use exec() because no results are returned
    $this->conn->exec($sql);
    echo "Stavek SQL izvrsen";
    }
catch(PDOException $e)
    { 
	echo "napaka";
    echo $sql . "<br>" . $e->getMessage();
    }
$conn = null;
}//uzavírací zavorky function narediSql
//-------------------konec function narediSql-------
public function ogled($imeTable) { 
if ($imeTable!=""){
try {
$sql = "select column_name from information_schema.columns where table_name =  '$imeTable'";
//Prepare our SQL statement,
   $stmtl = $this->conn->prepare($sql);
// echo "To so stolpci tabele: " . "$imeTable", "<br>";
 echo "<br><table style='border: solid 1px black;'>";
 echo "<tr>";
//Execute the statement.
   $stmtl->execute();
//Fetch the rows from our statement.
  $tables = $stmtl->fetchAll(PDO::FETCH_NUM); 
//Loop through our table names.
   foreach($tables as $table){
//Print the table name out onto the page.
//echo "stolpci:";
//echo $table[0], '<br>';   
  echo '<th>'.$table[0].'</th>';
	} //od foreach-
    $stmt = $this->conn->prepare("SELECT * FROM " . $imeTable );
    $stmt->execute();
// set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
        echo $v;
    }
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
    }
}//id if
$conn = null;
}//uzavírací zavorky function ogled
//-------------------konec function ogled-------
public function pokaziTable() {
try {
	$sql = "SHOW TABLES";
//Prepare our SQL statement,
 $statement = $this->conn->prepare($sql);
//Execute the statement.
   $statement->execute();
//Fetch the rows from our statement.
//$tables = $statement->fetchAll(PDO::FETCH_NUM);
   $tables = $statement->fetchAll(PDO::FETCH_BOTH);
//Loop through our table names.
foreach($tables as $table){
//Print the table name out onto the page.
//echo $table[0], '<br>';
	print_r($table);
	echo '<br>';
print("\n");
} 
}

catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
    }
$conn = null;
}//uzavírací zavorky function pokaziTable
//-------------------konec function pokaziTable-------

public function pokaziStolpce($tabulka) {
try {
   $sql = "select column_name from information_schema.columns where table_name = '$tabulka'";
//echo $sql, "<br>";
//Prepare our SQL statement,
    $statement = $this->conn->prepare($sql);
   echo "To so stolpci tabele: " . $tabulka, "<br>";
//Execute the statement.
   $statement->execute(); 
//Fetch the rows from our statement.
  $tables = $statement->fetchAll(PDO::FETCH_NUM);
//Loop through our table names.
   foreach($tables as $table){
//Print the table name out onto the page.
//echo "stolpci:";
//echo $table[0], '<br>';
   print_r($table);
   echo '<br>';	
}
}catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
    }
$conn = null;
}//uzavírací zavorky function pokaziStolpce
//-------------------konec function pokaziStolpce-------
}//uzavírací zavorky class DatabaseGloboka
?>