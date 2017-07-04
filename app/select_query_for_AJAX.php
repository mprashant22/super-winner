<?php
// Test if our data came through
if (isset($_POST["points"])) {
	// Decode our JSON into PHP objects we can use
	$points = json_decode($_POST["points"]);
	// Access our object's data and array values.
	//echo "Data is: " . $points->data . "<br>";
	echo $points->arPoints[0]->x ;
	echo "<br>";
	echo $points->arPoints[0]->y;
	echo "<br>";
	echo $points->arPoints[0]->z;
	echo "<br>";
	echo $points->arPoints[0]->p;
}

?>