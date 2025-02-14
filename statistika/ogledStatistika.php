<?php 
 require_once ('databaseS.php');
 require_once ('identifikace.php');
 require_once ('ogledi.php');
 echo'<script src="../delo/js/delo.js?'.time().'"></script>';
//_____________________________________________________________
if (isset($_REQUEST["dolociClasso"])) {
	  $dolociClasso = new Test_input($_REQUEST["dolociClasso"]);
	  $dolociClasso = $dolociClasso->get_test();

  
  //______________________________________________________
   if (isset($_REQUEST["datumVpisa"])){
	  $datumOpravila = new Test_input($_REQUEST['datumVpisa']); 
      $datumOpravila = $datumOpravila->get_test();
	  
  }else {
	 $datumOpravila = "";   
  }
  //------------------------------------------------------
 if (isset($tabulka)){
	  $tabulka= $tabulka; 
  }else if (isset($_REQUEST["tabulka"])){
	  $tabulka= new Test_input($_REQUEST["tabulka"]);
	  $tabulka = $tabulka->get_test();
  }else {
	  echo "<script>alert(ni tabulke v post);</script>";
  }
var_dump($dolociClasso);
echo"ogledStatistika.php linija33";
  echo strtoupper($dolociClasso) .': ';
  echo '<b>dne: </b>'.($datumOpravila) .'<br>';
 //echo "tabulka je: ".$tabulka;
  new $dolociClasso($stevilkaZdravnika, $datumOpravila, $tabulka);	  
}//od if dolociClasso
/*else {
	 echo'dolociClasso ni določena'; 
  }*/
//_________________________________
?>