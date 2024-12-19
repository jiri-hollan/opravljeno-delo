 var datRojstva;
 var a;
//alert('report: '+sessionStorage.getItem("bolnikId"));
 function reportFunction(a){
 formFunction(); 
 var x;	 
 var x1 = document.getElementById("frm")["oddelek"].value;
 var x2 = document.getElementById("frm")["dgOperativna"].value;
 var x3 = document.getElementById("frm")["opNacrtovana"].value;
 var x4 = document.getElementById("frm")["teza"].value;
 var x5 = document.getElementById("frm")["visina"].value;
 var x6 = document.getElementById("frm")["izvidiInOpombe"].value;
 var x7 = document.getElementById("frm")["sklep"].value;
 var x8 = document.getElementById("ime").value;
 var x9 = document.getElementById("priimek").value;
 var x10 = datRojstva;
 var x11 = document.getElementById("opiati").value;
/*var x11 = document.getElementById("frm")[""].value;
  var x12 = document.getElementById("frm")[""].value;*/
  if (x1 == "") {
    alert("oddelek mora biti vpisan");
    return false;
  }else if (x2 == "") {
    alert("dgOperativna mora biti vpisana");
    return false;
  }else if (x3 == "") {
    alert("opNacrtovana mora biti vpisana");
    return false;
  }else if (x4 == "") {
    alert("teza mora biti vpisana");
    return false;
  }else if (x5 == "") {
    alert("visina mora biti vpisana");
    return false;
  }else if (x6 == "") {
    alert("izvidiInOpombe ne smejo biti prazni");
    return false;
  }else if (x7 == "") {
    alert("sklep mora biti vpisan");
    return false;
  }else if (x8 == "") {
    alert("Ime mora biti vpisano");
    return false;
  }else if (x9 == "") {
    alert("priimek mora biti vpisan");
    return false;
  }else if (x10 == "") {
    alert("datum rojstva mora biti vpisan");
    return false;
 }else if (x11 == "") {
    alert("ovisnost mora biti opredeljena");
    return false;	
	
/*}else if (x12 == "") {
      alert("");
      return false;	  
}else if (x13 == "") {
      alert("");
      return false;	  
}
*/
  }else {
     document.getElementById("prva").style.display = "none"; 
     document.getElementById("druga").style.display = "none";
     document.getElementById("tretja").style.display = "block";

nalepka = document.getElementById("priimek").value;
nalepka = "priimek in ime:.... " + "<b>" + nalepka + " " + document.getElementById("ime").value + "</b>" + "<br>";
nalepka = nalepka + "datum rojstva:..... " +  "<b>" + datRojstva + "</b>" + "<br>" ;
nalepka = nalepka + "matična številka:. " +  "<b>" + document.getElementById("stevMaticna").value + "</b>" ;
//alert(nalepka);
document.getElementById("nalepkaR").innerHTML=nalepka;
//---------------------------------------------------------------
obravnava = danes;
obravnava = "<h3>" + obravnava + " " + "za odd. " + document.getElementById("zaOdd").value + "</h3>" ;
document.getElementById("obravnavaR").innerHTML=obravnava;
diagnoza =  "Op.diagnoza: " +    "<b>" + document.getElementById("dgOperativna").value + "</b>";
document.getElementById("diagnozaR").innerHTML=diagnoza;
diagnoza =  "predvidena op.: " +    "<b>" + document.getElementById("opNacrtovana").value + "</b>";
document.getElementById("operacijaR").innerHTML=diagnoza;
//..................................če ni vpisana vrednost............................................................................
function xFunction(x){
if((x === undefined || x == null || x == 0 || x.length <= 0))  {
x = "....";
//alert(typeof x + x);
return x;
     }else {
  //x = x;
  return x;
     }
  }	
//....................................Meritve..............................................
 x = document.getElementById("starost").value;
 x = xFunction(x);
//alert(typeof x + x);
meritve =  "starost:" + "&nbsp"  + "<b>" + x + "&nbsp" + "let" + "</b>" + "&nbsp";
x = document.getElementById("teza").value;
x = xFunction(x);
meritve =  meritve +  " " + " teža:" + "&nbsp" + "<b>" + x + "&nbsp" + "kg " + "</b>" + "&nbsp";

x = document.getElementById("visina").value;
x = xFunction(x);
meritve =  meritve + " "  + " višina:" + "&nbsp" + "<b>" + x + "&nbsp" +  "m " + "</b>" + "&nbsp";

x = document.getElementById("bmi").value;
x = xFunction(x);
meritve =  meritve +  " " + " BMI:" + "&nbsp" + "<b>" + x +  "</b>" + "&nbsp";

x = document.getElementById("krTlak").value;
x = xFunction(x);
meritve =  meritve +  " " + " krvni tlak:" + "&nbsp" + "<b>" + x + "&nbsp" + "mmHg " + "</b>" + "&nbsp";

x = document.getElementById("pulz").value;
x = xFunction(x);
meritve =  meritve  +  " " + " pulz:" + "&nbsp" + "<b>" + x + "&nbsp" + "/min " + "</b>" + "&nbsp";

x = document.getElementById("spo2").value;
videz = document.getElementById("spo2").style.fontWeight;
//alert(videz);
x = xFunction(x);
meritve =  meritve +'<span style= "font-weight:' + videz + '">'+  " " + " sPO2:" + "&nbsp" +  x + "&nbsp" + "%" +"</span>,";
document.getElementById("meritveR").innerHTML=meritve;

//........laboratorij...................................................................................
var text = "<span class='nadpis'>" + "Lab.: " + "</span>";
var i;
var videz;
var lab = document.getElementById("lab").getElementsByTagName("label");
var vred =document.getElementById("lab").getElementsByClassName("lab"); 
for (i = 0; i < lab.length; i++) {  
 if (vred[i].value.length > 0 && vred[i].value!=0){
	var videz = vred[i].style.fontWeight;	   
   text += '<span style= "font-weight:' + videz + '">' + lab[i].innerHTML + vred[i].value + "</span>," + "&nbsp" + " ";
   }//od if
}//od for
document.getElementById("labR").innerHTML = text;
//....................EKG....................................................................

//var ekg = document.getElementById("ekg").value;
//document.getElementById("ekgR").innerHTML= "EKG: " + ekg;
//...........................RTG................................................................
//var rtg = document.getElementById("rtg").value;
//document.getElementById("rtgR").innerHTML= "RTG: " + rtg;


//............asa mallampati, alergija.........................................................
//var asa = document.getElementById("asa").value;
//alert(asa);
var asa = document.getElementById("asa");
document.getElementById("asaR").innerHTML= asa.value;
document.getElementById("asaR").style="font-weight:"+asa.style.fontWeight;

var mall = document.getElementById("mallampati");
//alert(mall);
document.getElementById("mallR").innerHTML= mall.value;
document.getElementById("mallR").style="font-weight:"+mall.style.fontWeight;

var opia = document.getElementById("opiati");
//alert(opi);
//console.log("opia: "+opia.value);
opia.value=opia.value.toUpperCase();
document.getElementById("opiaR").innerHTML= opia.value;
document.getElementById("opiaR").style="font-weight:"+opia.style.fontWeight;


var dovis = document.getElementById("dovisnosti");
//alert(dovis);
//console.log("dovis: "+dovis.value);
dovis.value=dovis.value.toUpperCase();

document.getElementById("dovisnostiR").innerHTML= dovis.value;
if (dovis.value=="DA"|| dovis.value=="NE"){	
document.getElementById("dovisnostiR").style="font-weight:"+dovis.style.fontWeight;	
document.getElementById("dovisnostiLabelR").style.visibility = "visible";
}
else{	
document.getElementById("dovisnostiR").style.visibility = "hidden";
document.getElementById("dovisnostiLabelR").style.visibility = "hidden";
       }//od else
		   

var alergija = document.getElementById("alergija").value;
//alert(alergija);
document.getElementById("alergijaR").innerHTML= alergija;

//....................EKG....................................................................

var ekg = document.getElementById("ekg").value;
ekg = opisFunction(ekg, "<hr>EKG:");
//alert(ekg);
//...........................RTG................................................................
var rtg = document.getElementById("rtg").value;
rtg = opisFunction(rtg, "<hr>RTG:");

//..............pridružene bolezni........................................................
var prid = document.getElementById("dgPridruzene").value;
prid = opisFunction(prid, "<hr>Pridružene bolezni:" );

//................................... predhodna terapija.........................................
var pred = document.getElementById("terPredhodna").value;
pred = opisFunction(pred, "<hr>Predhodna terapija:" );

//..................Izvidi in opombe...........................................................
var izvidi = document.getElementById("izvidiInOpombe").value;

izvidi = izvidi.replace(/\n/g, "<br>&emsp;&emsp;");
izvidi = izvidiFunction(izvidi, "<hr>");

//..................Sklep...........................................................
var sklep = document.getElementById("sklep").value;
sklep = opisFunction(sklep, "Sklep:" );


//......................celi opis................................................................
var opis = ekg + rtg + prid + pred + izvidi + sklep;

//alert(opis);
document.getElementById("izvidiR").innerHTML= opis;
//....................premedikacija..........................................................
var premedikacija = "Premedikacija:";
var vecer = document.getElementById("premedVecer").value;
var jutri = document.getElementById("premedPredOp").value;

if (vecer.length > 0) {
  premedikacija = premedikacija + "<br>" +  "zvečer: " + vecer;
}
if (jutri.length > 0) {
  premedikacija = premedikacija + "<br>" +  "Pred op.: " + jutri;
}

//document.getElementById("premedikacijaR").insertAdjacentHTML("beforeend", premedikacija);
document.getElementById("premedikacijaR").innerHTML= premedikacija;

//....................navodila................................................................
var navodila = document.getElementById("navodila").value;
//alert(alergija);
document.getElementById("navodilaR").innerHTML= navodila;
//......................zdravnik...............................................................

document.getElementById("zdravnikR").innerHTML = document.getElementById("imeZdravnika").value;

switch (a) {
  case "t": //tisk
    natisniFunction();
    novBolnikFunction(0);	
    break;
  case "s": //naloži v bazo
    danesFunction();
    novBolnikFunction(0);
    break;
 case "p": //predogled
    ogledFunction();
    break;	
  case "pr": //prenos
    prenosFunction();
    break;	 
  default:
    text = "No value found";
}
}
 }
 //....konec report function..............................
 
