function identifikaceFunction(identifikace) {
if(identifikace==""){
	document.getElementById("poPotrebi").innerHTML = "niste prijavljeni ";	
}else{
	document.getElementById("poPotrebi").innerHTML = "prijavljen je: " + " " + 
	identifikace;
	}
} // od identifikaceFunction

function izborFunction(akce,stevilkaZd) {

  document.getElementById("akceId").value = akce;
switch(akce) {
  case "vyber":
    document.getElementById("demo").innerHTML = '<input type="text" id="bolnisnicaId" name="bolnisnica" value="" placeholder="Bolnišnica">';// omogoči izbiro bolnišnice
	document.getElementById("posli").innerHTML = '<input type="submit" name="submit" value="Submit">'; //submit
    break; 

  case "vloz":
    stevilkaZdravnika= '<input type="text" id="stevilkaZdravnikaId" name="stevilkaZdravnika" value="'+stevilkaZd+'" placeholder="_____" readonly >';
    datumOpravila= '<input type="date" id="datumId" name="datumOpravila" value="" placeholder="datumOpravila" required>';
    sifraOpravila= '<input type="text" id="sifraId" name="sifraOpravila" value="" placeholder="Šifra" required>';
	
opravilo= '<input id="opraviloId" list="opravila" name="opravilo" required> <datalist id="opravila"><option value="opravilo"></datalist>';
  

// alert("sklep Json:" + sklepJson);
  var opraviloList = JSON.parse(opraviloJson);
//alert(sklepList);
  listaOpravilFunction(opraviloList);


   
   //opravilo= '<input type="text" id="opraviloId" name="opravilo" value="" placeholder="Opravilo" required>';
 
 casOpravila= '<input type="int" id="casId" name="casOpravila" value="" placeholder="minute" required>';
    document.getElementById("demo").innerHTML = stevilkaZdravnika + datumOpravila + sifraOpravila + opravilo +  casOpravila ;
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
//-----------------------------------------------------------------------------

function listaOpravilFunction(opraviloList) {
//alert ("lista opravil function");
console.log("opravila.js");
var text = "";
var i;
for (i = 0; i < opraviloList.length; i++) {
 // text += "<option value=" +  opraviloList[i] + ">"  +"<br>";
  text += "<option value='" +  opraviloList[i] + "'>"  +"<br>";
  console.log(text);
}
//console.log(text);
document.getElementById("opravila").innerHTML = text;
}