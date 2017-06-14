<?php
echo "in upload";
$target_dir = "/var/www/html/shopifyDemoLamp/"."uploads/";
__DIR__=== $target_dir;
mkdir("uploads", 0700);
echo "<pre>".$target_dir."</pre>";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
echo "<pre>".$target_file."</pre>";
$uploadOk = 1;
$csvFileType = pathinfo($target_file);
echo "extension".$csvFileType['extension'];
print_r($csvFileType);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
	
	if($csvFileType['extension'])
	{
		echo "File is an csv.";
		$uploadOk = 1;
	} else {
		echo "File is not an csv.";
		$uploadOk = 0;
	}
}
// Check if file already exists
if (file_exists($target_file)) {
	echo "Sorry, file already exists.";
	$uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
	echo "Sorry, your file is too large.";
	$uploadOk = 0;
}

?>
		 
		
<form action="" method="post" enctype="multipart/form-data">
    Select csv to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload CSV" name="submit">
</form>		