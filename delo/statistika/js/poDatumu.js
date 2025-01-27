let sifraOpravila;
let datumOpravila;
let stevilkaZdravnika;
function poDatumuFunction(akce) {
  document.getElementById("akceId").value = akce;
  sifraOPravila= document.getElementById("sifraId").value;

switch(akce) {

  case "vyber":
  if(document.getElementById("osebe")!=null){
 document.getElementById("osebe").addEventListener("click", datumOver);
}
    break;
/*
  case "odstrani": 
   if ( confirm("v funkciji JS odstrani\odstranim en zapis?") == true) {
     if(document.getElementById("osebe")!=null){
        document.getElementById("osebe").addEventListener("click", functionOver);
      }
} else {
  text = "You canceled!";
}
   break;
*/   
  default:

 }//od switch

//----------------------------------------------------------------------------------------
function datumOver (e) {
  var x = e.target;
  if (x.nodeName == "TD") {
   var y = event.composedPath()[1];
   datumOpravila = y.cells[0].innerHTML;
   stevilkaZdravnika = y.cells[1].innerHTML;  
alert(sifraOPravila);
   document.getElementById("demo3").innerHTML = "izbrani datum= " + datumOpravila ; 
//alert('poDatumu.js linija 33 '+datumOpravila);   
 }//od if 

window.location.href = "deloStatistika.php?semafor=semaforPregled&&datumOpravila=" + datumOpravila+"&&stevilkaZdravnika="+stevilkaZdravnika+"&&sifraOpravila="+sifraOPravila; 
 //window.location.href = "deloStatistika.php?datumOpravila=" + datumOpravila; 
 //window.location.href = "manipulaceZdravniki.php?akce=" + x.innerHTML + "&stevilkaZdravnika=" + datumOpravila;  
}//od function(e)
} // od poDatumuFunction