<script>

function otroskaFunction(){
	   let teza = document. getElementById('teza').value;
		//alert(teza);
		//document.getElementById('tezaPremedikacijaId').setAttribute("value",teza);
		document.getElementById('tezaPremedikacijaId').value=teza;		
}
</script>
<?php

echo"
<form id='otroskaFrm' name='otroskaForma' method='post' action='otroskaPremedikacija.php' autocomplete='off'> 
  <input type='radio' id='midazolamId' name='ucinkovina' value='midazolam'>
 <label for='midazolamId'>midazolam</label><br>
  <input type='radio' id='deksmedetomidinId' name='ucinkovina' value='deksmedetomidin'>
 <label for='deksmedetomidinId'>deksmedetomidin</label><br>
<input id='tezaPremedikacijaId' type = 'text' name='teza' value='1'>
<input type='submit' value='izberi' name='submit'>
</form>
";
?>
<script>
otroskaFunction();
</script>