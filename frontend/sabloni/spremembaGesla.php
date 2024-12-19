<?php require_once('vkladane/zahlavi.php');?>

 <form autocomplete="off" action="<?php echo $_SERVER['PHP_SELF'] . '?r=spremembaG'?>"  method="post">
   <div class="containerGeslo">
   <h2>Sprememba gesla</h2>
      <!--<label for="sGeslo"><b>Staro geslo</b></label>-->
      <input type="password" placeholder="Staro geslo" name="sGeslo" autocomplete="off" required>
	  <br> 
	  <!--<label for="geslo"><b>Novo geslo</b></label>-->
      <input type="password" placeholder="Novo geslo" name="geslo" autocomplete="off" pattern="(?=.*\d)(?=.*[a-z]).{8,}" title="Mora vsebovati vsaj številke in male črke skupaj najmanj 8 znakov" required>
      <br> 
      <!--<label for="psw-repeat"><b>Ponovi geslo</b></label>-->
      <input type="password" placeholder="Ponovi geslo" name="psw-repeat" autocomplete="off" required>
	  <br>
	  <button type="submit" class="signupbtn" >Spremeni</button> 
   </div>
</form>
<form autocomplete="off" action="<?php echo $_SERVER['PHP_SELF'] . '?r=spremembaU'?>"  method="post">
   <div class="containerGeslo">
   <h2>Sprememba uporabniškega imena</h2>
      <!--<label for="sGeslo"><b>Staro geslo</b></label>-->
      <input type="text" placeholder="Staro uname" name="sUname" autocomplete="off" required>
	  <br> 
	  <!--<label for="geslo"><b>Novo geslo</b></label>-->
      <input type="text" placeholder="Novo uname" name="uname" autocomplete="off"  required>
      <br> 
      <!--<label for="unm-repeat"><b>Ponovi geslo</b></label>-->
      <input type="text" placeholder="Ponovi uname" name="unm-repeat" autocomplete="off" required>
	  <br>
	  <button type="submit" class="signupbtn" >Spremeni</button> 
   </div>
</form>