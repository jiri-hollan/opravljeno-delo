var tabulka="pregledovalciTbl";
function izborFunction(akce, tabulka) {
	var tabulka=tabulka;
	//alert(tabulka);
  document.getElementById("akceId").value = akce;
switch(akce) {
  case "vyber":
// omogoči izbiro bolnišnice 	
 document.getElementById("demo").innerHTML = '<input id="bolnisnicaId" list="bolnisnice" name="bolnisnica" value="" placeholder="Bolnišnica" onfocusout="bolnisnicaFunction()" autocomplete="off"><datalist id="bolnisnice"><option value="izbrana bolnisnica"> </datalist>';
	var bolList  =[
	"Izola",
	"Jesenice",
	];
	var text = "";
var i;
for (i = 0; i < bolList.length; i++) {
 // text += "<option value=" +  zdravList[i] + ">"+"<br>";
  text += "<option value='" +  bolList[i] + "'>"  +"<br>";
}
  document.getElementById("bolnisnice").innerHTML = text;
  document.getElementById("tabSent").innerHTML = '<input type="hidden" name="tabulka" value="'+tabulka+'">';
  document.getElementById("posli").innerHTML = '<input class="submit" type="submit" name="submit" value="potrdi">'; //submit
    break; 

  case "vloz":
    bolnisnica= '<input type="text" id="bolnisnicaId" name="bolnisnica" value="" placeholder="Bolnišnica" required>';
    ime= '<input type="text" id="imeId" name="ime" value="" placeholder="ime" required>';
    priimek= '<input type="text" id="priimekId" name="priimek" value="" placeholder="priimek" required>';
    pregledovalciStatus= '<input type="int" id="pregledovalciStatusId" name="pregledovalciStatus" value="" placeholder="pregledovalciStatus" required>';
    document.getElementById("demo").innerHTML = bolnisnica + ime + priimek + pregledovalciStatus;
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
  window.location.href = "manipulaceObjektUniverzal.php?akce=" + x.innerHTML + "&id=" + row_value + "&tabulka="+ tabulka; 
}//od function(e)