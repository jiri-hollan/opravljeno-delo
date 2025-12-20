
<div id='doziranje' >
<form id='otroskaFrm'  name='otroskaForma' method='post' action='premedikacija.php' autocomplete='off'> 
  <div class="container">
  	 <!-- <button type="button" onclick="document.getElementById('doziranje').style.display='none'"class="close" title="zapri">&times;</button>-->
      <h3>Otroška premedikacija</h3>
      <input  onclick='ajax_get_premedikacija(this);' type='radio' id='midazolamId' class='ucinkovina' name='ucinkovina' value='midazolam'>
	   <label for='midazolamId'>midazolam</label><br>
      <input  onclick='ajax_get_premedikacija(this);' type='radio' id='dexmedetomidinId' class='ucinkovina' name='ucinkovina' value='dexmedetomidin'>
       <label for='dexmedetomidinId'>dexmedetomidin</label><br>
      <input  onclick='ajax_get_premedikacija(this);' type='radio' id='ketaminId' class='ucinkovina' name='ucinkovina' value='ketamin'>
       <label for='ketaminId'>ketamin</label><br>	  
      <label for='tezaPremedikacijaId'><b>Teža: </b></label>
      <input onchange="ajax_sprememba();" id='tezaPremedikacijaId' class='udaje' type = 'text' name='teza' value='2'  size="1" maxlength="4">kg
	  <br>
	  <label for="sprememba">Sprememba doze: <span id="faktorId"></span></label>
	  <input onchange="ajax_sprememba();" type="range" id="sprememba" name="sprememba" min="0.5" max="2" step="0.1" value="1" list="tickmarks">
	  <datalist id="tickmarks">
		<option value="0.5"></option>
		<option value="1"></option>
		<option value="1.5"></option>
		<option value="2"></option>

	 </datalist>
      <!--<button type='submit'  class="potrdiBtn" name='submit'>potrdi</button>-->
      <div class="clearfix">
       <!-- <button type="button" onclick="document.getElementById('doziranje').style.display='none'" class="cancelbtn">zapri</button>-->
      </div>
  </div><!--container-->
</form>
</div>
<script>
var slider = document.getElementById("sprememba");
var output = document.getElementById("faktorId");
output.innerHTML = slider.value;

slider.oninput = function() {
  output.innerHTML = this.value;
}
</script>