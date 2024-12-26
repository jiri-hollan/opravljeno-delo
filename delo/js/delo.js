function identifikaceFunction(identifikace) {
if(identifikace==""){
	document.getElementById("poPotrebi").innerHTML = "niste prijavljeni ";	
}else{
	document.getElementById("poPotrebi").innerHTML = "prijavljen je: " + " " + 
	identifikace;
	}
} // od identifikaceFunction

function izborFunction(akce,stevilkaZdravnika) {
	alert("izbor function");
  alert(stevilkaZdravnika);
  document.getElementById("akceId").value = akce;
switch(akce) {
  case "vyber":
    document.getElementById("demo").innerHTML = '<input type="text" id="bolnisnicaId" name="bolnisnica" value="" placeholder="Bolnišnica">';// omogoči izbiro bolnišnice
	document.getElementById("posli").innerHTML = '<input type="submit" name="submit" value="Submit">'; //submit
    break; 

  case "vloz":

    stevilkaZdravnika= '<input type="text" id="stevilkaZdravnikaId" name="stevilkaZdravnika" value="" placeholder="_____" readonly >';
    datum= '<input type="text" id="datumId" name="datum" value="" placeholder="Datum" required>';
    sifra= '<input type="text" id="sifraId" name="sifra" value="" placeholder="Šifra" required>';
    opravilo= '<input type="text" id="opraviloId" name="opravilo" value="" placeholder="Opravilo" required>';
    casPosega= '<input type="int" id="casId" name="casPosega" value="" placeholder="minute" required>';
    document.getElementById("demo").innerHTML = stevilkaZdravnika + datum + sifra + opravilo +  casPosega ;
	document.getElementById("posli").innerHTML = '<input type="submit" name="submit" value="Submit"><input type="reset" name="reset" value="Reset">'; //submit+reset
    break;

  case "uredi":
  //alert("v JS case edit");
  if(document.getElementById("osebe")!=null){
 document.getElementById("osebe").addEventListener("click", functionOver);
}

    break;

  case "odstrani":

  
  if ( confirm("v funkciji JS odstrani\odstranim en zapis?") == true) {
    if(document.getElementById("osebe")!=null){
    document.getElementById("osebe").addEventListener("click", functionOver);
      }
} else {
  text = "You canceled!";
}
  
  
 /* if(document.getElementById("osebe")!=null){
 document.getElementById("osebe").addEventListener("click", functionOver);
 
}*/

    // code block

    break;	
  default:
    // code block
 }//od switch
} // od izborFunction
//----------------------------------------------------------------------------------------
function functionOver (e) {
var x = e.target;
if (x.nodeName == "TD") {
var y = event.composedPath()[1];
row_value = y.cells[0].innerHTML;
 /* document.getElementById("demo1").innerHTML = "Triggered by a " + x.nodeName + " element";
  document.getElementById("demo2").innerHTML = "Triggered by a " + x.innerHTML + " element";  */
  document.getElementById("demo3").innerHTML = "id v bazi je= " + row_value ;  
 }//od if
 
 window.location.href = "manipulacePregledovalci.php?akce=" + x.innerHTML + "&id=" + row_value;
  
}//od function(e)