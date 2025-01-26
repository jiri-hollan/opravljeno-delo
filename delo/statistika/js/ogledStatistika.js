	//alert("ogled DELO JS");
 tabulka="deloTbl";
	//alert(tabulka);
//////////////////////////////////////////////////////////////////////////////7
function izborOgledFunction(akce, tabulka) {
//alert(tabulka);
	 tabulka=tabulka;
//alert(tabulka);
  document.getElementById("akceId").value = akce;
switch(akce) {
  case "vyber":
// prikaže delo na določen dan
  //alert("ogledDelo.js linija 11");
const d = new Date();
let text = d.toISOString();
const actD = text.substr(0, 10);
//alert(actD);
document.getElementById("demo").innerHTML = '<input id="datumVpisaId" type="date" name="datumVpisa" value="'+actD+'" >';
//text = document.getElementById("datumVpisaId").value;
//alert(text);
//document.getElementById("datumVpisaId").value = text;
  document.getElementById("tabSent").innerHTML = '<input type="hidden" name="tabulka" value="'+tabulka+'">';
  document.getElementById("posli").innerHTML = '<input class="submit" type="submit" name="submit" value="potrdi">'; //komentar: submit v ogledObjektPrijavljeni.php
    break; 
/*
  case "vloz":
//alert("ogledDelo.js linja27");
 // <a href="../delo/prijavljeniUporabnikObjekt.php?nazaj='.$nazaj.'&akce=novZapis">
    location.replace("../delo/prijavljeniUporabnikObjekt.php?nazaj='.$nazaj.'&akce=novZapis");
   
    break;*/

  case "edit":
//alert("v JS case edit");
   if(document.getElementById("osebe")!=null){
     document.getElementById("osebe").addEventListener("click", functionOvce);
}
    break;

  case "odstrani": 
   if ( confirm("ogledStatistika.js Odstranim en zapis?") == true) {
    if(document.getElementById("osebe")!=null){
		alert('odstrani');
    document.getElementById("osebe").addEventListener("click", functionOvce);
      }
} else {
  text = "You canceled!";
}
    break;	
  default:
 }//od switch
} // od izborFunction
//////////////////// konec izborFunction /////////////////////////////////////////

function functionOvce (e) {
alert('F.Over 56');	
let x = e.target;
if (x.nodeName == "TD") {
let y = event.composedPath()[1];
row_value = y.cells[0].innerHTML;
alert(row_value);
  document.getElementById("demo3").innerHTML = "id v bazi je= " + row_value ;  
 }//od if 
 alert("../ogledObjektPrijavljeni.php?akce=" + x.innerHTML + "&id=" + row_value + "&tabulka="+ tabulka);
  window.location.href = "../ogledObjektPrijavljeni.php?akce=" + x.innerHTML + "&id=" + row_value + "&tabulka="+ tabulka; 
}//od function(e)