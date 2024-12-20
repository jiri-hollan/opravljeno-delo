
<form id="frm" name="bolnikForma" method="post" action="vnosVrstice.php" autocomplete="off"> 
<fieldset class="novBolnik" id="prva">
    <legend id="novBLegend">Nov bolnik</legend>
    <h2 id="lab6"> </h2>
	<input id="bolnikId" type = "hidden" name = "bolnikId" value = "" readonly >
    <label for="ime">Ime:</label>  
    <input id="ime" type="text" name="ime" pattern="[A-Za-zŽžšŠđĐćĆčČ]{1,}" required><br>    
    <label for="priimek">Priimek:</label>
    <input id="priimek" type="text" name="priimek" pattern="[A-Za-zŽžšŠđĐćĆčČ]{1,}" required><br>     
    <label for="dan">Datum rojstva:</label>
    <input id="dan" type="text"   list="dnevi"  name="dan" size="1" maxlength="2"  onfocus="stevilkaFunction(32, 'dan', 'dnevi')"  onkeyup="starostFunction()" required > . 
    <datalist id="dnevi">
    <option value='dan Meseca'>
    </datalist>
   <input id="mesec" type="text"   list="meseci"  name="mesec" size="1" maxlength="2"  onfocus="stevilkaFunction(13, 'mesec', 'meseci')"  onkeyup="starostFunction()" required >  
    <datalist id="meseci">
    <option value='mesec leta'>
    </datalist>
    <input id="leto"type="text" name="leto" size="2" maxlength="4" required onkeyup="starostFunction()" ><br>
<input id="ustanova"  type = "hidden" name="ustanova"     <input id="datRojstva" type = "hidden" name = "datRojstva" readonly >   
    <label for="stevMaticna">Matična številka:</label>
    <input id="stevMaticna"type="text" name="stevMaticna" pattern="[0-9]{1,}" required onkeypress=" return isNumber(event, allNumb)"/><br>
    <input id="EMSO"  type = "hidden" name="EMSO"pattern="[0-9]{1,}" placeholder="pusti prazno" onkeypress=" return isNumber(event, allNumb)"/ >  
	  <!--  <label for="EMSO">EMŠO:</label>
    <input id="EMSO" type="text" name="EMSO"pattern="[0-9]{1,}" placeholder="pusti prazno" onkeypress=" return isNumber(event, allNumb)"/ >  -->
    <input id="datRojstva" type = "hidden" name = "datRojstva" readonly  >   
    <input id="datPregleda" type = "hidden" name = "datPregleda" readonly  >
    <br>
    <br>  
    <button class="naprej" id="naprej" ime = naprej  onclick = "return osebniFunction()"><b>Naprej</b></button> 
 </fieldset>  
<!-- ______________________________________________________________________________________

