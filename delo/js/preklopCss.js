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

     document.getElementById("navbar").style.display = "block";
     document.getElementById("prva").style.display = "none"; 
     document.getElementById("druga").style.display = "block";
     document.getElementById("tretja").style.display = "none";
     document.getElementById("nazaj").style.display = "none";
     document.getElementById("predogled").style.display = "block";
     document.getElementById("novB").style.display = "block";
     document.getElementById("natisni").style.display = "block";
     document.getElementById("pomoc").style.display = "block";
     document.getElementById("submitFrm").style.display = "none";
	 document.getElementById("najdiZapis").style.display = "none";

return false;

     }
}