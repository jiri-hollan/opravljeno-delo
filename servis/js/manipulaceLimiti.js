var tabulka="limitiTbl";
function izborFunction(akce) {
  document.getElementById("akceId").value = akce;
switch(akce) {
  case "vyber":
// omogoči izbiro bolnišnice 	
  document.getElementById("demo").innerHTML = '<input id="bolnisnicaId" list="bolnisnice" name="bolnisnica" value="" placeholder="Bolnišnica" onfocusout="bolnisnicaFunction()" autocomplete="off"><datalist id="bolnisnice"><option value="izbrana bolnisnica"> </datalist>';
  var bolList  =["Izola","Jesenice",];
  var text = "";
  var i;
  for (i = 0; i < bolList.length; i++) {
   text += "<option value='" +  bolList[i] + "'>"  +"<br>";
}//od for
  document.getElementById("bolnisnice").innerHTML = text;
  document.getElementById("tabSent").innerHTML = '<input type="hidden" name="tabulka" value="'+tabulka+'">';
  document.getElementById("posli").innerHTML = '<input class="submit" type="submit" name="submit" value="potrdi">'; //submit
    break; 

  case "vloz":
    bolnisnica= '<input type="text" id="bolnisnicaId" name="bolnisnica" value="" placeholder="Bolnišnica" required>'; 
    skupina= '<input type="text" id="skupinaId" name="skupina" value="" placeholder="skupina" required>';
    ime= '<input type="int" id="imeId" name="ime" value="" placeholder="ime" required>';
    min= '<input type="int" id="minId" name="min" value="" placeholder="min" required>';
    max= '<input type="int" id="maxId" name="max" value="" placeholder="max" required>';
    document.getElementById("demo").innerHTML = bolnisnica + skupina + ime + min + max;
	document.getElementById("tabSent").innerHTML =  '<input type="hidden" name="tabulka" value="'+tabulka+'">';
	document.getElementById("posli").innerHTML = '<input class="submit" type="submit" name="submit" value="potrdi"><input type="reset" name="reset" value="Reset">'; //submit+reset
    break;

  case "edit":
//alert("v JS case edit");
   if(document.getElementById("osebe")!=null){
   document.getElementById("osebe").addEventListener("click", functionOver);
}
    break;

  case "odstrani": 
  if ( confirm("Odstranim en zapis?") == true) {
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
 window.location.href = "manipulaceObjektUniverzal.php?akce=" + x.innerHTML + "&id=" + row_value+ "&tabulka="+ tabulka;  
}//od function(e)