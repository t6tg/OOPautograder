<?php
header('Content-Type: text/html; charset=utf-8');
session_start();
require_once("../Database/Database.php");
if ($_SESSION['username'] == "") {
    echo "<script>alert('Please Login !!')</script>";
    header("Refresh:0 , url=../logout.php");
    exit();
}
if ($_SESSION['status'] != "user") {
    echo "<script>alert('This page for user only!')</script>";
    header("Refresh:0 , url=../logout.php");
    exit();
}
$sql = "select * from problem where status=1";
$result = mysqli_query($conn, $sql);
$sql_student = "select * from student where username='" . $_SESSION['username'] . "'";
$result_student = mysqli_query($conn, $sql_student);
 while ($rows = mysqli_fetch_array($result_student)) {
    $password = $rows['password'];
}
?>
<!doctype html>
<html lang="en">

<head>
    <title>Student</title>
    <meta charset="utf-8">
    <link rel="icon" href="../../img/cnrlogo.png">
    <link rel="stylesheet" href="style/main.css">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <ul>
        <li><a href="index.php">User</a></li>
        <li><a  class="active" href="#">Profile</a></li>
        <li><a href="score.php">Score</a></li>
        <li style="float:right"><a href="../logout.php">Logout</a></li>
    </ul>
<div class="container">
    <center><form action="" method="post" onsubmit="return validate()" name="myform">
        รหัสผ่านเดิม : <input type="password" name="oldpassword" id="" required/><br><br>
        รหัสผ่านใหม่ : <input type="password" name="newpassword" id="" required><br><br>
        ยืนยันรหัสผ่าน : <input type="password" name="repassword" required /><br><br>
        <p id="p1"></p>
        <input type="submit" name="submit" value="submit">
    </form>
    </center>
    </body>
    <script>
    function validate(){
        var newpass = document.forms["myform"]["newpassword"].value;
        var repass = document.forms["myform"]["repassword"].value;
        if(newpass != repass){
            alert("รหัสผ่านใหม่และรหัสผ่านยืนยันไม่ตรงกัน");
            return false;
        }
        if(newpass == ""){
            alert("กรุณากรอกรหัสผ่าน");
            return false;
        }
        if(repass == ""){
            alert("กรุณากรอกรหัสผ่าน");
            return false;
        }
    }
    </script>
</html>
<?php 
if($_POST['submit']){
    $oldpass = md5($_POST['oldpassword']);
    if($password != $oldpass){
        echo "<script>alert('รหัสผ่านไม่ตรงกับรหัสผ่าน')</script>";
    }else{
        $username = $_SESSION['username'];
        $newpass = md5($_POST['newpassword']);
        $repass = "UPDATE student set password='".$newpass."' where username='".$username."'";
        if($conn->query($repass) === TRUE){
            echo "<script>alert('เปลี่ยนรหัสผ่านสำเร็จ')</script>";
            header("Refresh:0,url=index.php");
        }else{
            echo "<script>alert('เปลี่ยนรหัสผ่านไม่สำเร็จ')</script>";
        }
        
    }
}
mysqli_close($conn);
?>
