<?php 
 require_once ('databaseS.php');
 require_once ('../identifikace.php');
 echo'<script src="../js/delo.js?'.time().'"></script>';
//_____________________________________________________________
if (isset($_REQUEST["akceClass"])) {
	  $akceClass = new Test_input($_REQUEST["akceClass"]);
	  $akceClass = $akceClass->get_test();

  
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
var_dump($akceClass);
echo"ogledStatistika.php linija33";
  echo strtoupper($akceClass) .': ';
  echo '<b>dne: </b>'.($datumOpravila) .'<br>';
 //echo "tabulka je: ".$tabulka;
  new $akceClass($stevilkaZdravnika, $datumOpravila, $tabulka);	  
}//od if akceClass
/*else {
	 echo'akceClass ni določena'; 
  }*/
//_________________________________
?>