...........................Drugi del formularja................................-->

 <div class="glavna" id="druga">
	<h3 id="osebni"> osebni</h3>
 <fieldset class="zacetek">
    <legend></legend>      
 <label>Za oddelek:<input id="zaOdd" list="oddelek" name="oddelek"required></label>  
  <datalist id="oddelek">
    <option value="Kirurgija">
    <option value="ginekologija">
    <option value="urologija">
    <option value="ORL">
    <option value="RTG">
	<option value="interna">
  </datalist>
    <label for="imeZdravnika">Zdravnik: <input id="imeZdravnika" type="text" name="imeZdravnika" readonly tabindex="-1"></label>
    <br> 
 </fieldset>
 <fieldset class="diagnoze">
    <legend></legend>
	<label for="dgOperativna" >Operativna diagnoza:</label>
	<input id="dgOperativna" type="text" name="dgOperativna" required>
    <br>  
	<label for="opNacrtovana">Načrtovana operacija:</label>  
    <input id="opNacrtovana"  type="text" name="opNacrtovana" required >
 </fieldset>
 <fieldset class="meritve">
    <legend></legend>	
    <label for="starost">Starost:<input  id="starost" type="text" name="starost" size="1" readonly tabindex="-1"></label>      
    <label for = "teza">Teža:<input id = "teza" type = "text" name = "teza" onkeyup="bmiFunction()" required>kg</label>
    <label for = "visina">Višina:<input id = "visina" type = "text" name = "visina" size="1" onkeyup="bmiFunction()" required>m</label> 
    <label for = "bmi">BMI: <input id = "bmi" type = "text" name = "bmi" id = "bmi" onclick = "bmiFunction()" readonly tabindex="-1"></label>  
    <label for = "krTlak">krvni tlak:<input id = "krTlak" type="text" name="krvniTlak" size="1" ></label>    
    <label for = "pulz">Pulz:<input id = "pulz" type="text" name="pulz" size="1" ></label> 
	<label for = "spo2">SPO2:<input class="lab osnovne" id = "spo2" type="text" name="spo2" pattern="[0-9]{3}" maxlength="3" size="1"onkeypress=" return isNumber(event, allNumb)"  onfocusout=  "laborFunction(name,value)">%</label>
    <br> 
 </fieldset>
 <fieldset class="labor" id="lab">
<div id="stolpec1">
    <label for="hb">Hb:</label>  
    <input class="lab osnovne"id="hb" type="text" name="hb" size="1" onfocusout=  "laborFunction(name,value)"><br>
    <label for="trombociti">Trombociti:</label>  
    <input class="lab osnovne"id="trombociti" type="text" name="trombociti" size="1" onfocusout=  "laborFunction(name,value)"><br>	
    <label for="ks">KS:</label>  
    <input class="lab osnovne"id="ks"type="text" name="ks" size="1" onfocusout=  "laborFunction(name,value)"> <br>
    <label for="inr">INR:</label>  
    <input class="lab osnovne"id="inr" type="text" name="inr" size="1" onfocusout=  "laborFunction(name,value)"><br> 
    <label for="aptc">APTČ:</label>  
    <input class="lab osnovne"id="aptc" type="text" name="aptc" size="1" onfocusout=  "laborFunction(name,value)"><br>
    <label for="kreatinin">Kreatinin:</label>  
    <input class="lab osnovne"id="kreatinin" type="text" name="kreatinin" size="1" onfocusout=  "laborFunction(name,value)"><br> 
   </div>
<div id="stolpec2">
    <label for="laktat">laktat:</label>  
    <input class="lab osnovne"id="laktat" type="text" name="laktat" size="1" onfocusout=  "laborFunction(name,value)"><br>
    <label for="pbnp">P-BNP:</label>  
    <input class="lab osnovne"id="pbnp" type="text" name="pbnp" size="1" onfocusout=  "laborFunction(name,value)"><br>
    <label for="pct">PCT:</label>  
    <input class="lab osnovne"id="pct" type="text" name="pct" size="1" onfocusout=  "laborFunction(name,value)"><br>
    <label for="crp">CRP:</label>  
    <input class="lab osnovne"id="crp" type="text" name="crp" size="1" onfocusout=  "laborFunction(name,value)"><br>
    <label for="na">Na:</label>  
    <input class="lab osnovne"id="na" type="text" name="na" size="1" onfocusout=  "laborFunction(name,value)"><br>
    <label for="k">K:</label>  
    <input class="lab osnovne"id="k" type="text" name="k" size="1" onfocusout=  "laborFunction(name,value)"><br>
</div>
<div id="stolpec3">
  <!--  Drugi izvidi<br>	-->
	<label for="drugiIzvidi"></label> 
    <textarea class="lab"id="drugiIzvidi"  rows="7" cols="30"  name="drugiIzvidi" placeholder="Drugi izvidi" ></textarea><br> 		
