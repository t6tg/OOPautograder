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
$sql_server = "select * from server where id = 1";
$query_server = mysqli_query($conn, $sql_server);
$result_server = mysqli_fetch_array($query_server);
if($result_server['server_st'] == 0){
    $sever_off = "checked";
}else{
    $sever_on = "checked";
}
if($result_server['ban'] == 0){
    $ban_off = "checked";
}else{
    $ban_on = "checked";
}
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
        <li><a  href="../">Admin</a></li>
        <li><a class="active" href="server.php">SERVER</a></li>
        <li><a href="aprov.php">APROV</a></li>
        <li><a href="manual.php">MANUAL</a></li>
        <li><a href="file.php">FILE</a></li>
        <li><a href="quiz.php">QUIZ</a></li>
        <li><a href="score.php">Score</a></li>
        <li style="float:right"><a href="../../logout.php">Logout</a></li>
    </ul>
</body>
<div class="container">
    <br>
    <form action="" method="post">
       <center><table>
            <tr>
            <h1>Server Status</h1><br>
            </tr>
            <tr>
                <th>&ensp;&ensp;On&ensp;&ensp;</th>
                <th>&ensp;&ensp;Off&ensp;&ensp;</th>
            </tr>
            <tr>
                <td>&ensp;&ensp;<input type="radio" name="server" value="1" <?php echo $sever_on ?>>&ensp;&ensp;</td>
                <td>&ensp;&ensp;<input type="radio" name="server" value="0" <?php echo $sever_off ?>>&ensp;&ensp;</td>
            </tr>
        </table><br>
        <input type="submit" name="submit_server"value="submit">
    </form></center>
    <br>
    <form action="" method="post">
    <center><table>
            <tr>
            <h1>Ban User</h1><br>
            </tr>
            <tr>
                <th>&ensp;&ensp;On&ensp;&ensp;</th>
                <th>&ensp;&ensp;Off&ensp;&ensp;</th>
            </tr>
            <tr>
                <td>&ensp;&ensp;<input type="radio" name="ban" value="1" <?php echo $ban_on ?>>&ensp;&ensp;</td>
                <td>&ensp;&ensp;<input type="radio" name="ban" value="0" <?php echo $ban_off ?>>&ensp;&ensp;</td>
            </tr>
        </table><br>
        <input type="submit" name="submit_ban"value="submit">
    </form></center>
</div>

</html>
<?php
if(($_POST['submit_server'])){
    $update_server = "update server set server_st='".$_POST['server']."'";
    if($conn->query($update_server) === TRUE){
        echo "<script>alert('Update server Succesful')</script>";
        header("Refresh:0");
    }else{
        echo "<script>alert('Update server Unuccesful')</script>";
        header("Refresh:0");
    }
}
if(($_POST['submit_ban'])){
    $update_server = "update server set ban='".$_POST['ban']."'";
    if($conn->query($update_server) === TRUE){
        echo "<script>alert('Update ban Succesful')</script>";
        header("Refresh:0");
    }else{
        echo "<script>alert('Update ban Unuccesful')</script>";
        header("Refresh:0");
    }
}
?>
<?php mysqli_close($conn); ?>