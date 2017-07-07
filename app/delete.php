<html>
<body>
<?php
include('connect.php');
if(isset($_GET['id']))
{
$id=$_GET['id'];
echo "id==".$id;
$query1=pg_query("delete from store where storeid='$id'");
if($query1)
{
header('location:index.php');
}
}
?>
</body>
</html>