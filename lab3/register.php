<?php include_once("header.php")?>
<?php
if(isset($_SESSION['user'])!=""){
    header("Location: index.php");
}
require_once("./Entities/user.class.php");
//kiem tra gia tri duoc gui tu form dang ky

if(isset($_POST['btn-signup'])){
    // Check if all required fields are filled
    if(empty($_POST['txtname']) || empty($_POST['txtemail']) || empty($_POST['txtpass'])) {
        ?>
        <script>alert('Vui lòng điền đầy đủ thông tin!');</script>
        <?php
    } else {
        $u_name = $_POST['txtname'];
        $u_email = $_POST['txtemail'];
        $u_pass = $_POST['txtpass'];
        
        $account = new User($u_name, $u_email, $u_pass);
        $result = $account->save();
        
        if(!$result){
            ?>
            <script>alert('Có lỗi xảy ra, vui lòng kiểm tra lại dữ liệu!');</script>
            <?php
        } else {
            // Đăng ký tài khoản thành công, chuyển về trang chủ và lưu session user
            $_SESSION['user'] = $u_name;
            header("Location: index.php");
        }
    }
}

?>
<!-- Form dang ky -->

<form method="post" style="width:30%">
    <div class="form-group row">
        <lable for="txtname" class="col-sm-2 form-control-lable">UserName</lable>
        <div class="col-sm-10">
            <input name="txtname" placeholder="User name" type="text" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <lable for="txtemail" class="col-sm-2 form-control-lable">Email</lable>
        <div class="col-sm-10">
            <input name="txtemail" placeholder="Email" type="email" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <lable for="txtpass" class="col-sm-2 form-control-lable">Password</lable>
        <div class="col-sm-10">
            <input name="txtpass" placeholder="Password" type="password" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-10 col-sm-offset-2">
            <input name="btn-signup" type="submit" value="Sign up"/>
        </div>
    </div>
</form>
<?php include_once("footer.php"); ?>