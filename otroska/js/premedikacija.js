function modalna(teza=''){
	alert("modalna "+teza+" kg");
	otroskaFunction()
}

function otroskaFunction(){
	   let teza = document. getElementById('teza').value;
		alert('teza'+teza);
		//document.getElementById('tezaPremedikacijaId').setAttribute("value",teza);
		document.getElementById('tezaPremedikacijaId').value=teza;		
}


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