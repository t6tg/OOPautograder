<?php
if (!$_POST['submit'] || $_POST['sid'] == "" || $_POST['pass'] == "") {
    echo "<script>alert('No value input')</script>";
    header("Refresh:0; url=index.php");
} else {
    session_start();
    require_once("./Database/Database.php");
    $username = mysqli_real_escape_string($conn, $_POST['sid']);
    $password = mysqli_real_escape_string($conn, md5($_POST['pass']));
    $sql = "select * from admin where username='" . $username . "' and password='" . $password . "'";
    $query = mysqli_query($conn, $sql);
    $result = mysqli_fetch_array($query, MYSQLI_ASSOC);
    if (!$result) {
        echo "<script>alert('ชื่อผู้ใช้ หรือ รหัสผ่านไม่ถูกต้อง')</script>";
        header("Refresh:0 , url=logout.php");
    } else {
        $_SESSION['username'] = $result['username'];
        $_SESSION['class'] = $result['class'];
        $_SESSION['name'] = $result['name'];
        $_SESSION['status'] = $result['status'];
        header("location: admin/");
        session_write_close();
    }
}
mysqli_close($conn);
