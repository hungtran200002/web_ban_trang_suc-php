<?php include_once("header.php");
?>

<?php
require_once("./Entities/product.class.php");
require_once("./Entities/category.class.php");
$cates = Category::list_category();
//khoi dong session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
//Hien thi loi
error_reporting(E_ALL);
ini_set('display_error','1');
//Them moi san phan vao gio hang

if(isset($_GET["id"])){
    $pro_id = $_GET["id"];
    //bien xac nhan san pham da ton tai hay chua
    $was_false = false;
    $i = 0;
    //co thi tang so luong len 1
    if(!isset($_SESSION["cart_items"])|| count($_SESSION["cart_items"])<1){
        $_SESSION["cart_items"] = array(0 => array("pro_id" => $pro_id, "quantity" => 1));
    }
    else{
        //gio hang da duoc khoi tao
        //duyet tat ca san pham trong gio hang
        //Neu da ton tai san pham thi tang san p[ham len 1]
        //neu chua ton taij thi se them moi san poham voi so luong la 1
        // foreach($_SESSION["cart_items"] as $item){
        //     $i++;
        //     while(list($key,$value) = each($item)){
        //         if($key=="pro_id" && $value==$pro_id){
        //             //san pham da ton tai trong gio hang tang so luong len 1
        //             array_splice($_SESSION["cart_items"], $i-1, 1, array(array("pro_id" =>$pro_id,"quantity" =>
        //             $item["quantity"]+1)));
        //             $was_false=true;
        //         }
        //     }
        // }
        foreach ($_SESSION["cart_items"] as $i => $item) {
            foreach ($item as $key => $value) {
                if ($key == "pro_id" && $value == $pro_id) {
                    // Product already exists in the cart, increase quantity by 1
                    $_SESSION["cart_items"][$i]["quantity"] += 1;
                    $was_false = true;
                }
            }
        }
        
        if($was_false == false){
            array_push($_SESSION["cart_items"], array("pro_id" => $pro_id, "quantity" =>1));
        }
    }
    header("location: shopping_cart.php");
}

?>
<!-- thong tin tang shopping cart -->
<div class="container text-center">
    <div class="col-sm-3">
        <h3>Danh muc</h3>
        <ul class="list-group">
            <?php
            foreach($cates as $item){
                echo "<li class='list-group-item'>
                <a href=./list_product.php?cateid=".$item["CateID"].">".$item["CategoryName"]."</a></li>";
            }?>
        </ul>
    </div>
    <div class="col-sm-9">
        <h3>Thong tin gio hang</h3>
        <table class="table table-condensed">
            <thead>
                <tr>
                    <th>Ten san pham</th>
                    <th>Hinh anh</th>
                    <th>So luong</th>
                    <th>Don gia</th>
                    <th>Thanh tien</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $total_money = 0;
                if(isset($_SESSION["cart_items"])&& count($_SESSION["cart_items"])>0){
                    foreach($_SESSION["cart_items"] as $item){
                        $id = $item["pro_id"];
                        $product = Product::get_product($id);
                        $prod = reset($product);
                        $total_money += $item["quantity"]*$prod["Price"];
                        echo "<tr><td>".$prod["ProductName"]."</td><td><img style='width:90px; height:80px' src=".$prod["Picture"]."/></td><td>".$item["quantity"]."</td><td>".$prod["Price"]."</td><td>".$prod["Price"]."</td></tr>";
                    }
                    echo "<tr><td colspan=5><p class='text-right text-danger'>Tong tien: ".$total_money."</p></td></tr>";
                    echo "<tr><td colspan=3><p class='text-right '><button type='button' class='btn btn-primary'>Tiep tuc mua hang</button></p></td><td colspan=2><p class='text-right'><button type='button' class='btn btn-success'>Thanh toan</button></p></td></tr>";

                }else{
                    echo"Khong co san phan nao trong gio hang!";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<?php include_once('footer.php');?>