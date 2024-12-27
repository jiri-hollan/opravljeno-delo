
<form id="izkazFrm" name="izkazForma" method="post" action="vnosVrstice.php" autocomplete="off"> 
<fieldset class="prikazDela" id="prikaz">
    <h2><legend id="novZapisLegend">prikaz dela</legend> </h2>
	<label for="ustanova">Ustanova</label>
	<input id="ustanova"  type = "text" name="ustanova" pattern="[A-Za-zŽžšŠđĐćĆčČ]{1,}" required><br> 
	<label for="stevZdravnika">Številka zdravnika:</label>
    <input id="stevZdravnika"type="text" name="stevZdravnika" pattern="[0-9]{1,}" required onkeypress=" return isNumber(event, allNumb)"/>
    <label for="ime">Ime:</label>  
    <input id="ime" type="text" name="ime" pattern="[A-Za-zŽžšŠđĐćĆčČ]{1,}" required>    
    <label for="priimek">Priimek:</label>
    <input id="priimek" type="text" name="priimek" pattern="[A-Za-zŽžšŠđĐćĆčČ]{1,}" required><br>     
   
    <label>Delo:<input id="delo"  list="dela" name="delo" required></label> 
  <datalist id="dela">
   <option value="delo">
  </datalist>
 <script>
// alert("delo Json:" + deloJson);
  var deloList = JSON.parse(deloJson);
//alert(deloList);
  listadeloovFunction(deloList);
  </script>

    <br>
    <br>  
    <button class="naprej" id="naprej" ime = naprej  onclick = "return osebniFunction()"><b>Naprej</b></button> 
 </fieldset>  
 </form>
<!-- 