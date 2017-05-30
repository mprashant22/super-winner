<?php

require __DIR__ . '../../config/conf.inc.php';

class DB_Conenction {
    
    protected $connection;
    
    public function connect()
    {
        echo "inside db connect"; 
    	
            $this->connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        
       
            if($this->$connection)
            {
            	echo 'CONNNNNECTED';            	
            }
            else {
            	echo 'NOPE NOT CONNECTED';
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
        
        
            $connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            mysqli_query($connection, $query) or die(mysqli_error($connection));
            
            return mysqli_insert_id($connection);
        	if($connection)
        		echo "conn established";
        	else
        		echo 'not established';
        
        }
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

