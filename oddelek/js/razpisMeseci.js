//izbira meseca 
function myFunction(a, b) {
  switch(b) {
	case "dez":
    document.getElementById("slika").innerHTML = '<iframe id="tabela"  name="plugin" src=" ' + 'dezurstva/mesPdf/' + a + '.pdf ">' +  '</iframe> ' ;
    break;
  case "raz":
    document.getElementById("slika").innerHTML = '<iframe id="tabela"  name="plugin" src=" ' + 'razpis/mesPdf/' + a + '.pdf ">' +  '</iframe> ' ;
    break;
  }
}