<?php
$uname = !empty($_SESSION["uname"]) ? $_SESSION["uname"] : "";
echo'
<script>	
if("'.$uname.'"==""){
	document.getElementById("uname").innerHTML = "niste prijavljeni ";	
}else{
	document.getElementById("uname").innerHTML = "prijavljen je: " + " " + "'.$uname.'";
	}
</script>
';
?>