 <?php
class DatabaseS {
	public $servername = '';
	public $username = '';
	public $password = '';
	public $dbname = '';
	public $connn = '';
	public $bolnikObstaja= '';
	public Function __construct(){
	require '../../skupne/streznik.php';
      //$this->servername = "sh17.neoserv.si";
		$this->conn = new PDO("mysql:host=" . $this->servername . ";dbname=" . $this->dbname . ';charset=UTF8', $this->username, $this->password);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);		
	}//uzavírací zavorky __construct	
//-----------------konec construct--------------

	public function vyber($tabulka, $sloupce, $podminka = NULL, $poradi = NULL){
	$sloupceSQL = implode(', ', $sloupce);
	//echo '<br>'.$sloupceSQL;
	$podminkaSQL = '';
	$parametry = array();
	$poradiSQL = '';
	if (is_array($podminka)){
		$i = 0;
		foreach ($podminka as $sloupec=>$hodnota){
			if ($i == 0){
				$podminkaSQL .=" WHERE $sloupec = ?";				
			}else {
				$podminkaSQL .=" AND $sloupec = ?";
			}
			$parametry[$i] = $hodnota;
			$i++;
		}
	}
	if ($poradi!=NULL){
	   $poradiSQL = " ORDER BY " . $poradi;	
	}

	//echo $poradiSQL;
	// echo '<br>';
	// echo var_dump($parametry) . "<br>";
	 // echo var_dump($podminka) . "<br>";
	 // echo var_dump($podminkaSQL );
	$dotaz = $this->conn->prepare("SELECT $sloupceSQL FROM $tabulka". $podminkaSQL. $poradiSQL);
	//var_dump($dotaz);
	try {
		$dotaz->execute($parametry);		
		$zaznamy = $dotaz->fetchAll(PDO::FETCH_ASSOC);
		//echo '<br>v try vyber';
	  }catch (PDException $e) {
		  echo $e->getMessage();
		  $zaznamy = false;
	  }
	  
	  $dotaz->closeCursor();
	  return $zaznamy;
	}
//............konec vyber.............................................................

	public function vyberOr($tabulka, $sloupce, $podminka = NULL){
	$sloupceSQL = implode(', ', $sloupce);
	$podminkaSQL = '';
	$parametry = array();
	
	if (is_array($podminka)){
		$i = 0;
		foreach ($podminka as $sloupec=>$hodnota){
			if ($i == 0){
				$podminkaSQL .=" WHERE $sloupec = ?";				
			}else {
				$podminkaSQL .= " OR $sloupec = ?";
			}			
			$parametry[$i] = $hodnota;
			$i++;
		}
	}
	
	/*echo var_dump($parametry) . "<br>";
	  echo var_dump($podminka) . "<br>";
	  echo var_dump($podminkaSQL . "<br>");*/
	$dotaz = $this->conn->prepare("SELECT $sloupceSQL FROM $tabulka". $podminkaSQL);
	
	try {
		$dotaz->execute($parametry);		
		$zaznamy = $dotaz->fetchAll(PDO::FETCH_ASSOC);
	  }catch (PDException $e) {
		  echo $e->getMessage();
		  $zaznamy = false;
	  }
	  
	  $dotaz->closeCursor();
	  return $zaznamy;
	}
//..............konec vyberOr.......................................................
public function vyberIn($tabulka, $sloupce, $podminka = NULL, $vrednosti=NULL){
	$sloupceSQL = implode(', ', $sloupce);
	$podminkaSQL = '';
	$parametry = array();
   	    if (is_array($vrednosti)){
		$podminkaSQL .=" WHERE " . $podminka ." IN" . "(";	
        //var_dump($vrednosti);
        $i=0;
		foreach($vrednosti as $i => $val) {
		if ($i>0){
				$podminkaSQL .=",";		
		}	
        $podminkaSQL .="$vrednosti[$i]";
} //od foreach
	$podminkaSQL .=")";	
	//echo $podminkaSQL;
	}//od if array
	$dotaz = $this->conn->prepare("SELECT $sloupceSQL FROM $tabulka". $podminkaSQL);
	
	try {
		$dotaz->execute($parametry);		
		$zaznamy = $dotaz->fetchAll(PDO::FETCH_ASSOC);
		//var_dump($zaznamy);
	  }catch (PDException $e) {
		  echo $e->getMessage();
		  $zaznamy = false;
	  }
	  
	  $dotaz->closeCursor();
	  return $zaznamy;
	} // od public function vyberIn
