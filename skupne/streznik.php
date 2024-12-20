<?php
 $this->servername = $_SERVER['SERVER_NAME'];	  
      $this->username = "anestiz";
      $this->password = "laringoskop";
      $this->dbname = "anestiz_navodila";
          if ( $_SERVER['SERVER_NAME']=="localhost") {
              $this->username = "root";
              $this->password = "";
              $this->dbname = "navodila";
            }
?>