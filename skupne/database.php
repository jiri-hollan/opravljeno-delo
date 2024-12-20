 <?php
class Database {
	public $servername = '';
	public $username = '';
	public $password = '';
	public $dbname = '';
	public $connn = '';
	public $bolnikObstaja= '';
	public Function __construct(){
	require 'streznik.php';
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

	public function  vloz($tabulka,$data){
       $sloupce = array();
	   $hodnoty = array();
	   $parametry = array();
	   if (is_array($data)) {
		foreach ($data as $sloupec => $hodnota) { 
		 array_push($sloupce, $sloupec);
         array_push($hodnoty, '?');
		 array_push($parametry, $hodnota);		   
	   }		
	}
    $sloupceSQL = implode(', ', $sloupce);
    $hodnotySQL = implode(',  ', $hodnoty);
/*	echo '<br>sloupce: '.$sloupceSQL.'<br>';
	echo 'hodnotySQL: '.$hodnotySQL.'<br>';
	echo 'parametry: '.var_dump($parametry).'<br>';
	*/
    $dotaz = $this->conn->prepare("INSERT INTO $tabulka ($sloupceSQL) VALUES ($hodnotySQL)");

  try {
	  $dotaz->execute($parametry);
	  $pocetVlozenych = $dotaz->rowCount();	 
	  $lastId = $this->conn->lastInsertId();
	  //var_dump($lastId);
	  
  } catch (PDOException $e) {
	  echo $e->getMessage();
	  $pocetVlozenych = false;
	  $lastId =  false;
  }
      $vlozeno['pocetVlozenych'] = $pocetVlozenych;
	  //var_dump ($vlozeno);
	  $vlozeno['lastId'] = $lastId;
	 // echo $pocetVlozenych . 'zadnji Id: '. $vlozeno['lastId'];
  //return $pocetVlozenych;
    return $vlozeno;
}
//.........konec vloz.................................................................

	public function aktualizuj($tabulka,$data,$podminka){
	  $sloupceHodnoty =array();
      $parametry = array();	
	  if (is_array($data) && !empty($data)) {
		foreach ($data as $sloupec => $hodnota) {
		  array_push($sloupceHodnoty, " $sloupec = ?");
          array_push($parametry, $hodnota);		  
		} //od foreache 

	  } else {
		  return 0;
	  }//od else
	  $sloupceHodnotySQL = implode(', ', $sloupceHodnoty);
  //var_dump ($sloupceHodnotySQL);
      $podminkaSQL = '';
	  if (is_array($podminka)) {
		$i = 0;
        foreach ($podminka as $sloupec => $hodnota)	{
			if ($i == 0) {
			  $podminkaSQL .=" WHERE $sloupec = ?";
			} else {
			  $podminkaSQL .= " AND $sloupec = ?";
			}//od else
			array_push($parametry, $hodnota);
		    $i++;
		}// od foreach
	//var_dump ($parametry);	
  //var_dump ($podminkaSQL);		
	  } else {
		 // return;
	  }
	  
	  
	  $dotaz = $this->conn->prepare("UPDATE $tabulka SET $sloupceHodnotySQL".$podminkaSQL);
  //var_dump ($dotaz);	  
	  try {
		 $dotaz->execute($parametry);
         $pocetAktualizovanych = $dotaz->rowCount();		 
	  } catch (PDOException $e) {
		  echo $e->getMessage();
		  $pocetAktualizovanych = false;
	  }//od catch
	   return $pocetAktualizovanych;
	  
	}//od function aktualizuj		
//...........konec aktualizuj................................

	
	public function odstrani($tabulka,$podminka){	
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
	  
	$dotaz = $this->conn->prepare("DELETE FROM $tabulka".$podminkaSQL);
	try {
	  $dotaz->execute($parametry);
	  $pocetOdstranenych = $dotaz->rowCount();	
	} catch (PDException $e) {
		echo $e->getMessage();
		$pocetOdstranenych = false;
	}//od catch
	
	return $pocetOdstranenych;
	}// od function odstrani		
//......konec odstrani......................

public function testirajBolnik() {
try {
  $kje='Tables_in_'.$this->dbname;
  $sql = "SHOW TABLES FROM $this->dbname  WHERE $kje LIKE 'bolnikTbl' OR $kje LIKE 'omejitveTbl'";
  $statement = $this->conn->prepare($sql);   
  $statement->execute();
  $tables = $statement->fetchAll(PDO::FETCH_BOTH);
// var_dump($tables);
  $bolnikObstaja=count($tables);
  $this->bolnikObstaja = $bolnikObstaja;
   return $this;
}

catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
    }
$conn = null;
}//uzavírací zavorky function testrajBolnik
//-------------------konec function testraj

	
}//uzavírací zavorky class Database