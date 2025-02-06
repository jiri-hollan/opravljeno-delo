let tabulka;
function izborFunction(akce, tabulka) {
document.getElementById("akceId").value = akce;
switch(akce) {
  case "vyber":
// omogoči izbiro bolnišnice 	
  document.getElementById("demo").innerHTML = '<input id="bolnisnicaId" list="bolnisnice" name="bolnisnica" value="" placeholder="Bolnišnica" onfocusout="bolnisnicaFunction()" autocomplete="off"><datalist id="bolnisnice"><option value="izbrana bolnisnica"> </datalist>';
  const bolList  =["Izola","Jesenice",];
  let text = "";
  let i;
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
   return document.getElementById("osebe").addEventListener("click", functionOver);
      }
} else {
  text = "You canceled!";
}
    break;	
  default:
    // code block
 }//od switch

//----------------------------------------------------------------------------------------

function functionOver (e) {
 x = e.target;
if (x.nodeName == "TD") {
 y = event.composedPath()[1];
row_value = y.cells[0].innerHTML;
//alert("x= "+x.innerHTML+" row value= "+row_value);
  document.getElementById("demo3").innerHTML = "id v bazi je= " + row_value ; 
//return;
//alert(tabulka);  
  window.location.href = "manipulaceObjektUniverzal.php?akce=" + x.innerHTML + "&id=" + row_value + "&tabulka=" + tabulka;  
 }//od if 
}//od function(e)
} // od izborFunction