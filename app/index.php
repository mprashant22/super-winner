<link href="../templates/bootstrap.css" rel="stylesheet" type="text/css">
<link href="../templates/bootstrap.min.css"  rel="stylesheet" type="text/css">


<?php
echo "in   app  index";
require __DIR__. '../../includes/utils/Shopify.php';
require __DIR__. '../../includes/db/Stores.php';

$Shopify = new Shopify();
//echo '$ shopify'.$Shopify;
$Stores = new Stores();
//echo '$ stores'.$Stores;

$shop = $_GET['shop'];
$shop_info = $Stores->is_shop_exists($shop);

//echo "<pre>";
echo 'shop_info>>'.$shop_info;
//echo "</pre>";

//echo "access token is: " . $shop_info[0]['access_token'];
$products = $Shopify->get_products($shop, $shop_info[0]['access_token']);
echo 'products>>'.$products;

//echo "<pre>";
//print_r($products->products);
//echo "</pre>";

?>

<?php include 'header.php'; ?>

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Dashboard</h1>
    </div>
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-shopping-cart fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">0</div>
                        <div>Orders</div>
                    </div>
                </div>
            </div>
            <a href="orders.php?shop=<?= $shop ?>">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-product-hunt fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?= count($products->products) ?></div>
                        <div>Products</div>
                    </div>
                </div>
            </div>
            <a href="products.php?shop=<?= $shop ?>">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>