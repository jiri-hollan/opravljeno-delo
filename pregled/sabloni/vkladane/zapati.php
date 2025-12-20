  
<!--.................................................Navigacija.........................-->	
 <div class="navbar" id="navbar" >
<?php
require_once('../skupne/home.php');
echo '<button class=""id="buttonDomov" onclick="window.location.href=' . "'" . $home . "'" . ';"> Domov </button>';
?>
     <span class="" id="odjava" onclick="odjavaFunction()">RESET</span>
<!-- Funkcija novBolnikFunction shrani formu u bazo in skoči na vpis novega bolnika -->
     <span class="navSpan" id="novB" onclick="novBolnikFunction(1);">Nov bolnik</span>
	 
	 <div id="najdiZapis"class="dropdown">
<?php
require_once('../skupne/aktivace.php');
if($gdpr==1){
if (isset($_SESSION["pristop"]) && $_SESSION["pristop"] == 3) {	
echo '
<button class="dropbtn">najdi</button>
<div class="dropdown-content">
<a href="vybere.php">matična št.</a>
</div>
';
}
  }
?> 
</div>
     <span class="navSpan" id="nazaj" onmouseover="administraceFunction()" onclick="nazajFunction()">nazaj</span>
     <span class="navSpan" id="predogled" onmouseover="administraceFunction()"  onclick="return reportFunction('p')">predogled</span>
     <span class="navSpan" id="natisni" onclick="return reportFunction('t')">natisni</span>   
	 <span class="navSpan" id="prenos" onclick="return prenosFunction('pr')">prenos</span>
     <span class="navSpan" id="pomoc" onclick="pomocFunction()">pomoč</span>
	 <!--<span class='knof' id="prijavi" onclick='schovej("id02")' style='width:auto;'>Prijava</span>-->
<?php
if($gdpr==1 && $_SESSION["pristop"] && $_SESSION["pristop"] >= 2){

 
 echo "<span class='navSpan' id='submitFrm' onmouseover='administraceFunction()' onclick='return reportFunction(\"s\")'>shrani</span>";
 
  }else{
	echo "<span class='knof' id='prijavi' onclick='schovej(\"id02\")' style='width:auto;'>Prijava</span>";  
  }
?> 
  <!--   <span class="navSpan" id="submitFrm" onclick="return reportFunction('s')">shrani</span> -->
 </div>	 
</body>
</html>