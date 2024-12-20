function izborFunction(akce) {
  document.getElementById("akceId").value = akce;
switch(akce) {
  case "vyber":
    document.getElementById("demo").innerHTML = '<input type="text" id="bolnisnicaId" name="bolnisnica" value="izola" placeholder="bolnisnica">';// omogoči izbiro bolnišnice
	document.getElementById("posli").innerHTML = '<input type="submit" name="submit" value="Submit">'; //submit
    break; 

  case "vloz":
    bolnisnica= '<input type="text" id="bolnisnicaId" name="bolnisnica" value="" placeholder="bolnišnica" required>';
    skupina= '<input type="text" id="skupinaId" name="skupina" value="" placeholder="skupina" required>';
    ime= '<input type="text" id="imeId" name="ime" value="" placeholder="ime" required>';
    min= '<input type="text" id="minId" name="min" value="" placeholder="min" required>';
    max= '<input type="int" id="maxId" name="max" value="" placeholder="max" required>';
    document.getElementById("demo").innerHTML = bolnisnica + skupina + ime + min + max;
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
 window.location.href = "manipulaceLimiti.php?akce=" + x.innerHTML + "&id=" + row_value;  
}//od function(e)