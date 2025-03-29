<?php
echo"
<form id='otroskaFrm' name='otroskaForma' method='post' action='otroskaPremedikacija.php' autocomplete='off'> 
  <input type='radio' id='midazolamId' name='ucinkovina' value='midazolam'>
 <label for='midazolamId'>midazolam</label><br>
  <input type='radio' id='medetomidinId' name='ucinkovina' value='medetomidin'>
 <label for='medetomidinId'>medetomidin</label><br>
<input type='submit' value='izberi' name='submit'>
</form>
";
?>