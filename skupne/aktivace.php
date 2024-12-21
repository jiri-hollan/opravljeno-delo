<?php
require_once'database.php';
// aktivace
$database=new Database;
$database->testirajBolnik();
if($database->bolnikObstaja==2){
$tabulka="omejitveTbl";
$sloupce=["razlog", "nivo"];
$podminka=["razlog"=>"gdpr"];
$database= new Database;
$gdpr=$database->vyber($tabulka,$sloupce,$podminka);
//echo '<br>'.count($gdpr).'<br>';

if(count($gdpr)==1){
$omejitevGdpr=$gdpr[0];		
	switch($omejitevGdpr['nivo']){
	case "0":
	$gdpr=$_SESSION["uporabnikGdpr"]; 
    break;
	
	case "1":
	$gdpr=$omejitevGdpr['nivo']; 
    break;	
	
	case "2":
	$gdpr=0; 
    break;
	
    default:
    echo "ni izvelo case";			
	}
echo'<script>';
echo 'localStorage.setItem("gdpr",'.$gdpr.');';
echo'</script>';
}//od if cout
else{
echo'aktivace linija 37';	
}
}//od if database obstaja
else{
$gdpr=0;
echo'<script>';
echo 'localStorage.setItem("gdpr",'.$gdpr.');';
echo'</script>';
}

?>