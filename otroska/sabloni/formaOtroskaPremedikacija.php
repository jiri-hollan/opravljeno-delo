
<div id='doziranje'  class='modal'>
<form id='otroskaFrm' class="modal-content animate" name='otroskaForma' method='post' action='bolnik.php' autocomplete='off'> 
  <input type='radio' id='midazolamId' class='ucinkovina' name='ucinkovina' value='midazolam'>
 <label for='midazolamId'>midazolam</label><br>
  <input type='radio' id='deksmedetomidinId' class='ucinkovina' name='ucinkovina' value='deksmedetomidin'>
 <label for='deksmedetomidinId'>deksmedetomidin</label><br>
<label for='tezaPremedikacijaId'><b>Teža</b></label><br>
<input id='tezaPremedikacijaId' class='udaje' type = 'text' name='teza' value='1' readonly>
<button type='submit'  class="potrdiBtn" name='submit'>potrdi</button>
</form>
</div>