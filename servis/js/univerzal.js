let tabulka;
function izborFunction(akce, tabulka) {
//alert(tabulka);
  document.getElementById("akceId").value = akce;
switch(akce) {
  case "vyber":
// omogoči izbiro bolnišnice
/********************************************************
koda

*********************************************************/
  document.getElementById("tabSent").innerHTML = '<input type="hidden" name="tabulka" value="'+tabulka+'">';
  document.getElementById("posli").innerHTML = '<input class="submit" type="submit" name="submit" value="potrdi">'; //submit
    break; 

  case "vloz":
/***********************************************************
KODA


********************************************************/
    break;

  case "edit":
//alert("v JS case edit");
  if(document.getElementById("osebe")!=null){
     document.getElementById("osebe").addEventListener("click", functionOver);
    }
  break;

  case "odstrani": 
  if ( confirm("Odstranim en zapis?") == true) {
    if(document.getElementById("osebe")!=null){
    return document.getElementById("osebe").addEventListener("click", functionOver);
      }
    }else{
     text = "You canceled!";
         }
  break;	
  default:
 }//od switch

//----------------------------------------------------------------------------------------
function functionOver (e) {
let x = e.target;
if(x.nodeName == "TD") {
  let y = event.composedPath()[1];
  row_value = y.cells[0].innerHTML;
  document.getElementById("demo3").innerHTML = "id v bazi je= " + row_value ; 
 //return;
//alert(tabulka);   
  window.location.href = "manipulaceObjektUniverzal.php?akce=" + x.innerHTML + "&id=" + row_value + "&tabulka=" + tabulka;
  }//od if 
}//od function(e)
} // od izborFunction