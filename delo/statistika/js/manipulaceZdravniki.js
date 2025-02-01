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

//----------------------------------------------------------------------------------------
function functionOver (e) {
  var x = e.target;
  if (x.nodeName == "TD") {
   var y = event.composedPath()[1];
   stevilkaZdravnika = y.cells[4].innerHTML;
   document.getElementById("demo3").innerHTML = "izbrana številka zdravnika= " + stevilkaZdravnika ;    
 }//od if 
 window.location.href = "deloStatistika.php?stevilkaZdravnika=" + stevilkaZdravnika+"&semafor=semaforZdravnik"; 
 //window.location.href = "zdravniki.php?akce=" + x.innerHTML + "&stevilkaZdravnika=" + stevilkaZdravnika;  
}//od function(e)
} // od izberiStevilkoZdravnikaFunction