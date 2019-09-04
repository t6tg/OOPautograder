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
$sql_manual = "select * from manual";
$query_manual = mysqli_query($conn, $sql_manual);

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
        <li><a href="../">Admin</a></li>
        <li><a href="server.php">SERVER</a></li>
        <li><a href="aprov.php">APROV</a></li>
        <li><a class="active" href="manual.php">MANUAL</a></li>
        <li><a href="file.php">FILE</a></li>
        <li><a href="quiz.php">QUIZ</a></li>
        <li><a href="score.php">Score</a></li>
        <li style="float:right"><a href="../../logout.php">Logout</a></li>
    </ul>
</body>
<center>
    <div class="container">
        <h2>Manual Check</h2>
        <table border="1">
            <tr>
                <th>SID</th>
                <th>File</th>
                <th>week</th>
                <th>Pass</th>
                <th>No Pass</th>
            </tr>
            <?php while ($row_manual = mysqli_fetch_array($query_manual)) { ?>
                <tr>
                    <td><?php echo $row_manual['username'] ?></td>
                    <?php $parts = explode('.', $row_manual['file'] ); ?>
                    <?php if($parts[1] == "py"){ ?>
                        <td><a target="_blank" href="../../main/process/<?php echo $row_manual['file']  ?>"><img src="./images/placeholder.png"s width="100px"></a></td>
                    <?php }else {?>
                    <td><a target="_blank" href="../../main/process/<?php echo $row_manual['file']  ?>"><img src="../../main/process/<?php echo $row_manual['file'] ?>"s width="100px"></a></td>
                    <?php } ?>
                    <td><?php echo $row_manual['week'] ?></td>
                    <td><a href="manual.php?username=<?php echo $row_manual['username']; ?>&week=<?php echo $row_manual['week']; ?>&pass=1&file=<?php echo $row_manual['file'];?>">Pass</a></td>
                    <td><a href="manual.php?username=<?php echo $row_manual['username']; ?>&week=<?php echo $row_manual['week']; ?>&pass=0&file=<?php echo $row_manual['file'];?>">No Pass</a></td>

                </tr>
            <?php } ?>
        </table>
    </div>
</center>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</html>
<?php
if ($_GET['username']) {
    if ($_GET['week']) {
        $week = $_GET['week'];
        $username = $_GET['username'];
        $sql_score = "select * from problem where week='" . $week . "'";
        $query_score = mysqli_query($conn, $sql_score);
        $row_score = mysqli_fetch_array($query_score);
        $score = $row_score['score'];
        if ($_GET['pass'] == 1) {
             $sql_check = "update student set $week='" . $score . "' where username='" . $username . "'";
            if ($conn->query($sql_check) === TRUE) {
                $sql_delete = "delete from manual where file='".$_GET['file']."'";
                if ($conn->query($sql_delete) === TRUE) {
                    header("Location:manual.php");
                }
            }
        } else {
            $sql_check = "update student set $week='0.0' where username='" . $username . "'";
            if ($conn->query($sql_check) === TRUE) {
                $sql_delete = "delete from manual where file='".$_GET['file']."'";
                if ($conn->query($sql_delete) === TRUE) {
                    header("Location:manual.php");
                }
            }
        }
    }
}
?>
<?php mysqli_close($conn); ?>