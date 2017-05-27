<?php

require __DIR__ . '../../config/conf.inc.php';

class DB_Conenction {
    
    protected $connection;
    
    public function connect()
    {
        echo "inside db connect"; 
    	if (APP_ENV == "local") {
            $this->connection = mysql_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        } elseif (APP_ENV == "heroku") { echo 'heroku connect';
        	$this->connection = pg_connect("host=" . DB_HOST . " port=". DB_PORT. " dbname=" . DB_NAME . " user=" . DB_USER . " password=" . DB_PASS);
        }
        
        return $this->connection;
   }
    
    public function add($table, $data)
    {
    	echo "inside db add"; 
    	$query = "INSERT INTO $table ";
        
        $columns = [];
        $values = [];
        foreach($data as $column => $value) {
            $columns[] = $column;
            $values[] = $value;
            
            echo 'col:'.$column;
            echo 'val:'.$value;
            
        }
        
        $query .= "(" . implode(", ", $columns) . ")";
        $query .= "VALUES(" . implode(", ", $values) . ")";
        
       // if (APP_ENV == "local") {
            $connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            mysqli_query($connection, $query) or die(mysqli_error($connection));
            
            return mysqli_insert_id($connection);
       // } elseif (APP_ENV == "heroku") {echo "heroku vala";
        	//$connection = pg_connect("host=" . DB_HOST . " port=". DB_PORT. " dbname="  . DB_NAME . " user=" . DB_USER . " password=" . DB_PASS);
        	if($connection)
        		echo "conn established";
        	else
        		echo 'not established';
//             $result = pg_query($connection, $query) or die(pg_errormessage($connection) . " $query");
            
//             return pg_last_oid($result);
//         }
    }
    
    public function update($table, $data, $criteria)
    {
        $query = "UPDATE $table SET ";
        
        $columns = [];
        foreach($data as $column => $value) {
            $columns[] = "$column = $value";
        }
        
        $query .= implode(", ", $columns) . ")";
        
        if (!empty($criteria)) {
            $query .= " WHERE $criteria";
        }
        
        if (APP_ENV == "local") {
            $connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            mysqli_query($connection, $query) or die(mysqli_error($connection));
            
            return mysqli_insert_id($connection);
        } elseif (APP_ENV == "heroku") {
        	$connection = pg_connect("host=" . DB_HOST. " port=". DB_PORT. " dbname=" . DB_NAME . " user=" . DB_USER . " password=" . DB_PASS);
            $result = pg_query($connection, $query);
            
            return $result;
        }
    }
    
    public function select($table_name, $columns = "*", $criteria = null)
    {
    	echo "inside db select".$table_name; 
    	$query = "SELECT $columns FROM $table_name";
        
        if (!empty($criteria)) {
            $query .= " WHERE $criteria";
        }
        
        if (APP_ENV == "local") {
            $connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
            
            return mysqli_fetch_all($result);
        } elseif (APP_ENV == "heroku") {
        	$connection = pg_connect("host=" . DB_HOST. " port=". DB_PORT. " dbname=" . DB_NAME . " user=" . DB_USER . " password=" . DB_PASS);
            $result = pg_query($connection, $query);
            
            return pg_fetch_all($result);
        }
    }
    
}

