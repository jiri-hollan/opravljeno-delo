
<?php
require_once '../skupne/sabloni/zahlavi.php';
class Konekt {
	
	public $servername = '';
	public $username = '';
	public $password = '';
	public $dbname = '';
	public $connn = '';
	
	public Function __construct(){
	require_once '../skupne/streznik.php';

try {
    $this->conn = new PDO("mysql:host=" . $this->servername , $this->username, $this->password);
    $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);		
    echo "Uspešno pripojen na server";
    }
catch(PDOException $e)
    {
    echo "Povezava na server ni uspela: " . $e->getMessage();
    }
}//uzavírací zavorky __construct	
//-----------------konec construct--------------
}//uzavírací zavorky class Konekt
new Konekt;

require_once '../skupne/sabloni/zapati.php';
?>