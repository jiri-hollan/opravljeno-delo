function listaSklepovFunction(sklepList) {
//alert ("lista Sklepov function");
console.log("sklepi.js");
var text = "";
var i;
for (i = 0; i < sklepList.length; i++) {
 // text += "<option value=" +  sklepList[i] + ">"  +"<br>";
  text += "<option value='" +  sklepList[i] + "'>"  +"<br>";
}
//console.log(text);
document.getElementById("sklepi").innerHTML = text;
}