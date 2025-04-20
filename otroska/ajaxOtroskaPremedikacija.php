<?php	

if (!empty($_REQUEST['function']) && function_exists($_REQUEST['function'])) {
	$function = $_REQUEST['function'];
	$function();
} else {
	echo json_encode(["error" => "Funkcija ne obstaja"]);
	die();
}

function premedikacija() 
{
	echo json_encode([
		"test1" => "bla bla",
		"test2" => 123123
	]);
}	

