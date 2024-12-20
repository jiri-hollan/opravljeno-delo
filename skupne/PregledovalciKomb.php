<?php
//echo '<script>alert("V pregledovalciKomb");</script>';
$kodaSql = "CREATE OR REPLACE VIEW pregledovalciKomb AS
SELECT bolnisnica, ime, priimek FROM uporabnikiTbl WHERE pristop >=1
UNION
SELECT bolnisnica, ime, priimek FROM pregledovalciTbl WHERE pregledovalciStatus >=1;";

mojSql($kodaSql);
function mojSql($kodaSql) {
require_once '../skupne/narediTablo.php';	
$databaseView=new DatabaseView;
$databaseView->narediSql($kodaSql);
}

class DatabaseView {
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


public function narediSql($kodaSql) {
try {    
    $sql = $kodaSql;
	//echo "<br>";
	//echo $sql . "<br>" ;
// use exec() because no results are returned
    $this->conn->exec($sql);
   // echo "Stavek SQL izvrsen";
    }
catch(PDOException $e)
    { 
	echo "napaka";
    echo $sql . "<br>" . $e->getMessage();
    }
$conn = null;
}//uzavírací zavorky function narediSql
//-------------------konec function narediSql-------

}//uzavírací zavorky class DatabaseView
?>