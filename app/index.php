<link href="../templates/bootstrap.css" rel="stylesheet" type="text/css">
<link href="../templates/bootstrap.min.css"  rel="stylesheet" type="text/css">


<?php
echo "in   app  index";
require __DIR__. '../../includes/utils/Shopify.php';
require __DIR__. '../../includes/db/Stores.php';
require __DIR__. '../../app/Export_Sync.php';
echo 'neche';
if(isset($_POST['SYNC']))
{
	echo 'xx'; 
	$Inv = new Export_Sync();
	  	$Inv->sync();
	  	
	  	
	  	header("location:install/index.php");
	  	//echo  '{'.$_REQUEST['shop']."]]";
	  	
	
}

?>



<form action='' method='post' enctype="multipart/form-data">
Select csv to upload:
<input type="file" id="browse" name="fileToUpload" style="display: none" onChange="Handlechange();" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"/>
<input type="text" id="filename" readonly="true"/>
<input type="button" value="EXPORT" id="fileToUpload" onclick="HandleBrowseClick();"/>
<input type="submit" name="SYNC" value="SYNC">
</form>

<script>
function HandleBrowseClick()
{
    var fileinput = document.getElementById("browse");
    fileinput.click();
}
function Handlechange()
{
    var fileinput = document.getElementById("browse");
    var textinput = document.getElementById("filename");
    textinput.value = fileinput.value;
}
</script>
