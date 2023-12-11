<?php
require_once("./Entities/product.class.php");
require_once("./Entities/category.class.php");
if(isset($_POST["btnsubmit"])){
    //lay gia tri tu foem
    $productName =$_POST["txtName"];
    $cateID =$_POST["txtCateID"];
    $price =$_POST["txtprice"];
    $quantity =$_POST["txtquantity"];
    $description =$_POST["txtdesc"];
    $picture =$_FILES["txtpic"];
    //khoi tao o product
    $newProduct = new Product($productName,$cateID, $price, $quantity, $description, $picture);
    //Luu xuong csdl
    $result = $newProduct->save();
    if(!$result){
        header("Location: add_product.php?failure");
    }
    else {
        header("Location: add_product.php?inserted");
    }
}
?>

<?php
include("header.php");
?>

<?php
if(isset($_GET["inserted"])){
    echo "<h2> tHEM SAN  pham thanh cong</h2>";
}
?>

<!-- form san pham -->
<form method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="lbltitle">
            <label for="">Ten san pham</label>
        </div>
        <div class="lblinput">
            <input type="text" name="txtName" value="<?php echo isset($_POST["txtName"])? $_POST["txtName"] : ""; ?>" />
        </div>
    </div>
    <!-- mo ta san pham -->
    <div class="row">
        <div class="lbltitle">
            <label for="">Mo ta san pham</label>
        </div>
        <div class="lblinput">
            <input type="txtdesc" clos="21" rows="10" name="txtdesc" value="<?php echo isset($_POST["txtdesc"])? $_POST["txtdesc"] : ""; ?>" />
        </div>
    </div>
    <!-- so luong sp -->
    <div class="row">
        <div class="lbltitle">
            <label for="">So luong san pham</label>
        </div>
        <div class="lblinput">
            <input type="number" name="txtquantity" value="<?php echo isset($_POST["txtquantity"])? $_POST["txtquantity"] : ""; ?>" />
        </div>
    </div>
    <!-- gia san pham -->
    <div class="row">
        <div class="lbltitle">
            <label for="">Gia san pham</label>
        </div>
        <div class="lblinput">
            <input type="number" name="txtprice" value="<?php echo isset($_POST["txtprice"])? $_POST["txtprice"] : ""; ?>" />
        </div>
    </div>
    <!-- Loai san pham -->
    <div class="row">
    <div class="lbltitle">
        <label for="txtCateID">Loại sản phẩm</label>
    </div>
    <div class="lblinput">
        <select name="txtCateID">
            <option value="" selected>--Chon loai --</option>
            <?php
            // Mảng chứa danh sách loại sản phẩm và mã tương ứng
            $cates = Category::list_category();
            foreach($cates as $item){
                echo "<option value=".$item["CateID"].">".$item["CategoryName"]."</option>";

            }
            
            ?>
        </select>
    </div>
</div>

    <!-- hinh anh -->
    <div class="row">
        <div class="lbltitle">
            <label for="">Hinh anh</label>
        </div>
        <div class="lblinput">
            <input type="file" id="txtpic"accept=".PNG,.GÌ,.JPG" name="txtpic" value="<?php echo isset($_POST["txtpic"])? $_POST["txtpic"] : ""; ?>" />
        </div>
    </div>

    <!-- Nut gui foem -->

    <div class="row">
        <div class="submit">
            <input type="submit" name="btnsubmit" value="Them san pham"/>
        </div>
    </div>
</form>

<?php
include("footer.php");
?>