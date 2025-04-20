
function otroskaFunction(){
	   let teza = document. getElementById('teza').value;
//alert('teza'+teza);
//document.getElementById('tezaPremedikacijaId').setAttribute("value",teza);
		document.getElementById('tezaPremedikacijaId').value=teza;	
		document.getElementById('doziranje').style.display='block';
// Get the modal
let modal = document.getElementById('doziranje');
// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}//od window.onclick
}//od function otroska
	


function schovej(a){
//alert (a);
document.getElementById(a).style.display='block';
// Get the modal
var modal = document.getElementById(a);
// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}//od window.onclick
}//od function schovej


function posli(){
	document.getElementById('otroskaFrm').submit();
}

function premedikacijaFunction(premedikacija, navodila){
	document.getElementById('premedPredOp').innerText= premedikacija;
	document.getElementById('navodila').innerText= navodila;
	alert("premedikacija alert");
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
}