<link href="../templates/bootstrap.css">
<link href="../templates/bootstrap.min.css">
<?php

require '../includes/utils/Shopify.php';
require '../includes/db/Stores.php';

$Shopify = new Shopify();
$Stores = new Stores();

$shop = $_GET['shop'];
$shop_info = $Stores->is_shop_exists($shop);

if (isset($_POST['add_product'])) {
    $data = json_encode(array(
        'title' => $_POST['title'],
        'body_html' => $_POST['body_html'],
        'vendor' => $_POST['vendor'],
        'product_type' => $_POST['product_type']
    ));
    
    $new_product = $Shopify->add_product($shop, $shop_info[0]['access_token'], $data);
    echo "<pre>";
    print_r($new_product);
    echo "</pre>";
}

//echo "<pre>";
//print_r($shop_info);
//echo "</pre>";

echo "access token is: " . $shop_info[0]['access_token'];
$products = $Shopify->get_products($shop, $shop_info[0]['access_token']);

//echo "<pre>";
//print_r($products->products);
//echo "</pre>";

?>

<?php include 'header.php'; ?>

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Products</h1>
    </div>
    <!-- /.col-lg-12 -->
    <div class="col-lg-12">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products->products as $product) { ?>

                <tr>
                    <td><?= $product->id ?></td>
                    <td><?= $product->title ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<div class="row">
    <div class="col-lg-6">
        <h3>Add Product</h3>
        <form method="post" action="">
            <input type="hidden" name="add_product" value="1" />
            <div class="form-group">
                <label>Title</label>
                <input type="text" name="title" value="" class="form-control" />
            </div>
            <div class="form-group">
                <label>Body HTML</label>
                <textarea type="text" name="body_html" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <label>Vendor</label>
                <input type="text" name="vendor" value="" class="form-control" />
            </div>
            <div class="form-group">
                <label>Product Type</label>
                <input type="text" name="product_type" value="" class="form-control" />
            </div>
            <div class="form-group">
                <input type="submit" value="Submit" class="btn btn-primary btn-xs" />
            </div>
        </form>
    </div>
</div>

<?php include 'footer.php'; ?>