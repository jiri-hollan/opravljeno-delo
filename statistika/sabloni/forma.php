<?php
echo'
<form method="post" action="'.htmlspecialchars($_SERVER["PHP_SELF"]).'">
<input type="hidden" id="akceId" name="akce" value="">
<p id="pogojId"></p>
<p id="posli"></p>
</form>
<p id="demo3"></p>
';
?>