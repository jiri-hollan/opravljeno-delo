function osebniFunction()
 {
 var w = document.getElementById("frm")["ime"].value;
 var x= document.getElementById("frm")["priimek"].value;
 var y =  datRojstva;
 var z = document.getElementById("frm")["stevMaticna"].value;

  if (w == "") {
    alert("Ime mora biti vpisano");
    return false;
  }
    else if (x == "") {
    alert("priimek mora biti vpisan");
    return false;
  }
    else if (typeof y == "undefined") {
    alert("datum rojstva mora biti vpisan");
    return false;
  }
    else if (z == "") {
    alert("matična številka mora biti vpisana");
    return false;
  }
    else {

priimek = document.getElementById("priimek").value;
ime = document.getElementById("ime").value;
//datRojstva = document.getElementById("datRojstva").value ;
stevMaticna = document.getElementById("stevMaticna").value;
  document.getElementById("osebni").innerHTML = priimek + " " + ime + "  " + "roj: " + datRojstva + "  mat. indeks: " + stevMaticna;
  document.getElementById("imeZdravnika").value = localStorage.getItem("imeZdravnika");
  document.getElementById("bolnikId").value = sessionStorage.getItem("bolnikId");
document.getElementsByTagName('title')[0].innerHTML= priimek + " " + ime;
otroskaVklopFunction();
     document.getElementById("navbar").style.display = "block";
     document.getElementById("prva").style.display = "none"; 
     document.getElementById("druga").style.display = "block";
     document.getElementById("tretja").style.display = "none";
     document.getElementById("nazaj").style.display = "none";
     document.getElementById("predogled").style.display = "block";
     document.getElementById("novB").style.display = "block";
     document.getElementById("natisni").style.display = "none";
     document.getElementById("pomoc").style.display = "block";
	 document.getElementById("najdiZapis").style.display = "none";	 
     //document.getElementById("submitFrm").style.display = "none";
	 if(document.getElementById("submitFrm")==undefined){}//alert("submitFrm nedefinirana 51");
	  else{document.getElementById("submitFrm").style.display = "none";} 
     //document.getElementById("prijavi").style.display = "none";
     if(document.getElementById("prijavi")==undefined){}//alert("prijavi nedefinirana 54");
     else{document.getElementById("prijavi").style.display = "none";}
return false;

     }
}

/**********************************reportFunction********************************************/

 var datRojstva;
 var a;
