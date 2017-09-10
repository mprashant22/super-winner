<?php

class SocialLoginSelect extends DB_Connection
{
    
    private $table_name = "socialLogin";
    public $connection = '';
    function __construct(){
        $this->connection = $this->connect();
    }
    
    public function insertToggleValue()
    {
//        echo "MATHUR";
        $F=$_POST['radio2'];
  //      echo $F;
    }
}
$obj=new SocialLoginSelect();
$obj->insertToggleValue();
$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
print_r($request);
?>