<?php require_once('vkladane/zahlavi.php');?>

<button class="knof" onclick="schovej('id01')"style="width:auto;">Registracija</button>
<button class="knof" onclick="schovej('id02')" style="width:auto;">Prijava</button>

<!-- ---------------------------------Registracija------------------------------------------------------- --> 
<div id="id01" class="modal">
  <form class="modal-content animate" autocomplete="off" action="<?php echo $_SERVER['PHP_SELF'] . '?r=singin'?>" method="post">
    <div class="container">
      <h1>Registracija</h1>
      <label for="bolnisnicaId"><b>Bolnisnica, ime in priimek</b></label><br>
	  <span>
      <input id="bolnisnicaId" type="text" class="imePriimek" placeholder=" Bolnisnica" name="bolnisnica" required>	 	  
      <input type="text" class="imePriimek" placeholder=" Ime" name="ime" required>	  
      <input type="text" class="imePriimek" placeholder="Priimek" name="priimek" required><br>	  
	  </span>
	  <label for="emailId"><b>email</b></label>
      <input id="emailId" type="text" placeholder=" Email je potreben" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Ni veljaven email naslov"  autocomplete="off" required>
	  
      <label for="unameId"><b>uname</b></label>
      <input id="unameId" type="text" placeholder=" Uporabniško ime" name="uname" autocomplete="off" required>

      <label for="gesloId"><b>Geslo</b></label>
      <input id="gesloId" type="password" placeholder="geslo" name="geslo" autocomplete="off" pattern="(?=.*\d)(?=.*[a-z]).{8,}" title="Mora vsebovati vsaj številke in male črke skupaj najmanj 8 znakov" required>

      <label for="pswRepeatId"><b>Ponovi geslo</b></label>
      <input id="pswRepeatId" type="password" placeholder="Ponovi geslo" name="psw-repeat" autocomplete="off" required>
      <button type="submit" class="signupbtn">Sign Up</button>    
      <div class="clearfix">
        <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
      </div>
    </div>
 

  </form>
</div>



<!-- ___________________________   Prijava       ___________________________________________-->
<div id="id02" class="modal">
  
  <form class="modal-content animate" action="<?php echo $_SERVER['PHP_SELF'] . '?r=login'?>" method="post" autocomplete="off">
    

    <div class="container">
      <label for="uname1Id"><b>Uporabniško ime</b></label>
      <input id="uname1Id" type="text" placeholder="Enter Username" name="uname" autocomplete="off" required>

      <label for="geslo1Id"><b>Password</b></label>
      <input id="geslo1Id" type="password" placeholder="Enter Password" name="geslo" autocomplete="off" required>
        
      <button type="submit" class="signupbtn" >Login</button>
 <!--     <label>
        <input type="checkbox" checked="checked" name="remember"> Remember me
      </label>-->
	      <div class="clearfix">
      <button type="button" onclick="document.getElementById('id02').style.display='none'" class="cancelbtn">Cancel</button>
   <!--   <span class="psw">Forgot <a href="#">password?</a></span>-->
    </div>     
    </div>



  </form>
</div>

<?php require_once('vkladane/zapati.php'); ?>