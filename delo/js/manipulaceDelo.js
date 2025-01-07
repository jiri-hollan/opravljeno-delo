	//alert("MANIPULACE DELO JS");
let tabulka="deloTbl";
	//alert(tabulka);
function izborFunction(akce, tabulka) {
	tabulka=tabulka;
	//alert(tabulka);
  document.getElementById("akceId").value = akce;
switch(akce) {
  case "vyber":
// omogoči izbiro bolnišnice

const d = new Date();
let text = d.toISOString();
const actD = text.substr(0, 10);
//alert(actD);
document.getElementById("demo").innerHTML = '<input id="datumVpisaId" type="date" name="datumVpisa" value="'+actD+'" >';
//text = document.getElementById("datumVpisaId").value;
//alert(text);
//document.getElementById("datumVpisaId").value = text;
  document.getElementById("tabSent").innerHTML = '<input type="hidden" name="tabulka" value="'+tabulka+'">';
  document.getElementById("posli").innerHTML = '<input class="submit" type="submit" name="submit" value="potrdi">'; //submit
    break; 

  case "vloz":
 // <a href="../delo/prijavljeniUporabnikObjekt.php?nazaj='.$nazaj.'&akce=novZapis">
    location.replace("../delo/prijavljeniUporabnikObjekt.php?nazaj='.$nazaj.'&akce=novZapis");
   
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
let x = e.target;
if (x.nodeName == "TD") {
let y = event.composedPath()[1];
row_value = y.cells[0].innerHTML;
  document.getElementById("demo3").innerHTML = "id v bazi je= " + row_value ;  
 }//od if 
  window.location.href = "manipulaceObjektPrijavljeni.php?akce=" + x.innerHTML + "&id=" + row_value + "&tabulka="+ tabulka; 
}//od function(e)