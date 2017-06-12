<?php
$host = "localhost";
$username = "root";
$password = "e3828e583f915c60dcaea9ed125420284a8c8fa3bb8ec463";
$dbname = "shopifyApp";

// Create connection

$checkarr = @$_POST["checklist"];
$store1 = $checkarr[0];
$store2 = $checkarr[1];

$conn = mysqli_connect($host, $username, $password,$dbname);

$sql = "SELECT * FROM $store2";
$result = mysqli_query($conn,$sql);
while($row = mysqli_fetch_assoc($result)) {
?>
  <?php echo $row["store_url"]; ?>
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