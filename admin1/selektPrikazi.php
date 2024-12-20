
<?php
require_once '../skupne/sabloni/zahlavi.php';
echo '
<p>vnesi ime tabele and click OK:</p>

<form method="post" action="../skupne/ogledTabele.php">
Ime table: 
<input type="text" name="imeTable">
<input type="hidden" name="nazaj" value='. $nazaj.'>
<input type="submit" name="submit" value="submit">  
</form>
';
require_once '../skupne/sabloni/zapati.php';
?>