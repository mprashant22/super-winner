<?php 
$host = "localhost";
$username = "root";
$password = "e3828e583f915c60dcaea9ed125420284a8c8fa3bb8ec463";
$dbname = "shopifyApp";
$conn = mysqli_connect($host, $username, $password,$dbname); 
if($conn)
{
	echo 'connected';	
}
else
{
	echo 'not connected';
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Page Title</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>

<form id="myform">
<input type="checkbox" name="checklist[]" value="stores">
<input type="checkbox" name="checklist[]" value="stores">
</form>

<script>
	$(document).ready(function(){
    $("#myform").change(function(){
     var myform = document.getElementById("myform");
    var fd = new FormData(myform );
    $.ajax({
        url: "demo.php",
        data: fd,
        cache: false,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function (dataofconfirm) {
            $("#demo").html(dataofconfirm);
        }
     });
    });
   });
</script>
<div id="demo">	
</div>
<style>
	#demo font{display: none;}
</style>

</body>
</html>