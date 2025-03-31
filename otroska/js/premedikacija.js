function modalna(a=''){
	alert("modalna "+a+" kg");
	document.getElementById('doziranje').style.display='block';
	// Get the modal
let modal = document.getElementById('doziranje');
// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}//od window.onclick
}//od function modalna

/*

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
*/
