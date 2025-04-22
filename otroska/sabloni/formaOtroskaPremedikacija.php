
<div id='doziranje'  class='modal'>
<form id='otroskaFrm' class="modal-content animate" name='otroskaForma' method='post' action='bolnik.php' autocomplete='off'> 
  <div class="container">
  	  <button type="button" onclick="document.getElementById('doziranje').style.display='none'"class="close" title="zapri">&times;</button>
      <h3>Otroška premedikacija</h3>
      <input  onclick='ajax_get_premedikacija(this);' type='radio' id='midazolamId' class='ucinkovina' name='ucinkovina' value='midazolam'>
	   <label for='midazolamId'>midazolam</label><br>
      <input  onclick='ajax_get_premedikacija(this);' type='radio' id='dexmedetomidinId' class='ucinkovina' name='ucinkovina' value='dexmedetomidin'>
       <label for='dexmedetomidinId'>dexmedetomidin</label><br>
      <input  onclick='ajax_get_premedikacija(this);' type='radio' id='ketaminId' class='ucinkovina' name='ucinkovina' value='ketamin'>
       <label for='ketaminId'>ketamin</label><br>	  
      <!--<label for='tezaPremedikacijaId'><b>Teža je hidden</b></label><br>-->
      <input id='tezaPremedikacijaId' class='udaje' type = 'hidden' name='teza' value='1' hidden readonly>
	  <br>
      <!--<button type='submit'  class="potrdiBtn" name='submit'>potrdi</button>-->
      <div class="clearfix">
       <!-- <button type="button" onclick="document.getElementById('doziranje').style.display='none'" class="cancelbtn">zapri</button>-->
      </div>
  </div><!--container-->
</form>


</div>