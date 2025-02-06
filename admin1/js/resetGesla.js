function izborFunction(akce) {
  document.getElementById("akceId").value = akce;
switch(akce) {
  case "vyber":
    document.getElementById("demo").innerHTML = '<input type="text" id="mestoId" name="mesto" value="" placeholder="Bolnišnica">';// omogoči izbiro bolnišnice
	document.getElementById("posli").innerHTML = '<input type="submit" name="submit" value="Submit">'; //submit
    break; 

  case "vloz":
    mesto= '<input type="text" id="mestoId" name="mesto" value="" placeholder="Mesto" required>';
    nazivB= '<input type="text" id="nazivBId" name="nazivB" value="" placeholder="nazivB" required>';
    bolnisnicaStatus= '<input type="int" id="statusId" name="bolnisnicaStatus" value="" placeholder="bolnisnicaStatus" required>';
    document.getElementById("demo").innerHTML = mesto + nazivB + bolnisnicaStatus;
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
 window.location.href = "manipulaceBolnisnice.php?akce=" + x.innerHTML + "&id=" + row_value;  
}//od function(e)