
const person1 = {};	
function formFunction() {
//const person1 = {};	
var inputs = document.getElementById("frm").elements;
// Iterate over the form controls
for (i = 0; i < inputs.length; i++) {
  if (inputs[i].nodeName === "INPUT" ||inputs[i].nodeName === "TEXTAREA") {  
 var kljuc=inputs[i].name;
//alert (kljuc); 
 var vrednost=inputs[i].value
//alert (vrednost);
  person1[kljuc] = vrednost;
  }
} //od for
const myJSON = JSON.stringify(person1);
sessionStorage.setItem("testJSON", myJSON);
}//od formFunction

function formNazajFunction(person1) {
//alert ('obnovaForme45');
	if (sessionStorage.getItem("testJSON")!=null){
	  let text = sessionStorage.getItem("testJSON");
//console.log(text);	
      let obj = JSON.parse(text);
//alert (obj.stevMaticna);	
var inputs = document.getElementById("frm").elements;
for (i = 0; i < inputs.length; i++) {
  if (inputs[i].nodeName === "INPUT" ||inputs[i].nodeName === "TEXTAREA") {
	 var kljuc=inputs[i].name;
//alert (kljuc+obj[kljuc]);
//console.log(kljuc+"="+typeof obj[kljuc]+"-"+obj[kljuc]);
	 if (obj[kljuc] !== undefined && typeof obj[kljuc]== 'string') {
//console.log(kljuc+"="+obj[kljuc]);		 
		document.getElementsByName(kljuc)[0].value = obj[kljuc].replace(/\&quot;/g,'\\"').replace(/\&amp;/g, "&"); 
	 }else{
		 document.getElementsByName(kljuc)[0].value = obj[kljuc];
//console.log("elze "+kljuc+"="+obj[kljuc]);		 
	 }
//alert(kljuc + ": " +person1[kljuc]);
} // od if
} //od for
starostFunction();
document.getElementById("novBLegend").style.display = "none"; 
labevalFunction();
}//od if
} //od function formNazajFunction

