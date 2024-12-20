function odjavaFunction() { 
  localStorage.setItem("imeZdravnika", "");
  localStorage.setItem("aktivnaBolnisnica","");
  localStorage.setItem("mestoBolnisnice","");
  sessionStorage.removeItem("testJSON");
  sessionStorage.removeItem("bolnikId");
  window.open("zdravnik.php", "_self");
//alert ("odjava");
  sbFunction();	 
 }
//--------------------------------------------------
function klousFunction(){
   close();
}
//------shranjevanje v bazo pri prehodu na novega bolnika---
var izbris;
//--------------------------------------------------
function novBolnikFunction(izbris) {
  switch (izbris) {
   case 0: // shrani v bazo
       danesFunction();
     stariFunction();
    break;
   case 1: //naloži praznoi formular
     noviFunction();
    break;
   default:
    //text = "No value found";
}

function stariFunction() {
if(localStorage.getItem("gdpr")==1){	
//alert ('v stariFunction fajl odjava'+localStorage.getItem("aktivnaBolnisnica"));
  let x=localStorage.getItem("aktivnaBolnisnica");
  let y=localStorage.getItem("bazeBolnisnice");
  let z= y.includes(x);
//alert(z);
//IF: localStorage.getItem("aktivnaBolnisnica")== bolnišnica s statusom 2
	if (z){
//alert ('v stariFunction');
      var r = confirm("Za shranjevanje v podatkovno bazo\n Pritisni v redu ali prekliči.");
      if (r == true) {
//alert ('odjava.js bolnikId: '+sessionStorage.getItem("bolnikId"));  
// alert ('pred vstavljanjem v bazo');
        document.getElementById("ustanova").value= localStorage.getItem("aktivnaBolnisnica");
        document.getElementById("frm").submit();
//alert ('shranjeno v bazo');
//alert ('po vstavljanju v bazo');
  } else {
location.reload();
  }
// alert ('nov bolnik');
	}//od if
	else {
    alert ( localStorage.getItem("aktivnaBolnisnica") + ' ni možno schraniti v podatkovno bazo');	
	location.reload();	
	}
}else{
location.reload();	
}
}//--od stariFunction
//--------------------------------------------
function noviFunction() {
	//alert ("V noviFunction");
 sessionStorage.removeItem("testJSON");	
 sessionStorage.removeItem("bolnikId");
document.getElementById("novBLegend").style.visibility = "visible"; 	
location.reload();	
}
}//---od novBolnikFunction
//------konec pri prehodu na novega bolnika---