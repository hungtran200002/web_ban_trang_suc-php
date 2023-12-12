<?php include_once("header.php") ?>

<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Redirect the user to the index page if they are already logged in
if(isset($_SESSION['user']) && $_SESSION['user'] !== "") {
    header("Location: index.php");
}

require_once("./Entities/user.class.php");

// Check if the login form is submitted
if(isset($_POST['btn-login'])) {
    $u_name = $_POST['txtname'];
    $u_pass = $_POST['txtpass'];

    // Authenticate user
    $account = User::checkLogin($u_name, $u_pass);

    // Debugging: Check the result of the checkLogin method
    var_dump($account);

    if($account) {
        // Login successful, store user session and redirect to index
        $_SESSION['user'] = $u_name;
        header("Location: index.php");
    } else {
        // Login failed, display error message
        ?>
        <script>alert('Đăng nhập không thành công, vui lòng kiểm tra tên đăng nhập và mật khẩu!');</script>
        <?php
    }
}
?>

<!-- Login Form -->
<form method="post" style="width:30%">
    <div class="form-group row">
        <label for="txtname" class="col-sm-2 form-control-label">UserName</label>
        <div class="col-sm-10">
            <input name="txtname" placeholder="User name" type="text" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="txtpass" class="col-sm-2 form-control-label">Password</label>
        <div class="col-sm-10">
            <input name="txtpass" placeholder="Password" type="password" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-10 col-sm-offset-2">
            <input name="btn-login" type="submit" value="Login"/>
        </div>
    </div>
</form>

<?php include_once("footer.php"); ?>
