<?php
require_once("./Entities/product.class.php");
?>

<?php
include("header.php");
$prods = Product::list_product();

//thiet ke man hinh sao cho dep mat


?>
<div class="container text-center">
    <h3>San pham cua hang</h3>
    <div class="row">
        <?php
        foreach ($prods as $item){
        ?>
        <div class="col-sm-4">
            <img src="<?php echo "./".$item["Picture"];?>" alt="image" style="width:100%" class="img-responsive">
            <p class="text-danger"><?php echo $item["ProductName"]; ?></p>
            <p class="text-info"><?php echo $item["Price"]; ?></p>
            <p>
                <button class="btn btn-primary">Mua hang</button>
            </p>
        </div>
        <?php } ?>
    </div>
</div>
<?php include("footer.php"); 