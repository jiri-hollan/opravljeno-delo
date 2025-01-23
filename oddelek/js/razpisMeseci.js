//izbira meseca 
function myFunction(a, b) {
	c = Math.floor(Math.random() * 100);
  switch(b) {
	case "dez":
    document.getElementById("slika").innerHTML = '<iframe id="tabela"  name="plugin" src=" ' + 'dezurstva/mesPdf/' + a + '.pdf?'+c+'">' +  '</iframe> ' ;
    break;
  case "raz":
    document.getElementById("slika").innerHTML = '<iframe id="tabela"  name="plugin" src=" ' + 'razpis/mesPdf/' + a + '.pdf ">' +  '</iframe> ' ;
    break;
  }
}