//alert('report: '+sessionStorage.getItem("bolnikId"));
 function reportFunction(a){
let modal = document.getElementById('doziranje');
    modal.style.display = "none";
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
ekg = opisFunction(ekg, "<hr>", "EKG:");
//alert(ekg);
//...........................RTG................................................................
var rtg = document.getElementById("rtg").value;
rtg = opisFunction(rtg, "<hr>", "RTG:");

//..............pridružene bolezni........................................................
var prid = document.getElementById("dgPridruzene").value;
prid = opisFunction(prid, "<hr>", "Pridružene bolezni:" );

//................................... predhodna terapija.........................................
var pred = document.getElementById("terPredhodna").value;
pred = opisFunction(pred, "<hr>", "Predhodna terapija:" );

//..................Izvidi in opombe...........................................................
var izvidi = document.getElementById("izvidiInOpombe").value;
izvidi = izvidi.replace(/^\s*$(?:\r\n?|\n)/gm, "");
izvidi = izvidi.replace(/\n/g, "<br>&emsp;&emsp;");
const novaLinija = (izvidi.match(new RegExp("<br>", "g")) || []).length;
izvidi = izvidiFunction(izvidi, novaLinija );

//..................Sklep...........................................................
var sklep = document.getElementById("sklep").value;
sklep = sklepFunction(sklep, "Sklep:" );


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
function opisFunction(m, l, n)
{
if (m.length == 0) {
	  m = "";
}else if (m.length > 120){
	//alert(m.length + 'več kot 120 ' + m);
	m = "<span class='izvid3'>" +  l + "</span><span class='nadpis'>" + n + "</span>"  +  "<span class='izvid3' class='besedilo'> &emsp;"  + m + "<br></span>"; 	  
}else if (m.length > 100){
	//alert(m.length + 'več kot 100 ' + m);
	m = "<span class='izvid2'>" +  l + "</span><span class='nadpis'>" + n + "</span>"  +  "<span class='izvid2' class='besedilo'> &emsp;"  + m + "<br></span>"; 
}else if (m.length > 70){
	//alert(m.length + 'več kot 70 ' + m);
	m = "<span class='izvid1'>" +  l + "</span><span class='nadpis'>" + n + "</span>"  +  "<span class='izvid1' class='besedilo'> &emsp;"  + m + "<br></span>"; 	
}else {
  m = "<span class='izvid0'>" +  l + "</span><span class='nadpis'>" + n + "</span>"  + "<span class='besedilo'>" + m + "</span>" + "</br>";
    }
return m;

}
 
//............................................izvidiFunction ureja besedilni opis stanja...................................
function izvidiFunction(izvidi, novaLinija)
{
let m =	izvidi.length + 30 * novaLinija;
if (izvidi.length == 0) {
	  m = "";
}else if (m > 1600){
//alert(m + 'več kot 1600 ' + izvidi);
	izvidi = "<span class='izvid4' class='besedilo'><hr> &emsp;"  + izvidi + "<br></span>"; 	  
}else if (m > 1400){
//alert(m + 'več kot 1400 ' + izvidi);
	izvidi =  "<span class='izvid3' class='besedilo'><hr> &emsp;"  + izvidi + "<br></span>"; 
}else if (m  > 1200){
//alert(m  + 'več kot 1200 ' + izvidi);
	izvidi =  "<span class='izvid2' class='besedilo'><hr> &emsp;"  + izvidi + "<br></span>"; 
}else if (m  > 800){
//alert(m  + 'več kot 800 ' + izvidi);
	izvidi =  "<span class='izvid1' class='besedilo'><hr> &emsp;"  + izvidi + "<br><br></span>"; 
        
}else {
//alert(m  + 'manj kot 800 ' + izvidi);
	izvidi =  "<span class='izvid0'  class='besedilo'><hr> &emsp;"  + izvidi + "<br><br></span>"; 
    }
return izvidi;

}
//.......................................SklepFunction..............................
function sklepFunction(m,n)
{
if (m.length == 0) {
	  m = "";
}else if (m.length > 265){
	alert(m.length + 'več kot 265 ' + m);
	m = "<span class='nadpis'>" + n + "</span>"  +  "<span class='izvid3' class='besedilo'> &emsp;"  + m + "<br></span>"; 	  
}else if (m.length > 225){
	alert(m.length + 'več kot 225 ' + m);
	m = "<span class='nadpis'>" + n + "</span>"  +  "<span class='izvid2' class='besedilo'> &emsp;"  + m + "<br></span>"; 
}else if (m.length > 200){
	alert(m.length + 'več kot 200 ' + m);
	m = "<span class='nadpis'>" + n + "</span>"  +  "<span class='izvid1' class='besedilo'> &emsp;"  + m + "<br></span>"; 	
}else {
  m = "<span class='nadpis'>" + n + "</span>"  + "<span class='besedilo'>" + m + "</span>" + "</br>";
    }
return m;

}
//.....................................natisniFunction..............................
function natisniFunction() {
  if (confirm("natisni! bolnik= " + document.title)){
  document.getElementById("navbar").style.display = "none"; 
  document.getElementById("stanje").style.display = "none"  
  window.print();
  ogledFunction();
  }
   else {
  ogledFunction();
   }
}

/******************************vpisFunction********************************************/
function vpisFunction() {
	 document.getElementById("navbar").style.display = "block";
     document.getElementById("prva").style.display = "block"; 
     document.getElementById("druga").style.display = "none";
     document.getElementById("tretja").style.display = "none";
	 document.getElementById("cetrta").style.display = "none"; 
     document.getElementById("nazaj").style.display = "none";
	 document.getElementById("predogled").style.display = "none";
     document.getElementById("novB").style.display = "block"; ;
     document.getElementById("natisni").style.display = "none";		 
     document.getElementById("pomoc").style.display = "none";
     document.getElementById("prenos").style.display = "none";
     document.getElementById("najdiZapis").style.display = "block";	 
     //document.getElementById("submitFrm").style.display = "none";
	  if(document.getElementById("submitFrm")==undefined){}//alert("submitFrm nedefinirana 15");
	  else{document.getElementById("submitFrm").style.display = "none";} 	  

      if(document.getElementById("prijavi")==undefined){}//alert("prijavi nedefinirana 17");
      else{document.getElementById("prijavi").style.display = "none";}
	danesFunction();
	formNazajFunction();
	administraceFunction();
}

/*****************************danes function*********************************************/
 //izračun današnjeg datuma in prikaz v ljudski obliki. V <input> vložena pravilna oblika datuma za QLS
var danes;
function danesFunction() {
    var d = new Date();   
    danes = d.toLocaleString("sl-SI", {dateStyle: "medium",timeStyle: "short"});  
    //document.forms["frm1"].elements["datPregleda"].value = danes; 
    document.getElementById("lab6").innerHTML = "Datum pregleda:  " + danes;
    document.getElementById("datPregleda").value = d.getFullYear() + "-" + (d.getMonth() + 1) + "-" + d.getDate();
 }

/********************************nazajFunction****************************************/

function nazajFunction() {
    //alert("poglej bolnik= " + document.title);
    document.getElementById("navbar").style.display = "block"; 
    document.getElementById("prva").style.display = "none"; 
    document.getElementById("druga").style.display = "block";
    document.getElementById("tretja").style.display = "none";
    document.getElementById("cetrta").style.display = "none"; 	
    document.getElementById("nazaj").style.display = "none";
    document.getElementById("natisni").style.display = "none"; 	
    document.getElementById("predogled").style.display = "block";
	document.getElementById("najdiZapis").style.display = "none";	
	//document.getElementById("submitFrm").style.display = "none";
	if(document.getElementById("submitFrm")==undefined){}//alert("submitFrm nedefinirana 356");
	else{document.getElementById("submitFrm").style.display = "none";} 	

    //document.getElementById("prijavi").style.display = "none"; 
    if(document.getElementById("prijavi")==undefined){}//alert("prijavi nedefinirana 359");
    else{document.getElementById("prijavi").style.display = "none";}
 }

/*******************************ogledFunction**************************************/

function ogledFunction() { 
  //alert("poglej bolnik= " + document.title);
  document.getElementById("navbar").style.display = "block"; 
  document.getElementById("prva").style.display = "none"; 
  document.getElementById("druga").style.display = "none";
  document.getElementById("tretja").style.display = "block";
  document.getElementById("cetrta").style.display = "none"; 
  document.getElementById("predogled").style.display = "none";
  document.getElementById("natisni").style.display = "block"; 
  document.getElementById("nazaj").style.display = "block";
  document.getElementById("prenos").style.display = "block";
  document.getElementById("najdiZapis").style.display = "none";   
  //document.getElementById("submitFrm").style.display = "block";
  if(document.getElementById("submitFrm")==undefined){}//alert("submitFrm nedefinirana 372");
  else{document.getElementById("submitFrm").style.display = "block";}  

  //document.getElementById("prijavi").style.display = "block";
  if(document.getElementById("prijavi")==undefined){}//alert("prijavi nedefinirana 375");
  else{document.getElementById("prijavi").style.display = "block";}
 }

/********************************pomocFunction***************************************/

function pomocFunction() {
  var pot = "\\\\hospital.local\\dfs\\EIT\\premedikacija\\pregledani bolniki";
  prompt("Če ni nastavljena pot do  ciljne mape za PDF jo nastavi.\nSkopiraj spodnji naslov in ga prilepi kot pot.", pot );
 }

/***********************************administraceFunction*****************************************/

function administraceFunction(){
//alert("miš nekaj dela");	
   $.ajax({
     url : '../skupne/sessionKontrola.php',
     type : 'POST',
     success : function (result) {
        console.log (result); // Here, you need to use response by PHP file.           
		$("#prijavi").css("visibility", result); //prevzame display iz administracije
     },
     error : function () {
        console.log ('error');
     }

   });
}

