<?php
header('Content-Type: text/html; charset=utf-8');
session_start();
require_once("../../Database/Database.php");
if ($_SESSION['username'] == "") {
    echo "<script>alert('Please Login !!')</script>";
    header("Refresh:0 , url=../../logout.php");
    exit();
}
if ($_SESSION['status'] != "admin") {
    echo "<script>alert('This page for admin only!')</script>";
    header("Refresh:0 , url=../../logout.php");
    exit();
}
$sql = "select * from server where id=1";
$query = mysqli_query($conn, $sql);
$result= mysqli_fetch_array($query);
$i = $result['class'];
if ($_POST['submit_class']) {
    $class_sql = "update server set class='".$_POST['class']."' where id=1";
    if($conn->query($class_sql) === TRUE){
        echo "<script>alert('Update class sucessful')</script>";
        header("Refresh:0");
    }
}
$sql_student = "select * from student where class='".$i."'";
$result_student = mysqli_query($conn, $sql_student);
$sql_serve= "select * from student where class='".$i."'";
$result_serve = mysqli_query($conn, $sql_serve);
$row_serve = mysqli_fetch_array($result_serve);
?>
<!doctype html>
<html lang="en">

<head>
<title>Admin</title>
    <meta charset="utf-8">
    <link rel="icon" href="../../../img/cnrlogo.png">
    <link rel="stylesheet" href="../../main/style/main.css">
    <link rel="stylesheet" href="../style/admin.css">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <ul>
        <li><a href="../">Admin </a></li>
        <li><a href="server.php">SERVER</a></li>
        <li><a class="active" href="#">APROV</a></li>
        <li><a href="manual.php">MANUAL</a></li>
        <li><a href="file.php">FILE</a></li>
        <li><a href="quiz.php">QUIZ</a></li>
        <li><a href="score.php">Score</a></li>
        <li style="float:right"><a href="../../logout.php">Logout</a></li>
    </ul>
</body>
<div class="container">
    <center>
        <form action="" method="post">
            Class :
            <select style="width:100px;" name="class">
                <?php for ($j = 1; $j <= 4; $j++) { ?>
                    <option value="<?php echo $j ?>"><?php echo $j; ?></option>
                <?php } ?>
            </select>
            <input type="submit" name="submit_class" value="submit">
        </form>
        <br><hr><br>
        <div class="row">
            <div class="col">
            <form action="" method="post">
                <h4>QUIZ APROV CLASS : <?php echo $i ?></h4>
            <table>
                    <tr>
                        <th>&ensp;&ensp;on&ensp;&ensp;</th>
                        <th>&ensp;&ensp;off&ensp;&ensp;</th>
                    </tr>
                    <tr>
                        <td>&ensp;&ensp;<input type="radio" name="server" value="1" <?php if($row_serve['server'] == 1){echo "checked"; }?>>&ensp;&ensp;</td>
                        <td>&ensp;&ensp;<input type="radio" name="server" value="0" <?php if($row_serve['server'] == 0){echo "checked"; }?> id="">&ensp;&ensp;</td>
                    </tr>
            </table><br>
            <input type="submit" name="quiz" value="Submit">
        </form>
            </div>
            <div class="col">
            <form action="" method="post">
                <h4>CLEAR BAN : <?php echo $i ?></h4>
            <input type="checkbox" name="" id="" required> <b>Clear All user</b>
            <br>
            <input type="submit" name="ban" value="Submit">
        </form>
            </div>
        </div>
        <hr>
        <br>
        Class : <?php echo $i ?>
        <br>
        <form action="" method="post">
            <table border="1">
                <tr>
                    <th>CLR(BAN)</th>
                    <th>รหัสนักศึกษา</th>
                    <th>ชื่อ</th>
                    <th>เคลียรหัสผ่าน</th>
                    <!-- <th>เปิดระบบรายบุคคล</th> -->
                </tr>
                <?php while ($row_aprov = mysqli_fetch_array($result_student)) { ?>
                    <tr>
                        <td><a href="aprov.php?username=<?php echo $row_aprov['username'] ?>" name="clr" >CLR</a></td>
                        <td><?php echo $row_aprov['username']; ?></td>
                        <td><?php echo $row_aprov['name']; ?></td>
                        <td><a href="aprov.php?id=<?php echo $row_aprov['username']; ?>">RESET</a></td>
                    </tr>
                <?php } ?>
            </table>
        </form>
    </center>
    <br>
</div>
<?php
// if($_GET['server']){
//     // $server_change =  md5($_GET['server']);
//     $sql_server = "update student set server='".$_GET['server']."' where username='".$_GET['id']."' ";
//     if($conn->query($sql_server) == TRUE){
//      header("Location:aprov.php");
//     }
// }
if($_GET['id']){
    $change_pass =  md5($_GET['id']);
    $sql_change_pass = "update student set password='$change_pass' where username='".$_GET['id']."' ";
    if($conn->query($sql_change_pass) == TRUE){
     header("Location:aprov.php");
    }
}
if($_GET['username']){
   $sql_clr = "update student set ip='' , ban=1 where username='".$_GET['username']."' ";
   if($conn->query($sql_clr)){
    header("Location:aprov.php");
   }
}
if($_POST['quiz']){
    $serve_sql = "update student set server='".$_POST['server']."' where class='".$i."'";
    if($conn->query($serve_sql) === TRUE){
        header("Location:aprov.php");
    }
}
if($_POST['ban']){
    $serve_sql = "update student set ban=1 , ip=''";
    if($conn->query($serve_sql) === TRUE){
        header("Location:aprov.php");
    }
}
?>
</html>
<?php mysqli_close($conn); ?>