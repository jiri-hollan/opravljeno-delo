<?php
echo'<script src="../statistika/js/statistika.js?'.time().'"></script>';



echo '
<div class="glavni">
<form id="formaPogojiId" method="post" action="'.htmlspecialchars($_SERVER["PHP_SELF"]).'">
<input type="hidden" id="akceId" name="akce" value="">

<label for "zacDatum">od</label>
<input id="zacDatum" type="date" name="zacDatum" value="'.date("Y-m-d").'" >
<label for "koncDatum">do</label>
<input id="koncDatum" type="date" name="koncDatum" value="'.date("Y-m-d").'" >
  <div class="notranji">
  <label for="opraviloId">vrsta opravila: </label><br>
  <input id="opraviloId" value="" name="opravilo"  autocomplete="off"><br>
  <select id="opravilaId"   onchange="myFunction()"><option>opravilo</select>
  </div><br>
<input type="reset" name="reset" value="Reset">
<input type="submit" name="submit" value="Submit">
</form>
</div>
';
echo'
<br><br><br><br><br><br><br><br>
<!--<link rel="stylesheet" href="../css/delo.css?'.time().'">-->
<form method="post" action="'.htmlspecialchars($_SERVER["PHP_SELF"]).'">
<input type="text" id="akceId" name="akce" value="vloz">
<p id="demo"></p>
<p id="posli"></p>
</form>
<p id="demo3"></p>
<script>pogojFunction("vloz","6027");</script>
';

Class PoberZapis{
	public $conn;
	public $pristop;
	public function __construct($bolnisnica) {
 $this->conn = new Database();	
 $this->nameTable = 'opravilaTbl';
 $stolpci = array('sifraOpravila','opravilo');
 $poradi = "";
//bolnisnicapregledId je obsoječa bolnisnica v tabeli pregledovalciKomb
 $podminka = array(""); 
 $prebrano = $this->conn->vyber($this->nameTable, $stolpci, $podminka, $poradi);  
//var_dump($prebrano); 
 $opravilo=[];
 for ($i = 0; $i < count($prebrano); $i++) {
//echo $prebrano[$i]["opravilo"].'<br>';	
 //$opravilo= $prebrano[$i]["sifraOpravila"].':'.$prebrano[$i]["opravilo"];
 $sifra=$prebrano[$i]["sifraOpravila"];
 //echo'šifra= '.$sifra;
 $oprav=$prebrano[$i]["opravilo"];
  $opravilo[$sifra]=$oprav;
//echo '<br>'.$opravilo.'<br>';//izpiše  opravilo na zaslon
echo'<br>';
//var_dump ($opravilo);

}//od for 
//echo'<br>';
//var_dump($opravilo);
//echo'<br>';
  $opraviloJson = json_encode($opravilo, JSON_UNESCAPED_UNICODE);
// echo $opraviloJson;
  echo '<script>';
  echo 'var opraviloJson= ' . json_encode( $opraviloJson, JSON_UNESCAPED_UNICODE) . ';';
  echo '</script>';
}//od construct	
}//od class PoberZapis
?>