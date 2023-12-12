<!-- <html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>web ban hang</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" media="screen">

</head>
<body>
    <div id="wrapper">
        <h2> web ban hang</h2>
        <div class="navbar navrbar-default navbar-static-top" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <a href="./list_product.php" class="navbar-brand">Danh sach san pham</a>
                    <a href="./add_product.php" class="navbar-brand">Them san pham</a>
                </div>
            </div>
        </div> -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web Trang Suc DOJI</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" media="screen">
    <link rel="stylesheet" href="./style.css">
    
</head>

<body>

    <div class="outer">
        <div id="logo-bg">
            <h1>Trang Suc DOJI</h1>
            <span class="tag">Company Slogan will come here</span>

        </div>
        
        <div id="business"></div>
        <div class="clear"></div>
        <div id="bg">
            <div class="toplinks"><a href="./index.php">Homepage</a></div>
            <div class="sap">|</div>
            <div class="toplinks"><a href="#">About us</a></div>
            <div class="sap">|</div>
            <div class="toplinks"><a href="./list_product.php">Danh sach san pham</a></div>
            <div class="sap">|</div>
            <div class="toplinks"><a href="./add_product.php">Them san pham</a></div>
            <div class="sap">|</div>
            <div class="toplinks"><a href="#">Contact us</a></div>
            <div><?php
        session_start();
        if(isset($_SESSION['user'])!=""){
            echo "<h2>Xin chao: ".$_SESSION['user']."<a href='./logout.php'>Logout</a></h2>";
        } 
        else{
            echo "<h2>Ban chua dang nhap <a href='./login.php'>Login</a> - <a href='./register.php'>Register</a></h2>";
        }
        ?></div>
        </div>