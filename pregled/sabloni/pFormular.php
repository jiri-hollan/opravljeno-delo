
<!-- ___________________________   Prijava       ___________________________________________-->
<div id="id02" class="modal">
  
 <form class="modal-content animate" action="prihlaseni.php?r=login" method="post" autocomplete="off"> 
    <div class="container">
      <label for="uname1Id"><b>Uporabniško ime</b></label>
      <input id="uname1Id" type="text" placeholder="Enter Username" name="uname" autocomplete="off" required>

      <label for="geslo1Id"><b>Password</b></label>
      <input id="geslo1Id" type="password" placeholder="Enter Password" name="geslo" autocomplete="off" required>        
      <button type="submit" class="signupbtn" >Login</button>
	      <div class="clearfix">
      <button type="button" onclick="document.getElementById('id02').style.display='none'" class="cancelbtn">Cancel</button>
    </div>     
    </div>
  </form>
</div>
