<?php
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");

echo'
<!DOCTYPE html>
<html lang="cs-SI"> 
<head>
   <meta http-equiv="Content-Type" content="text/html;charset=utf-8_general_ci" />
   <meta name="keywords" content="anestezija,Izola,hollan" />
   <meta http-equiv="refresh" content="0;url=frontend/menuFile1.php" />
   <title>Anestiz</title>  
   <link rel="shortcut icon" href="favicon.ico?'.time().'">
</head>
 <body>
</body>  
</html>
';
?>