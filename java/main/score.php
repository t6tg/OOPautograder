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
$sql = "select * from problem";
$result = mysqli_query($conn, $sql);
$sql_student = "select * from student where username='" . $_SESSION['username'] . "'";
$result_student = mysqli_query($conn, $sql_student);
$row_student =  mysqli_fetch_array($result_student);
while ($rows = mysqli_fetch_array($result_student)) {
    $password = $rows['password'];
}
?>
<!doctype html>
<html lang="en">
<style>
    table,
    th,
    td {
        border: 1px solid black;
        border-collapse: collapse;
    }

    th,
    td {
        padding: 5px;
    }

    th {
        text-align: left;
    }
</style>

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
        <li><a href="profile.php">Profile</a></li>
        <li><a class="active" href="#">Score</a></li>
        <li style="float:right"><a href="../logout.php">Logout</a></li>
    </ul>
    <div class="container">
        <table style="width:100%">
            <tr>
                <th>Work</th>
                <?php $i = 0; ?>
                <?php while ($row_week = mysqli_fetch_array($result)) { ?>
                    <th><?php echo $score[$i] = $row_week['week']; ?></th>
                    <?php $i++ ?>
                <?php } ?>
            </tr>
            <tr>
                <th>Score</th>
                <?php for ($j = 0; $j < count($score); $j++) { ?>
                    <td><?php if($row_student["$score[$j]"] == "upload"){ echo "0.0";} else if($row_student["$score[$j]"] == ""){ echo "0";}else{echo $row_student["$score[$j]"]; }?></td>
                <?php } ?>
            </tr>
        </table><br>
        <?php $sum = 0;?>
        <?php for ($j = 0; $j < count($score); $j++) { 
            if($row_student["$score[$j]"] == "upload"){
                $row_student["$score[$j]"] = 0;  
            }
             $sum += $row_student["$score[$j]"];
         } ?>
          <b>คะแนนรวม :  &ensp;</b><?php echo $sum ;?> &ensp; <b>คะแนน</b>
    </div>
</body>

</html>