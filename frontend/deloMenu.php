<?php
require_once('administrace.php');
class MenuDelo  {
   public function __construct() {
   require_once('../skupne/menuDelo-items.php');          
echo '
<nav id= "glavnaNav">
<ul>';
  if (isset($_SESSION["upstatus"]))  {
	  //require_once('../skupne/MenuDelo-items.php'); 
	   switch ($_SESSION["upstatus"]) {		   
	case 0:
	  echo $a0;
	  echo "<p style='color: black;'>vaša registracija še ni overjena</>";
    break; 
	case 1:
	  echo $a0.$a1;
    break;   
     case 2:
	   echo $a0.$a1.$a2;
	 break;	 
	 case 3:
	   echo $a0.$a1.$a2.$a3;
    break;   
    default:
	   } //od switch
	 echo
	'<script>
    document.getElementById("prij").innerHTML = "Odjava";
	document.getElementById("uname").innerHTML = "prijavljen";	
     </script>';
   }//od if 
   else{
	 	  echo $a0; 
   }
      echo '</ul></nav>';
   }//od construct
}//od class MenuDelo  
$adminAnestiz = new MenuDelo(); 
$uname = !empty($_SESSION["uname"]) ? $_SESSION["uname"] : "";
require_once('sabloni/vkladane/zapati.php'); 
?>
	
?>