//........drugi izvidi...................................................................................
function drugiIzvidiFunction() {
var text = "";
var i;
var lab = document.getElementById("stolpec3").getElementsByTagName("label");
var vred =document.getElementById("stolpec3").getElementsByTagName("textarea"); 
for (i = 0; i < lab.length; i++)   
if (vred[i].value.length > 0) {
   text += lab[i].innerHTML + vred[i].value + "," + "&nbsp" + " ";
   //alert (text);
   }
 document.getElementById("drugiIzvidi").value = text;  
}