</div>
 </fieldset> 
     <legend></legend>
    <label for="ekg">EKG:</label>  
    <textarea id="ekg" class="mala" rows="1" cols="200"  name="ekg" ></textarea><br> 
    <label for="rtg">RTG:</label>  
    <textarea id="rtg" class="mala" rows="1" cols="200"   name="rtg" ></textarea><br> 
    <label for="dgPridruzene">Pridružene bolezni:</label><br>  
    <textarea id= "dgPridruzene" class="mala" rows="4" cols="200" name="dgPridruzene"></textarea><br>
    <label for="terPredhodna">Predhodna terapija:</label><br>   
    <textarea id="terPredhodna" class="mala" rows="4" cols="200" name="terPredhodna"></textarea>
 <fieldset id= "asamal" >
    <legend></legend>
     <label class="zacetekAsa">ASA:
	 <input id="asa" class="ocena" type="text"  list="ase"  name="asa" size="1" maxlength="1"   onfocus="stevilkaFunction(6, 'asa', 'ase')"  onkeypress=" return isNumber(event, asaVar)" onfocusout=  "laborFunction(name,value)" />
	 </label>  
	 <datalist id="ase">
     <option value='st asa'>
     </datalist>
	 
	 <label class="zacetekAsa">Mallampati:
	 <input id="mallampati" class="ocena" type="text"   list="mally"  name="mallampati" size="1" maxlength="1"  onfocus="stevilkaFunction(5, 'mallampati', 'mally')"  onkeypress=" return isNumber(event, mallampatiVar)" onfocusout=  "laborFunction(name,value)" />
	 </label> 
     <datalist id="mally">
     <option value='st mall'>
     </datalist>
	 
	 <!-- odvisnosti-->
	 <!-- opiati-->
	 <label class="zacetekAsa" >Opiati:
	 <input id="opiati" class="ocenaOvisnosti" value="NE" type="text" list="opiatiList" name="opiati" size="2" maxlength="2" onkeypress=" return isNumber(event, opiatiVar)"  onfocusout=  "laborFunction(name,value)"required /> 
	 </label>
	 <datalist id="opiatiList">
     <option value="NE" >
	 <option value="DA">
     </datalist>

	 <!-- druge odvisnosti-->
	 <label class="zacetekAsa">Druge odvisnosti:
	 <input id="dovisnosti" class="ocenaOvisnosti" type="text" list="dovisnostiList" name="dovisnosti" size="2" maxlength="2" onkeypress=" return isNumber(event, dovisnostiVar)" onfocusout=  "laborFunction(name,value)">
	 </input>
	 </label> 
	 <datalist id="dovisnostiList">	 
     <option value="">	 
     <option value="NE">
	 <option value="DA">
     </datalist>	 

	 <!-- .....Konec odvisnosti..............................................-->
     <br><label for="alergija">Alergija:<input id="alergija" type="text" value="ni znano" name="alergija"  ></label>
  </fieldset>
 	<label for="izvidiInOpombe">Izvidi in opombe:</label><br>  
    <textarea id="izvidiInOpombe" class="velka"   rows="4" cols="200"  name="izvidiInOpombe" required></textarea><br>

<label>Sklep:<input id="sklep"  list="sklepi" name="sklep" required></label> 
  <datalist id="sklepi">
   <option value="sklep">
  </datalist>
 <script>
// alert("sklep Json:" + sklepJson);
  var sklepList = JSON.parse(sklepJson);
//alert(sklepList);
  listaSklepovFunction(sklepList);
  </script>
<br><br>
 <fieldset class="zaklucek">premedikacija 
  <div id="zaklucek">
	<label for="premedVecer">Zvečer:..<input id="premedVecer" type="textarea" name="premedVecer" ></label>  
    <br>
	<label for="premedPredOp">Pred op.:<input id="premedPredOp" type="textarea" name="premedPredOp" ></label> <br> 
    <textarea id="navodila" class="mikro"  name="navodila" placeholder="Navodila" rows="3" ></textarea>
   </div>
  </fieldset> 	
 </fieldset>	
