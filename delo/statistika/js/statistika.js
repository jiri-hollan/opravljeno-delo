
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
