
//------------------------------BMI-----------------------------------------
var visina;
var teza;
var BMI;

function bmiFunction()
{
    teza = document. getElementById('teza').value;
    visina = document. getElementById('visina').value;

    teza = validacija(teza);
    visina = validacija(visina);

    document.getElementById('teza').value = teza;
	if (visina>3){
		visina="";
		alert("Visina mora biti navedena v metrih!");
	}else{
          document.getElementById('visina').value = visina;
         }
     //window.alert ("1teža" + teza);
     //window.alert ("1višina" + visina);
    if (visina!=0 && teza!=0) {
        //window.alert ("2teža" + teza);
        //window.alert ("2višina" + visina);
        BMI = Math.round(teza/(visina*visina));
        //window.alert ("BMI= " + BMI);
        document.getElementById('bmi').value=BMI;
    } else {
        // window.alert ("BMI2= " + BMI);
        document.getElementById('bmi').value="";
    }
}



function validacija(input) {
    if (input < 0) {
        return 0;
    }

    if (input == "NaN") {
        return 0;
    }

    return input.replace(",", ".");
}

//----------------------------konec BMI--------------------------------------------

  //................ Izračun starosti.............
  

  var dateParts;
  var starost;
  var datRojstva;

 function starostFunction()
 {
var dan = document.getElementById("dan").value ;
var mesec = document.getElementById("mesec").value ;
var leto =  document.getElementById("leto").value ;
if(dan*mesec*leto >0){

 datRojstva = dan + "." + mesec + "." + leto;
  var dateParts = datRojstva.split(".");  

/*  datRojstva = document.getElementById("dan").value ;
  datRojstva = datRojstva + "." + document.getElementById("mesec").value ;
  datRojstva = datRojstva + "." +  document.getElementById("leto").value ;*/


  //var dateParts = datRojstva.split(".");  
//alert (dateParts);

//............ month is 0-based, that's why we need dataParts[1] - 1  roj = dateObject.......
 document.getElementById("datRojstva").value = leto + "-" + mesec + "-" + dan; 
  var roj =  new Date(+dateParts[2], dateParts[1] - 1, +dateParts[0]); 
//alert (datRojstva);
  var d1 = Date.parse(roj);
  var d2 = Date.parse(Date());
  var d3 = d2 - d1;
  var n = 1000*60*60*24*365.25;
// window.alert ("n= " + n);
  var starost = ~~(d3 / n);
 //window.alert (starost);
  document.getElementById("starost").value = starost; 
}
}
//---------------------------konec izračuna starosti---------------