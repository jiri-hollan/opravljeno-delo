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
} // od poDatumuFunction
//----------------------------------------------------------------------------------------
function datumOver (e) {
  var x = e.target;
  if (x.nodeName == "TD") {
   var y = event.composedPath()[1];
   row_value = y.cells[0].innerHTML;
   document.getElementById("demo3").innerHTML = "izbrani datum= " + row_value ; 
alert(row_value);   
 }//od if 
 window.location.href = "deloStatistika.php?datumOpravila=" + row_value; 
 //window.location.href = "manipulaceZdravniki.php?akce=" + x.innerHTML + "&stevilkaZdravnika=" + row_value;  
}//od function(e)