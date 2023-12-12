<?php
require_once("./Entities/product.class.php");
require_once("./Entities/category.class.php");
?>

<?php
include("header.php");
if(!isset($_GET["cateid"])){
    $prods = Product::list_product();
}
else {
    $cateid = $_GET["cateid"];
    $prods = Product::list_product_by_cateid($cateid);
}
$cates = Category::list_category();


//thiet ke man hinh sao cho dep mat


?>
<div class="container text-center">
    <div class="col-sm-3">
        <h3>Danh muc</h3>
        <ul class="list-group">
            <?php
                foreach($cates as $item){
                    echo "<li class='list-group-item'>
                        <a href=./list_product.php?cateid=".$item["CateID"].">".$item["CategoryName"]."</a>
                    </li>";
                } ?>
        </ul>
    </div>
    <div class="col-sm-9">
    <h3>San pham cua hang</h3>
    <div class="row">
        <?php
        foreach ($prods as $item){
        ?>
        <div class="col-sm-4">
        <a href="./product_detail.php?id=<?php echo $item["ProductID"]; ?>">
                            <img src="<?php echo "./".$item["Picture"];?>" alt="image" style="width:100%" class="img-responsive">
                    </a>
            <p class="text-danger"><?php echo $item["ProductName"]; ?></p>
            <p class="text-info"><?php echo $item["Price"]; ?></p>
            <p>
                <button class="btn btn-primary" onclick="location.href='./shopping_cart.php?id=<?php echo
                $item["ProductID"];?>'">Mua hang</button>
            </p>
        </div>
        <?php } ?>
    </div>
    </div>
    
</div>
<?php include("footer.php"); 