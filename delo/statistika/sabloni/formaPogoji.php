<?php
echo'<script src="../js/statistika.js?'.time().'"></script>';
echo '
<label for "zacDatum">od</label>
<input id="zacDatum" type="date" name="datumVpisa>=" value="'.date("Y-m-d").'" >
<label for "koncDatum">do</label>
<input id="koncDatum" type="date" name="datumVpisa<=" value="'.date("Y-m-d").'" >
<label for="opraviloId">vrsta opravila: </label>
<input id="opraviloId" value="" name="opravilo" required autocomplete="off">
<select id="opravilaId"   onchange="myFunction()"><option>opravilo</select>


';
?>