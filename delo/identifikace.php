<?php
class VyberUporabnika {
public $podminka;
function __construct($podminka="") {
	    $this->podminka=$podminka;
//echo('<br>VyberUporabnika podminka= ');		
//var_dump($podminka);
	    $this->tabulka="uporabnikiTbl";
	    $this->stolpci=["stevilkaZdravnika","ime","priimek","bolnisnica"];
//echo('<br>VyberUporabnika stolpci= ');
//var_dump($this->stolpci);
	    $this->vyber=new database();
	    $vybrano=$this->vyber->vyber($this->tabulka, $this->stolpci, $this->podminka );
//echo'<br>VyberUporabnika $vybrano= '.($vybrano[0]["stevilkaZdravnika"]);		
if(count($vybrano)>0){
//echo($vybrano[0]["stevilkaZdravnika"]);	
$stevilkaZdravnika=($vybrano[0]["stevilkaZdravnika"]);
$ime=($vybrano[0]["ime"]);	
$priimek=($vybrano[0]["priimek"]);
$bolnisnica=($vybrano[0]["bolnisnica"]);	
$identifikace=' '.$stevilkaZdravnika.' '.$ime.' '.$priimek.' '.$bolnisnica;
$GLOBALS['stevilkaZdravnika']=$stevilkaZdravnika;
$GLOBALS['identifikace']=$identifikace;
//echo $GLOBALS['identifikace'];
}//od if(cout)
	else{
   echo "Za izbranega uporabnika ni zapisa v bazi";	
}//od else
echo'<script>
identifikace="'.$GLOBALS['identifikace'].'";
identifikaceFunction(identifikace);
</script>';
	}//od construct
		}//od class vyber uporabnika
?>