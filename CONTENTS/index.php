<!DOCTYPE html>
<html>
<head>
<link href="css1.css" rel="stylesheet" >
<link rel="icon" href="administrator.png">
<title>TECHOPHARM</title>
</head>
<body>
        <div class="login-panel">
        <div class="login-info-box">
            <img src="log.webp" style="width: 150px; height: 150px;">
            <h2>Hi...<br> Login to gain ADMIN status.</h2>
        </div>
        <div class="white-panel">
            <div class="login-show">
                <h2>LOGIN</h2>
                <form method="POST">
                  <input type="text" placeholder="Admin ID" name="id" required>
                  <input type="password" placeholder="Password" name="password" required>
                  <input type="submit" value="LOGIN">
                </form>
            </div>
        </div>
    </div>
<?php
session_start();
if(isset($_POST['id']) && isset($_POST['password']))
{
$id=$_POST['id'];
$pwd=$_POST['password'];
if($id=='adminlauncher#123' && $pwd=='admin')
{   echo"<script> window.location.href='main.php'; </script>";
}
else
echo"<script> alert('Admin ID or PASSWORD is incorrect.Please check!');</script>";
}
?>
</body>
</html>