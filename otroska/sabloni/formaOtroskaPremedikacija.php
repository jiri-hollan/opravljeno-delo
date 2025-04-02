
<div id='doziranje'  class='modal'>
<form id='otroskaFrm' class="modal-content animate" name='otroskaForma' method='post' action='bolnik.php' autocomplete='off'> 
  <div class="container">
      <h2>Otroška premedikacija</h2>
      <input type='radio' id='midazolamId' class='ucinkovina' name='ucinkovina' value='midazolam'>
	   <label for='midazolamId'>midazolam</label><br>
      <input type='radio' id='deksmedetomidinId' class='ucinkovina' name='ucinkovina' value='deksmedetomidin'>
       <label for='deksmedetomidinId'>deksmedetomidin</label><br>
      <label for='tezaPremedikacijaId'><b>Teža</b></label><br>
      <input id='tezaPremedikacijaId' class='udaje' type = 'text' name='teza' value='1' readonly>
	  <br><br><br>
      <button type='submit'  class="potrdiBtn" name='submit'>potrdi</button>
      <div class="clearfix">
        <button type="button" onclick="document.getElementById('doziranje').style.display='none'" class="cancelbtn">zapri</button>
      </div>
  </div><!--container-->
</form>
</div>