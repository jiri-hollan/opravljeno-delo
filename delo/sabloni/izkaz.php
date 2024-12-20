
<form id="frm" name="izkazForma" method="post" action="vnosVrstice.php" autocomplete="off"> 
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
 </form>
<!-- 