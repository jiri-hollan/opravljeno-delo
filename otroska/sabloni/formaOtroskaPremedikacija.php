<script>
function otroskaFunction(){
	   let teza = document. getElementById('teza').value;
		//alert(teza);
		//document.getElementById('tezaPremedikacijaId').setAttribute("value",teza);
		document.getElementById('tezaPremedikacijaId').value=teza;		
}  
</script>
<div id='doziranje'  class='modal'>
<form id='otroskaFrm' class="modal-content animate" name='otroskaForma' method='post' action='otroskaPremedikacija.php' autocomplete='off'> 
  <input type='radio' id='midazolamId' class='ucinkovina' name='ucinkovina' value='midazolam'>
 <label for='midazolamId'>midazolam</label><br>
  <input type='radio' id='deksmedetomidinId' class='ucinkovina' name='ucinkovina' value='deksmedetomidin'>
 <label for='deksmedetomidinId'>deksmedetomidin</label><br>
<input id='tezaPremedikacijaId' type = 'text' name='teza' value='1'>
<button type='submit'  class="signupbtn" name='submit'>potrdi</button>
</form>
</div>
<script>
otroskaFunction();
</script>