<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "demo";

// Create connection

$checkarr = @$_POST["ckecklist"];
$store1 = $checkarr[0];
$store2 = $checkarr[1];

$conn = mysqli_connect($servername, $username, $password,$dbname);

$sql = "SELECT * FROM $store2";
$result = mysqli_query($conn,$sql);
while($row = mysqli_fetch_assoc($result)) {
?>
  <?php echo $row["id"]; ?>
<?php
}
?>

<?php
$sql = "SELECT * FROM $store1";
$result = mysqli_query($conn,$sql);
while($row = mysqli_fetch_assoc($result)) {
?>
  <?php echo $row["id"]; ?>
<?php
}
?>