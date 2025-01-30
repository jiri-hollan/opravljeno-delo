 <?php 
 session_start();
$uname = !empty($_SESSION["uname"]) ? $_SESSION["uname"] : "";
 require_once('sabloni/zahlavi.php');
/* V tom failu so funkcije za spreminjanje tabele databaze*/
 require_once('sabloni/formDelo.php');//komentar: gumbi "izberi vlož"
 require_once ('databaseS.php');
 require_once ('identifikace.php');
  require_once ('ogledObjektPrijavljeni2.php');
 echo'<script src="../js/delo.js?'.time().'"></script>';
 	$podminka = array("uname"=>$uname);
	$stevilkaUporabnika=new VyberUporabnika($podminka);
	$stevilkaUporabnika=$stevilkaUporabnika->stevilkaZdravnika;
	echo " je to trenutni uporabnik? ".var_dump ($stevilkaUporabnika);
//_____________________________________________________________
?>	
