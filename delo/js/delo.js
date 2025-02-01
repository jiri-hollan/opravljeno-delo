function identifikaceFunction(identifikace) {
if(identifikace==""){
	document.getElementById("poPotrebi").innerHTML = "niste prijavljeni ";	
  }else{
	document.getElementById("poPotrebi").innerHTML = "prijavljen je: " + " " + identifikace;
	}
} // od identifikaceFunction

function izborZdFunction(akce,stevilkaZd) {

document.getElementById("akceId").value = akce;
switch(akce) {
  case "vyber":
   alert("delo.js linija 15");
   document.getElementById("demo").innerHTML = '<input type="text" id="bolnisnicaId" name="bolnisnica" value="" placeholder="Bolnišnica">';// omogoči izbiro bolnišnice
   document.getElementById("posli").innerHTML = '<input type="submit" name="submit" value="Submit">'; //submit
  break; 

  case "vloz":
   let stevilkaZdravnika= '<input type="hidden" id="stevilkaZdravnikaId" class="kratke" name="stevilkaZdravnika" value="'+stevilkaZd+'" placeholder="_____" readonly >';
   let datumOpravila= '<label for="datumId">datum opravila: </label><br><input type="date" id="datumId" name="datumOpravila" value="" placeholder="datumOpravila" required>';
   let sifraOpravila= '<input type="hidden" id="sifraId" class="kratke"  name="sifraOpravila" value="" placeholder="0" readonly required>';
   let opravilo= '<label for="opraviloId">vrsta opravila: </label><br><input id="opraviloId" value="" name="opravilo" required autocomplete="off" onchange="zadnjiAlertFunction()">';		
   let casOpravila= '<input type="number" id="casId" class="kratke"  name="casOpravila" min="0" step="1" value="" placeholder="minute" autocomplete="off"  required>';
   let izbira= '<select id="opravilaId"   onchange="myFunction()"><option>opravilo</select>';
   const opraviloList = JSON.parse(opraviloJson);
//alert("opravilo Json:" + opraviloJson);
//alert(opraviloList);
    document.getElementById("demo").innerHTML = "<div class='glavni'>"+stevilkaZdravnika + datumOpravila + sifraOpravila +"<div class='notranji'>"+ opravilo + casOpravila +"<br>"+ izbira +"</div></div>" ;
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

  case "odstrani":
    if( confirm("v funkciji JS odstrani\odstranim en zapis?") == true) {
       if(document.getElementById("osebe")!=null){
       document.getElementById("osebe").addEventListener("click", functionOver);
         }
      }else{
//alert( "You canceled!");
        }
  /* if(document.getElementById("osebe")!=null){
 document.getElementById("osebe").addEventListener("click", functionOver);
 }*/
    break;	
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
//-----------------------------------------------------------------------------
} // od izborFunction
function listaOpravilFunction(opraviloList) {
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
//document.getElementById("sifraId").value = "";	
}
//----------------------------------------------------------------------------

function myFunction() {
const a = document.getElementById("opravilaId");
//alert("A:"+a);
let i = a.selectedIndex;
//alert("I="+i);
document.getElementById("opraviloId").value = a.options[i].value;
document.getElementById("sifraId").value = a.options[i].id;
} 