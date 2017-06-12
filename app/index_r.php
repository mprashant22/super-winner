<?php 
$servername = "localhost";
$username = "root";
$password = "";
$conn = mysqli_connect($servername, $username, $password); 
?>
<!DOCTYPE html>
<html>
<head>
<title>Page Title</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>

<form id="myform">
<input type="checkbox" name="ckecklist[]" value="store1">
<input type="checkbox" name="ckecklist[]" value="store2">
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