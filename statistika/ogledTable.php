<?php 
 @session_start();
$uname = !empty($_SESSION["uname"]) ? $_SESSION["uname"] : "";
$nazaj="statistikaMenu.php";
 require_once('sabloni/zahlavi.php');
/* V tom failu so funkcije za spreminjanje tabele databaze*/
 require_once('sabloni/formDelo.php');//komentar: gumbi "izberi vlož"
 require_once ('databaseS.php');
 require_once ('identifikace.php');
 require_once ('ogledi.php');
 echo'<script src="../delo/js/delo.js?'.time().'"></script>';
 	$podminka = array("uname"=>$uname);
	$uporabnik=new VyberUporabnika($podminka);
	$stevilkaZdravnika=$uporabnik->stevilkaZdravnika;
//echo " je to trenutni uporabnik? ".var_dump ($stevilkaZdravnika);	
//_____________________________________________________________
if (isset($_REQUEST["akce"])) {
	  $akce = new Test_input($_REQUEST["akce"]);
	  $akce = $akce->get_test();

  
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
//var_dump($akce);
//echo "linija 39 ".strtoupper($akce) .': ';
//echo '<b>dne: </b>'.($datumOpravila) .'<br>';
//echo "tabulka je: ".$tabulka;
  new $akce($stevilkaZdravnika=NULL, $datumOpravila, $tabulka);	  
}//od if akce
/*else {
	 echo'akce ni določena'; 
  }*/
//_____________________________________________________________
?>	
