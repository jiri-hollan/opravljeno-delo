<?php
if (isset($_GET['doma'])) {
	$doma=$_GET['doma'];
	$home = '../' . $doma . '/menuFile1.php';
} else {
	$home = '../frontend/menuFile1.php';
}
?>