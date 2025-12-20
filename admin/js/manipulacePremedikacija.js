function izborFunction(akce) {
  document.getElementById("akceId").value = akce;
switch(akce) {
  case "vyber":
    //document.getElementById("demo").innerHTML = '<input type="text" id="bolnisnicaId" name="bolnisnica" value="" placeholder="Bolnišnica">';// omogoči izbiro bolnišnice
	document.getElementById("posli").innerHTML = '<input type="submit" name="submit" value="Submit">'; //submit
    break; 

/*
	"ucinkovina"; "teza", "doza", "koncentracija", "navodila", "dexmedetomidinDoza"
	
	*/


  case "vloz":
    //bolnisnica= '<input type="text" id="bolnisnicaId" name="bolnisnica" value="" placeholder="Bolnišnica" required>';
	ucinkovina= '<input type="text" id="ucinkovina" name="ucinkovina" value="" placeholder="ucinkovina" required>';
    teza= '<input type="int" id="sifraId" name="teza" value="" placeholder="teza" required>';	
    doza= '<input type="text" id="dozaId" name="doza" value="" placeholder="Doza" required>';
	
	koncentracija= '<input type="text" id="koncentracijaId" name="koncentracija" value="" placeholder="Koncentracija" required>';
	
    navodila= '<input type="text" id="navodilaId" name="navodila" value="" placeholder="Navodila" required>';


    document.getElementById("demo").innerHTML = ucinkovina + teza + doza + koncentracija + navodila;
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
 window.location.href = "manipulacepremedikacija.php?akce=" + x.innerHTML + "&id=" + row_value;  
}//od function(e)