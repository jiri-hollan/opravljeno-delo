<?php
require_once 'sabloni/zahlavi.php';
require_once '../skupne/database.php';
$conn = new Database();
//var_dump($_GET);
$id = $_GET["id"];
//echo '<p>sprejeto: '.$id.'</p>';
$nameTable = "bolnikTbl";
$stolpci = array('*');
$podminka = array("pregledId"=>$id);
$prebrano = $conn->vyber($nameTable, $stolpci, $podminka);
//var_dump($prebrano[0]);
// tu treba odstraniti pregledId
unset($prebrano[0]['pregledId']);
$iskaniPregled = json_encode($prebrano[0]);
$GLOBALS['testJSON'] = $iskaniPregled;
?>
<script>
  console.log('test1');  
  stringJson=JSON.stringify(<?php echo $GLOBALS['testJSON']; ?>);
  console.log('test1');
//alert(stringJson);
  sessionStorage.setItem("testJSON", stringJson); 
//alert(sessionStorage.getItem("testJSON"));  
  window.location.href = "bolnik.php";   
  </script>
 <?php 
 require_once 'sabloni/zapati.php';
 ?>