//..............konec vyberIn...................................................


/**************************vyberPogoj*****************************************************/

	public function vyberPogoj($tabulka, $sloupce, $podminka = NULL, $poradi = NULL){
	$sloupceSQL = implode(', ', $sloupce);
	//echo '<br>'.$sloupceSQL;
	$podminkaSQL = '';
	$parametry = array();
	$poradiSQL = '';
	if (is_array($podminka)){
		$i = 0;
		foreach ($podminka as $sloupec=>$hodnota){
			if ($i == 0){
				$podminkaSQL .=" WHERE $sloupec ?";				
			}else {
				$podminkaSQL .=" AND $sloupec  ?";
			}
			$parametry[$i] = $hodnota;
			$i++;
		}
	}
	if ($poradi!=NULL){
	   $poradiSQL = " ORDER BY " . $poradi;	
	}

	//echo $poradiSQL;
	// echo '<br>';
	// echo var_dump($parametry) . "<br>";
	 // echo var_dump($podminka) . "<br>";
	 // echo var_dump($podminkaSQL );
	$dotaz = $this->conn->prepare("SELECT $sloupceSQL FROM $tabulka". $podminkaSQL. $poradiSQL);
	//var_dump($dotaz);
	try {
		$dotaz->execute($parametry);		
		$zaznamy = $dotaz->fetchAll(PDO::FETCH_ASSOC);
		//echo '<br>v try vyber';
	  }catch (PDException $e) {
		  echo $e->getMessage();
		  $zaznamy = false;
	  }
	  
	  $dotaz->closeCursor();
	  return $zaznamy;
	}
/**********************konec vyberPogoj******************************************************************************/
//....................funkcija suma v razvoju.........................................

public function suma($tabulka, $sloupce, $podminka = NULL, $poradi = NULL){
	$sloupceSQL = implode(', ', $sloupce);
	//echo '<br>'.$sloupceSQL;
	$podminkaSQL = '';
	$parametry = array();
	$poradiSQL = '';
	if (is_array($podminka)){
		$i = 0;
		foreach ($podminka as $sloupec=>$hodnota){
			if ($i == 0){
				$podminkaSQL .=" WHERE $sloupec ?";				
			}else {
				$podminkaSQL .=" AND $sloupec  ?";
			}
			$parametry[$i] = $hodnota;
			$i++;
		}
	}
	if ($poradi!=NULL){
	   $poradiSQL = " ORDER BY " . $poradi;	
	}

	//echo $poradiSQL;
	// echo '<br>';
	// echo var_dump($parametry) . "<br>";
	 // echo var_dump($podminka) . "<br>";
	 // echo var_dump($podminkaSQL );
	 
$dotaz = $this->conn->prepare("SELECT  $sloupceSQL  FROM $tabulka". $podminkaSQL. $poradiSQL. " GROUP BY datumOpravila");
	
/*	echo'<br>';
	var_dump($dotaz);
	echo'<br>';	*/
	try {
		$dotaz->execute($parametry);		
		$zaznamy = $dotaz->fetchAll(PDO::FETCH_ASSOC);
		//echo '<br>v try vyber';
	  }catch (PDException $e) {
		  echo $e->getMessage();
		  $zaznamy = false;
	  }
	  
	  $dotaz->closeCursor();
	  return $zaznamy;
	}
//............konec sum............................................................	
}//uzavírací zavorky class DatabaseS