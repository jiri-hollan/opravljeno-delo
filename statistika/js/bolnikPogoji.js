function intervalFunction(danes) {
    console.log("bolnikPogoji.js  linija 2 danes:"+danes);
  let zacDatum= '<label for="zacDatumId">od: </label><input type="date" id="zacDatumId" name="zacDatum" value='+danes+' >';
  let koncDatum= '<label for="koncDatumId">do: </label><input type="date" id="koncDatumId" name="koncDatum" value='+danes+' >';
  let semafor= '<input type="hidden" id="semaforId" name="semafor" value="pregledovalecDatum" >';
     console.log("bolnikPogoji.js  linija 5 danes:"+danes); 
//alert(danes); 
  document.getElementById("pogojId").innerHTML = "<div class='glavni'>"+ semafor + zacDatum + koncDatum +"<div class='notranji'>"+ "</div></div>" ;
  document.getElementById("posli").innerHTML = '<input type="submit" name="submit" value="Submit"><input type="reset" name="reset" value="Reset">'; //submit+reset
}