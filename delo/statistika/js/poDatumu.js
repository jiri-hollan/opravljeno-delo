function poDatumuFunction(akce) {
  document.getElementById("akceId").value = akce;
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
   row_datum = y.cells[0].innerHTML;
   row_zdravnik = y.cells[1].innerHTML;  
   document.getElementById("demo3").innerHTML = "izbrani datum= " + row_datum ; 
//alert('poDatumu.js linija 33 '+row_datum);   
 }//od if 
 window.location.href = "deloStatistika.php?semafor=semaforPregled&&datumOpravila=" + row_datum+"&&stevilkaZdravnika="+row_zdravnik; 
 //window.location.href = "deloStatistika.php?datumOpravila=" + row_datum; 
 //window.location.href = "manipulaceZdravniki.php?akce=" + x.innerHTML + "&stevilkaZdravnika=" + row_datum;  
}//od function(e)
} // od poDatumuFunction