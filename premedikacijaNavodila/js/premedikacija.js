
function ajax_sprememba(){
	var ucinkovina = $(".ucinkovina:radio:checked").val();		
//	var ucinkovina = $(":radio:checked").val();	
//	var ucinkovina = $("input[name='ucinkovina']:checked").val();	
	var teza = $("#tezaPremedikacijaId").val();
	var sprememba = $("#sprememba").val();
	ajax_aktualizuj(ucinkovina, teza, sprememba);	
}

function ajax_get_premedikacija(elem) {
	$elem = $(elem);	
	var ucinkovina = $elem.val();
	var teza = $("#tezaPremedikacijaId").val();
	var sprememba = $("#sprememba").val();
	ajax_aktualizuj(ucinkovina, teza, sprememba);
}

function ajax_aktualizuj(ucinkovina, teza, sprememba){
	//alert(window.location.hostname);
	if(window.location.hostname=="localhost"){
		koren="anestiz/";		
	}else{
		koren="";
	}
		$.ajax({
//za web
		//url: "/premedikacijaNavodila/otroskaPremedikacija1.php",
//za localhost
		//url: "/anestiz/premedikacijaNavodila/otroskaPremedikacija1.php",
		url: "/"+koren+"premedikacijaNavodila/otroskaPremedikacija1.php",	
		data: {
			"ucinkovina": ucinkovina,
			"teza": teza,
			"sprememba": sprememba
	 	},
		method: "GET",
		dataType: "json",
		cache: false,

	})
	.done(function( rsp ) {
		if (rsp.error !== undefined && rsp.error.length !== 0) {
			alert(rsp.error);
		} else {
			$("#navodila").html(rsp.navodila);
			$("#premedPredOp").html(rsp.premedikacija);
		}		
	});	
}