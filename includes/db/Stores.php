<?php

require 'db_connection.php';

class Stores extends DB_Connection{
    
    private $table_name = "stores1";
    
    public function __construct()
    {
         $this->connect();
    }

    public function addData($data)    {
    	
    	print_r($data);
        return $this->add($this->table_name, $data);
    }
    
    public function updateData($data, $criteria)
    {
    	return $this->update($this->table_name, $data, $criteria);
    }


    public function is_shop_exists($shop)
    {
      echo 'inside IS SHOP >> '.$shop;
    	return $this->select($this->table_name, "*", "store_url = '$shop'");
    }
    
}