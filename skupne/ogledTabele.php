<?php
require_once 'sabloni/zahlavi.php';  
	  if (isset($_POST['imeTable'])){		  
	   $imeTable = test_input($_POST['imeTable']);		  
	  }
	  if (isset($_GET['imeTable'])){	  
	   $imeTable = test_input($_GET['imeTable']);
	  }
echo $imeTable;	  
echo "<table style='border: solid 1px black;'>";

class TableRows extends RecursiveIteratorIterator {
    function __construct($it) {
        parent::__construct($it, self::LEAVES_ONLY);
    }

    function current() { 
		return "<td style='width:250px;border:1px solid black;'>" . parent::current() . "</td>";
    }

    function beginChildren() {
        echo "<tr>";
    }

    function endChildren() {
        echo "</tr>" . "\n";
    }
}
require_once 'narediTablo.php';	
$databaseGloboka=new DatabaseGloboka;
$databaseGloboka->ogled($imeTable);
echo "</table>";
require_once 'sabloni/zapati.php';
?>

