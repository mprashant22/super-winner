<?php
echo "in upload";
$target_dir = dirname(getcwd()).DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR;




echo 'Trdr>'.$target_dir;


$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
echo "trget file>><pre>".$target_file."</pre>";
$uploadOk = 1;
$csvFileType = pathinfo($target_file);
echo "extension>>".$csvFileType['extension'];
print_r($csvFileType);

if(isset($_POST["submit"])) {
	
	if($csvFileType['extension']=='csv')
	{
		echo "File is an csv.";
		$uploadOk = 1;
	} else {
		echo "File is not an csv.";
		$uploadOk = 0;
	}
}
// Check if file already exists
// if (file_exists($target_file)) {
// 	echo "Sorry, file already exists.";
// 	$uploadOk = 0;
// }
// Check file size
// if ($_FILES["fileToUpload"]["size"] > 500000) {
// 	echo "Sorry, your file is too large.";
// 	$uploadOk = 0;
// }






// Check if $uploadOk is set to 0 by an error
// if ($uploadOk == 0) {
// 	echo "Sorry, your file was not uploaded.";
// 	// if everything is ok, try to upload file
// } else {
if(isset($_POST['submit']))
move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], '/var/www/html/shopifyDemoLamp/uploads/'.basename($_FILES["fileToUpload"]["name"]));

// 	echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
// 	} else {
// 		echo "Sorry, there was an error uploading your file.";
// 	}
//}

?>
		 
		
<form action="" method="post" enctype="multipart/form-data">
    Select csv to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload CSV" name="submit">
</form>		