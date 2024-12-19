
function zdravnikFunction() {  
// Check browser support
if (typeof(Storage) !== "undefined") {
// Store
   imeZdravnika = document.getElementById("zdravnik").value || "" ;
   localStorage.setItem("imeZdravnika", imeZdravnika);
// Retrieve
   document.getElementById("pregledovalec").innerHTML = "izvajalec:  "+"<b>" + localStorage.getItem("imeZdravnika")+"</b>";
     } else {
     document.getElementById("pregledovalec").innerHTML = "oprostite, vaš brskalnik ne podpira Web Storage" + "<br>" + "uporabite Google Chrom";
    }
  }
//_______________________________________________
function sbFunction(bol="") {
//alert(seznamBolnisnicJson);
       if(bol=="spomin") {
	location.href='../pregled/zdravnik.php?aktivnaBolnisnica='+localStorage.getItem("mestoBolnisnice");return false;
      } else if (!bol=="") {
// alert(seznamBolnisnicJson);
//naredi array bolnišnic
		 bolnisnica=seznamBolnisnicx; 
		 bol = document.getElementById("bolnisnica").value || "" ;
         localStorage.setItem("aktivnaBolnisnica",bolnisnica[bol]);
         localStorage.setItem("mestoBolnisnice",bol);
//alert(bolnisnica[bol]);		 
//alert(bazeBolnisniceJson);		 
//alert ("Formular za S.B. Izola");
	location.href='zdravnik.php?aktivnaBolnisnica='+localStorage.getItem("mestoBolnisnice");return false; 
      } else {
//alert ("nobena bolnišnica ni aktivirana");	
      }
   }
//____________________________________________
function naprejFunction() { 
 if (localStorage.getItem("imeZdravnika").length < 3) {
    alert("zdravnik ni prijavljen");
    return false;
  } 
	 window.open("bolnik.php", "_self"); 
}
//______________________________________________________
function listaZdravnikovFunction(zdravListX) {
//alert ("lista zdravnikov function");
document.getElementById("pregledovalec").innerHTML = "izvajalec:  " +"<b>"+ localStorage.getItem("imeZdravnika")+"</b>";
//alert(localStorage.getItem("imeZdravnika"));
//  koda, ki naredi array zdravList iz tabele pregledovalci	
//alert(zdravListX);
 var zdravList  = zdravListX; 
 document.getElementById("aktBolnisnica").innerHTML = "<h1>"+localStorage.getItem("mestoBolnisnice")+"</h1> "; 
//alert (localStorage.getItem("aktivnaBolnisnica"));
 if (localStorage.getItem("aktivnaBolnisnica") === ""||localStorage.getItem("aktivnaBolnisnica") ==="undefined") {
   var zdravList  =[];
document.getElementById("aktBolnisnica").innerHTML = "<h1 style='color:Tomato;'>Bolnišnica ni določena</h1>"; 	
//alert ("bolnišnica ni določena");
} 
var text = "";
var naslov="&nbsp;dr.med";
var i;
for (i = 0; i < zdravList.length; i++) {
    text += "<option value='" +  zdravList[i] + naslov + "'>"  +"<br>";
}
document.getElementById("zdravniki").innerHTML = text;
}
//__________________________________________________________________________________________
function listaBolnisnicFunction(bolListX) {
	//alert ("lista bolnisnic function");
document.getElementById("pregledovalec").innerHTML = "izvajalec:  " + localStorage.getItem("imeZdravnika");

// koda, ki naredi array bolList iz tabele bolnisniceTab	

//alert(bolListX);
var bolList  = bolListX; 
var text = "";
var i;
for (i = 0; i < bolList.length; i++) {
  text += "<option value='" +  bolList[i]  + "'>"  +"<br>";
}
document.getElementById("bolnisnice").innerHTML = text;
}