</div>
</form>

<!-- ______________________________________________________________________________________

...........................Tretji del TISK................................-->

<div class="celaStran" id="tretja">
  <!--<div id="logo"><img  id="imgBol" src="logoSBI.png"></div>-->
  <div id="logo">
  </div>  
  <script>
    if (!localStorage.getItem("aktivnaBolnisnica") == "") {
//logo = document.getElementById("logo").innerHTML;
//alert (logo);
    boln = localStorage.getItem("aktivnaBolnisnica");
//alert (boln);
    logo = '<img  id="';
    logo = logo + 'imgBol"';
    logo = logo + 'src="loga/logo' + boln + '.png"';
    logo = logo + 'alt=' + boln + '>';
//alert (logo);
    document.getElementById("logo").innerHTML = logo;
  }
   </script>   
<h1>Anesteziološki pregled</h1>
<div id="nalepkaR">nalepka</div> 
<p id="obravnavaR"></p>  
<div class="paragrafi">
<div class="prvigrafi">	
    <p id="diagnozaR">op.diagnoza</p>
    <p id="operacijaR">predvidevana op.</p>
    <p id="meritveR">meritve</p>
    <p id="labR">lab</p>
  <div class="asmalR">
    <span style="padding-left:1px;">ASA: </span>
    <span id="asaR" class="kvadrat" >.</span>
    <span style="padding-left:10px;">Mallampati:</span> 
    <span id="mallR" class="kvadrat" >.</span> 
	
    <span style="padding-left:10px;">Opiati:</span> 
    <span id="opiaR" class="kvadrat" >.</span>
	
	    <span id="dovisnostiLabelR"style="padding-left:10px;">Druge odvisnosti:</span>
	    <span id="dovisnostiR" class="kvadrat" >.</span>
	

  </div>
  <b><span style="font-size:120%;">Alergija:</span> <span id="alergijaR" style= "font-size:120%;"></span></b>
 </div>
  <div class="velka" id="izvidiR">Izvidi in opombe</div>
</div> 
   <div id="premedikacijaR"><i>premedikacija</i></div>
   <div id="zdravnikR">zdravnik</div>
   <div id="navodilaR">navodila</div>
</div>

<!-- ______________________________________________________________________________________

...........................Četrti del PRENOS................................-->

<div class="celaStran" id="cetrta">
<button class="desno" onclick="ogledFunction()">X</button> 
<p class="levo" id="obravnavaPr"></p>
<p class="levo" id="nalepkaPr">nalepka</p> 
<p class="levo" id="diagnozaPr">op.diagnoza</p>
<p class="levo" id="operacijaPr">predvidevana op.</p>
<p class="levo" id="meritvePr">meritve</p>
<p class="levo" id="labPr">lab</p>
<p class="levo" class="asmalPr">
    <span style="padding-left:1px;">ASA: </span>
    <span id="asaPr" class="kvadrat" >.</span>
    <span style="padding-left:10px;">Mallampati:</span> 
    <span id="mallPr" class="kvadrat" >.</span> 
    <span style="padding-left:10px;">Opiati:</span> 
    <span id="opiaPr" class="kvadrat" >.</span>
	<span id="dovisnostiLabelPr"style="padding-left:10px;">Druge odvisnosti:</span>
	<span id="dovisnostiPr" class="kvadrat" >.</span>
</p>
<p class="levo"><b><span style="font-size:120%;">Alergija:</span> <span id="alergijaPr" style= "font-size:120%;"></span></b>
 </p>
  <p class="levo" class="velka" id="izvidiPr">Izvidi in opombe</p>
</p> 
   <p class="levo" ><span class="nadpis">Premedikacija: </span><span id="premedikacijaPr"></span></p>  
   <p class="levo" id="navodilaPr">navodila</p>
   <p class="levo" id="zdravnikPr">zdravnik</p>

</div>