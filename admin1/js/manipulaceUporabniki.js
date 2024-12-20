function izborFunction(akce) {
  document.getElementById("akceId").value = akce;
switch(akce) {
  case "vyber":
    document.getElementById("demo").innerHTML = '<input type="text" id="priimekId" name="priimek" value="" placeholder="Priimek">';// omogoči izbiro po priimku
	document.getElementById("posli").innerHTML = '<input type="submit" name="submit" value="Submit">'; //to je submit
    break; 

  case "vloz":
   alert("ni omogočeno");
    break;

  case "uredi":
  if(document.getElementById("osebe")!=null){
 document.getElementById("osebe").addEventListener("click", functionOver);
}
    break;

/*  case "odstrani": 
   if ( confirm("v funkciji JS odstrani\odstranim en zapis?") == true) {
     if(document.getElementById("osebe")!=null){
        document.getElementById("osebe").addEventListener("click", functionOver);
      }
} else {
  text = "You canceled!";
}*/
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
 window.location.href = "manipulaceUporabniki.php?akce=" + x.innerHTML + "&id=" + row_value;  
}//od function(e)