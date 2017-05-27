<link href="../templates/bootstrap.css">
<link href="../templates/bootstrap.min.css">
<?php

require '../includes/utils/Shopify.php';
require '../includes/db/Stores.php';

$Shopify = new Shopify();
$Stores = new Stores();

$shop = $_GET['shop'];
$shop_info = $Stores->is_shop_exists($shop);

//echo "<pre>";
//print_r($shop_info);
//echo "</pre>";

//echo "access token is: " . $shop_info[0]['access_token'];
$orders = $Shopify->get_orders($shop, $shop_info[0]['access_token']);

//echo "<pre>";
//print_r($orders);
//echo "</pre>";

?>

<?php include 'header.php'; ?>

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Orders</h1>
    </div>
    <!-- /.col-lg-12 -->
    <div class="col-lg-12">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Total Price</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($orders->orders as $order) { ?>
                <tr>
                    <td><?= $order->id ?></td>
                    <td><?= $order->name ?></td>
                    <td><?= $order->total_price ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<?php include 'footer.php'; ?>