<?php
require_once("./Entities/product.class.php");
require_once("./Entities/category.class.php");
?>

<?php
include_once("header.php");
if(!isset($_GET["id"])){
    //duong dan ko dung
    //dan den trang not founf
    header('Location: not_found.php');
}
else {
    $id = $_GET["id"];
    $getpro = Product::get_product($id);
    $prod = reset($getpro);
    $prods_relate = Product::list_product_relate($prod["CateID"],$id);
}
$cates = Category::list_category();
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
    <div class="col-sm-9 panel panel-info">
        <h3 class="panel-heading">Chi tiet san pham</h3>
        <div class="row">
            <div class="col-sm-6">
                <img src="<?php echo "./".$prod["Picture"];?>" style="width:100%" alt="image" class="img-responsive">
            </div>
            <div class="col-sm-6">
                <!-- thong tin chi tiet san pham -->
                <div style="padding-left:10px">
                    <h3 class="text-info">
                        <?php echo $prod["ProductName"]; ?>
                    </h3>
                    <p>
                        Gia: <?php echo $prod["Price"]; ?>
                    </p>
                    <p>
                        Mo ta: <?php echo $prod["Description"]; ?>
                    </p>
                    <p>
                        <button type="button" class="btn btn-danger" onclick="location.href='./shopping_cart.php?id=<?php echo
                $item["ProductID"];?>'">Mua hang</button>
                    </p>
                </div>
            </div>
            <h3 class="panel-heading">San pham lien quan</h3>
            <div class="row">
                <?php foreach ($prods_relate as $item) {
                    ?>
                    <div class="col-sm-4">
                        <a href="./product_detail.php?id=<?php echo $item["ProductID"]; ?>">
                            <img src="<?php echo "./".$item["Picture"];?>" alt="image" style="width:100%" class="img-responsive">
                    </a>
                    <p class="text-danger"><?php echo $item["ProductName"];?></p>
                    <p class="text-info"><?php echo $item["Price"]; ?></p>
                    <p>
                        <button type="button" class="btn btn-primary" onclick="location.href='./shopping_cart.php?id=<?php echo
                $item["ProductID"];?>'">Mua hang</button>
                    </p>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
<?php include_once("footer.php"); ?>