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
$sql_file = "select * from file";
$query_file = mysqli_query($conn, $sql_file);

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
        <li><a  href="manual.php">MANUAL</a></li>
        <li><a class="active" href="#">FILE</a></li>
        <li><a href="quiz.php">QUIZ</a></li>
        <li><a href="score.php">Score</a></li>
        <li style="float:right"><a href="../../logout.php">Logout</a></li>
    </ul>
</body>
<center>
    <div class="container">
        <h2>File</h2>
        <table>
            <tr>
                <th>File Name</th>
                <th>Status</th>
            </tr>
            <?php while ($row_file = mysqli_fetch_array($query_file)) { ?>
                <tr>
                    <td><?php echo $row_file['filename']; ?></td>
                    <td>
                        <?php if ($row_file['status'] == 1) { ?>
                            <a href="file.php?file=<?php echo $row_file['filename']?>&status=0">on</a>
                        <?php } ?>
                        <?php if ($row_file['status'] == 0) { ?>
                            <a href="file.php?file=<?php echo $row_file['filename']?>&status=1">off</a>
                        <?php } ?>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>
</center>

</html>
<?php 
    if($_GET['file']){
         $sql_update = "update file set status='".$_GET['status']."' where filename='".$_GET['file']."'";
        if($conn->query($sql_update) === TRUE){
        "<script>alert('Update file Success')</script>";
        header("Refresh:0,url=file.php");
        }
    }

?>
<?php mysqli_close($conn); ?>