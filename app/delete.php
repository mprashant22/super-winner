<?php
require_once '/var/www/html/shopifyDemoLamp/includes/db/db_connection.php';
if(isset($_POST['ids']))
{
$id=$_GET['ids'];
echo "id==".$id;
$query1=pg_query("delete from store where storeid='$id'");
if($query1)
{
header('location:index.php');
}
}
?>