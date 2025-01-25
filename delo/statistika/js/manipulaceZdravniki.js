function izberiStevilkoZdravnikaFunction(akce) {
  document.getElementById("akceId").value = akce;
switch(akce) {

  case "vyber":
  if(document.getElementById("osebe")!=null){
 document.getElementById("osebe").addEventListener("click", functionOver);
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
} // od izberiStevilkoZdravnikaFunction
//----------------------------------------------------------------------------------------
function functionOver (e) {
  var x = e.target;
  if (x.nodeName == "TD") {
   var y = event.composedPath()[1];
   row_value = y.cells[4].innerHTML;
   document.getElementById("demo3").innerHTML = "izbrana številka zdravnika= " + row_value ;    
 }//od if 
 window.location.href = "deloStatistika.php?stevilkaZdravnika=" + row_value+"&akce=izberiZdr"; 
 //window.location.href = "manipulaceZdravniki.php?akce=" + x.innerHTML + "&stevilkaZdravnika=" + row_value;  
}//od function(e)