//....................................opisFunction ureja: ekg, RTG, Predhodna terapija, pridružrne bolezni..............
function opisFunction(m,n)
{
if (m.length > 0) {
    m =  "<span class='nadpis'>" + n + "</span>"  + "<span class='besedilo'>" + m + "</span>" + "</br>";
}
else {
  m = "";
    }
return m;

}
 
//............................................izvidiFunction ureja besedilni opis stanja...................................
function izvidiFunction(m,n)
{
if (m.length > 0) {
   m =  n + "<span class='besedilo'> &emsp;"  + m + "</span><br><br>";  
}else {
  m = "";
    }
return m;

}
function natisniFunction() {
  if (confirm("natisni! bolnik= " + document.title)){
  document.getElementById("navbar").style.display = "none"; 
  window.print();
  ogledFunction();
   }else {
  ogledFunction();
    }
}

function nazajFunction() {
    //alert("poglej bolnik= " + document.title);
    document.getElementById("navbar").style.display = "block"; 
    document.getElementById("prva").style.display = "none"; 
    document.getElementById("druga").style.display = "block";
    document.getElementById("tretja").style.display = "none";
    document.getElementById("cetrta").style.display = "none"; 	
    document.getElementById("nazaj").style.display = "none";
    document.getElementById("predogled").style.display = "block";
	document.getElementById("submitFrm").style.display = "none";
	document.getElementById("najdiZapis").style.display = "none";
}

function ogledFunction() {
  //alert("poglej bolnik= " + document.title);
  document.getElementById("navbar").style.display = "block"; 
  document.getElementById("prva").style.display = "none"; 
  document.getElementById("druga").style.display = "none";
  document.getElementById("tretja").style.display = "block";
  document.getElementById("cetrta").style.display = "none"; 
  document.getElementById("predogled").style.display = "none";
  document.getElementById("nazaj").style.display = "block";
  document.getElementById("prenos").style.display = "block";
  document.getElementById("submitFrm").style.display = "block";
  document.getElementById("najdiZapis").style.display = "none";  
}

function pomocFunction() {
  var pot = "\\\\hospital.local\\dfs\\EIT\\premedikacija\\pregledani bolniki";
 prompt("Če ni nastavljena pot do  ciljne mape za PDF jo nastavi.\nSkopiraj spodnji naslov in ga prilepi kot pot.", pot );
}



