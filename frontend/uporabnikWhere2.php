<?php
require_once '../skupne/database.php'; 
//var_dump ($data);
//require_once 'testVariable.php';

class TableRows extends RecursiveIteratorIterator {
    function __construct($it) {
        parent::__construct($it, self::LEAVES_ONLY);
    }

    function current() {
        return "<td style='width: 150px;border:1px solid black;'>" . parent::current(). "</td>";
    }

    function beginChildren() {
        echo "<tr>";
    }

    function endChildren() {
        echo "</tr>" . "\n";
    }
}//od class TableRows
//-------------------------------------------------------------------------------------------------------------

class UporabnikiWhere {
	public $data;
	public $conn;
	 
	  function __construct($data) {

echo "<table style='border: solid 1px black;'>";
 echo "<tr><th>Id</th><th>email</th><th>username</th><th>bolnisnica</th><th>ime</th><th>priimek</th><th>upstatus</th><th>pristop</th></tr>";

try {
	
	$this->conn =new Database();	
	
	//$data=new OcistiData();


    $this->data=$data;
   // echo 'this data: ';
	//var_dump ($this->data);
    //var_dump ($data);
	
	$uporabnikiIzbrani = $this->conn->vyber('uporabnikiTbl', array('id', 'email', 'uname', 'bolnisnica', 'ime', 'priimek', 'upstatus', 'pristop'), $this->data);
	//var_dump($uporabnikiIzbrani);
	//--------------------------------------------------------
   
	//var_dump($stmt->fetchAll());
    foreach(new TableRows(new RecursiveArrayIterator($uporabnikiIzbrani)) as $k=>$v) {
        echo $v;
    }
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;
echo "</table>";
	  }//od __construct
}//od class UporabnikiWhere
//new UporabnikiWhere();
?>

