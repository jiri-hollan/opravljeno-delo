if("<?= $identifikace ?>"==""){
	document.getElementById("poPotrebi").innerHTML = "niste prijavljeni ";	
}else{
	document.getElementById("poPotrebi").innerHTML = "prijavljen je: " + " " + "<?= $identifikace ?>";
	}
	document.getElementById("dom").innerHTML = "domov";		