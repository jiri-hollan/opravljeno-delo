function pogojFunction(danes,akce,stevilkaZd) {
console.log("statistika.js  linija 2 danes:"+danes+" akce: "+akce+" številkaZ: "+stevilkaZd);
  document.getElementById("akceId").value = akce;
switch(akce) {

  case "vnos":
//alert(danes);
   let stevilkaZdravnika= '<input type="hidden" id="stevilkaZdravnikaId" class="kratke" name="stevilkaZdravnika" value="'+stevilkaZd+'" placeholder="_____" readonly >';
   let zacDatum= '<label for="zacDatumId">od: </label><input type="date" id="zacDatumId" name="zacDatum" value='+danes+' >';
   let koncDatum= '<label for="koncDatumId">do: </label><input type="date" id="koncDatumId" name="koncDatum" value='+danes+' >';
   let semafor= '<input type="hidden" id="semaforId" name="semafor" value="semaforDatum" >';
   let sifraOpravila= '<input type="hidden" id="sifraId" class="kratke"  name="sifraOpravila" value="" >';
   let opravilo= '<label for="opraviloId">vrsta opravila: </label><br><input id="opraviloId" value="" name="opravilo"  autocomplete="off" >';
   let izbira= '<select id="opravilaId"   onchange="myFunction()"><option>opravilo</select>';
   const opraviloList = JSON.parse(opraviloJson); 

//alert("linija 39 opravilo Json:" + opraviloJson);
//alert(opraviloList);
  
    document.getElementById("demo").innerHTML = "<div class='glavni'>"+semafor+stevilkaZdravnika + zacDatum + koncDatum + sifraOpravila +"<div class='notranji'>"+ opravilo + "<br>"+ izbira +"</div></div>" ;
	   // document.getElementById("klik").innerHTML =	izbira;
	document.getElementById("posli").innerHTML = '<input type="submit" name="submit" value="Submit"><input type="reset" name="reset" value="Reset">'; //submit+reset
	
	listaOpravilFunction(opraviloList);
	
    break;

  case "uredi":
  //alert("v JS case edit");
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
  //alert( "You canceled!");
}
    break;	
*/	
  default:
    // code block
 }//od switch


//----------------------------------------------------------------------------------------
function functionOver (e) {
let x = e.target;
if (x.nodeName == "TD") {
let y = event.composedPath()[1];
let id = y.cells[0].innerHTML;
 /* document.getElementById("demo1").innerHTML = "Triggered by a " + x.nodeName + " element";
  document.getElementById("demo2").innerHTML = "Triggered by a " + x.innerHTML + " element";  */
  document.getElementById("demo3").innerHTML = "id v bazi je= " + id ;  
 }//od if
 
 window.location.href = "manipulacePregledovalci.php?akce=" + x.innerHTML + "&id=" + id;
  
}//od function(e)
} // od pogojFunction
//-----------------------------------------------------------------------------

function listaOpravilFunction(opraviloList) {
console.log("statistika.js  linija 74");	
//alert ("lista opravil function");
console.log("opravila.js"+opraviloList);
let text = "<option id='' value=''>";
let i;
 
 for (let [sifra, value] of Object.entries(opraviloList)) { 	 
  text += "<option id='" +  sifra  + "' value='" + value + "'>"+value; 
  console.log(text);
}
  //alert ("TEXT="+text);
//console.log(text);
document.getElementById("opravilaId").innerHTML = text;
}

//_____________________________________________________
function zadnjiAlertFunction() {
let x= document.getElementById("opraviloId").value;
	//alert("X=:"+x);
	document.getElementById("sifraId").value = "";	
}
	  
	 //----------------------------------------------------------------------------
function myFunction() {
	console.log("statistika.js  linija 98");
	  const a = document.getElementById("opravilaId");
	  //alert("A:"+a);
      let i = a.selectedIndex;
	  //alert("I="+i);
    document.getElementById("opraviloId").value = a.options[i].value;
	document.getElementById("sifraId").value = a.options[i].id;
} 