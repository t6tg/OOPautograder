<?php
if (!$_POST['submit'] || $_POST['sid'] == "" || $_POST['pass'] == "") {
    echo "<script>alert('No value input')</script>";
    header("Refresh:0; url=index.php");
} else {
    session_start();
    require_once("./Database/Database.php");
    $username = mysqli_real_escape_string($conn, $_POST['sid']);
    $password = mysqli_real_escape_string($conn, md5($_POST['pass']));
    $sql = "select * from student where username='" . $username . "' and password='" . $password . "'";
    $query = mysqli_query($conn, $sql);
    $result = mysqli_fetch_array($query, MYSQLI_ASSOC);
    $sql_server = "select * from server where id = 1";
    $query_server = mysqli_query($conn, $sql_server);
    $result_server = mysqli_fetch_array($query_server);
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip_address = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip_address = $_SERVER['REMOTE_ADDR'];
    }
    if ($result_server['server_st'] == 1) {
        if (!$result) {
            echo "<script>alert('รหัสประจำตัวนักศึกษา หรือ รหัสผ่านไม่ถูกต้อง')</script>";
            header("Refresh:0 , url=logout.php");
        } else {
            if ($result['server'] == 1) {
                if ($result['ip'] != $ip_address && $result['ip'] != "" && $result_server['ban'] == 1) {
                    $check_login = "update student set ban='0' where username='" . $username . "'";
                    if($conn->query($check_login) === TRUE){
                    echo "<script>alert('ban !!!')</script>";
                    header("Refresh:0;url=index.php");
                    }
                 } else {
                    $check_login = "update student set ip='" . $ip_address . "' where username='" . $username . "'";
                    if ($conn->query($check_login) === TRUE) {
                        $_SESSION['username'] = $result['username'];
                        $_SESSION['class'] = $result['class'];
                        $_SESSION['name'] = $result['name'];
                        $_SESSION['status'] = $result['status'];
                        header("location: main/");
                        session_write_close();
                    } else {
                        echo "<script>alert('เก็บค่า Login ไม่ได้')</script>";
                        header("Refresh:0;url=index.php");
                    }
                }
            } else {
                echo "<script>alert('Your user closed')</script>";
                header("Refresh:0;url=index.php");
            }
        }
    } else {
        echo "<script>alert('Grader closed')</script>";
        header("Refresh:0,url=index.php");
    }
}
mysqli_close($conn);
