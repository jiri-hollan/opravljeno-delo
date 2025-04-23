function izborFunction(akce) {
  document.getElementById("akceId").value = akce;
switch(akce) {
  case "vyber":
    //document.getElementById("demo").innerHTML = '<input type="text" id="bolnisnicaId" name="bolnisnica" value="" placeholder="Bolnišnica">';// omogoči izbiro bolnišnice
	document.getElementById("posli").innerHTML = '<input type="submit" name="submit" value="Submit">'; //submit
    break; 

/*
	"teza", "midazolamDoza", "midazolamKoncentracija", "midazolamNavodila", "dexmedetomidinDoza", "dexmedetomidinKoncentracija", "dexmedetomidinNavodila", "ketaminDoza", "ketaminKoncentracija", "ketaminNavodila"
	
	*/


  case "vloz":
    //bolnisnica= '<input type="text" id="bolnisnicaId" name="bolnisnica" value="" placeholder="Bolnišnica" required>';
    teza= '<input type="int" id="sifraId" name="teza" value="" placeholder="teza" required>';	
    midazolamDoza= '<input type="text" id="midazolamDozaId" name="midazolamDoza" value="" placeholder="midazolamDoza" required>';
	
	midazolamKoncentracija= '<input type="text" id="midazolamKoncentracijaId" name="midazolamKoncentracija" value="" placeholder="midazolamKoncentracija" required>';
	
    midazolamNavodila= '<input type="text" id="midazolamNavodilaId" name="midazolamNavodila" value="" placeholder="midazolamNavodila" required>';
	
	dexmedetomidinDoza= '<input type="text" id="dexmedetomidinDozaId" name="dexmedetomidinDoza" value="" placeholder="dexmedetomidinDoza" required>';		
	
    dexmedetomidinKoncentracija= '<input type="text" id="dexmedetomidinKoncentracijaId" name="dexmedetomidinKoncentracija" value="" placeholder="dexmedetomidinKoncentracija" required>';
	
	dexmedetomidinNavodila= '<input type="text" id="dexmedetomidinNavodilaId" name="dexmedetomidinNavodila" value="" placeholder="dexmedetomidinNavodila" required>';
	
    ketaminDoza= '<input type="text" id="ketaminDozaId" name="ketaminDoza" value="" placeholder="ketaminDoza" required>';
	
	ketaminKoncentracija= '<input type="text" id="ketaminKoncentracijaId" name="ketaminKoncentracija" value="" placeholder="ketaminKoncentracija" required>';
	
	ketaminNavodila= '<input type="text" id="ketaminNavodilaId" name="ketaminNavodila" value="" placeholder="ketaminNavodila" required>';	

    document.getElementById("demo").innerHTML = teza + midazolamDoza + midazolamKoncentracija + midazolamNavodila + dexmedetomidinDoza + dexmedetomidinKoncentracija + dexmedetomidinNavodila + ketaminDoza + ketaminKoncentracija + ketaminNavodila;
	document.getElementById("posli").innerHTML = '<input type="submit" name="submit" value="Submit"><input type="reset" name="reset" value="Reset">'; //submit+reset
    break;

  case "uredi":
  //alert("v JS case edit");
  if(document.getElementById("osebe")!=null){
 document.getElementById("osebe").addEventListener("click", functionOver);
}
    break;
  case "odstrani":  
  if ( confirm("v funkciji JS odstrani\odstranim en zapis?") == true) {
    if(document.getElementById("osebe")!=null){
    document.getElementById("osebe").addEventListener("click", functionOver);
      }
} else {
  text = "You canceled!";
}
    break;	
  default:
    // code block
 }//od switch
} // od izborFunction
//----------------------------------------------------------------------------------------
function functionOver (e) {
var x = e.target;
if (x.nodeName == "TD") {
var y = event.composedPath()[1];
row_value = y.cells[0].innerHTML;
  document.getElementById("demo3").innerHTML = "id v bazi je= " + row_value ;  
 }//od if 
 window.location.href = "manipulacePremedikacija.php?akce=" + x.innerHTML + "&id=" + row_value;  
}//od function(e)