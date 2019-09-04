<?php
header('Content-Type: text/html; charset=utf-8');
session_start();
include("../main/adress/UserInfo.php");
require_once("../Database/Database.php");
if ($_SESSION['username'] == "") {
    echo "<script>alert('Please Login !!')</script>";
    header("Refresh:0 , url=../logout.php");
    exit();
}
if ($_SESSION['status'] != "admin") {
    echo "<script>alert('This page for admin only!')</script>";
    header("Refresh:0 , url=../logout.php");
    exit();
}
$sql_work = "select * from problem";
$query_work = mysqli_query($conn, $sql_work);
?>
<!doctype html>
<html lang="en">

<head>
    <title>Admin</title>
    <meta charset="utf-8">
    <link rel="icon" href="../../img/cnrlogo.png">
    <link rel="stylesheet" href="../main/style/main.css">
    <link rel="stylesheet" href="style/admin.css">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <ul>
        <li><a class="active" href="#">Admin : <?php echo $_SESSION['name']; ?></a></li>
        <li><a href="main/server.php">SERVER</a></li>
        <li><a href="main/aprov.php">APROV</a></li>
        <li><a href="main/manual.php">MANUAL</a></li>
        <li><a href="main/file.php">FILE</a></li>
        <li><a href="main/quiz.php">QUIZ</a></li>
        <li><a href="main/score.php">Score</a></li>
        <li style="float:right"><a href="../logout.php">Logout</a></li>
    </ul>
</body>
<div class="container">
    <br>
    <h1>Welcome To Admin Page</h1>
    <center>
        <div class="container">
            <br>
            <h2>Work</h2>
            <table width="25%">
                <tr>
                    <th>File Name</th>
                    <th>Status</th>
                    <th>Type</th>
                    <th>Error</th>
                </tr>
                <?php while ($row_work = mysqli_fetch_array($query_work)) { ?>
                    <tr>
                        <td><?php echo $row_work['week']; ?></td>
                        <td>
                            <?php if ($row_work['status'] == 1) { ?>
                                <a href="index.php?week=<?php echo $row_work['week'] ?>&status=0">on</a>
                            <?php } ?>
                            <?php if ($row_work['status'] == 0) { ?>
                                <a href="index.php?week=<?php echo $row_work['week'] ?>&status=1">off</a>
                            <?php } ?>
                        </td>
                        <td>
                            <?php if ($row_work['type'] == 1) { ?>
                                <a href="index.php?weektype=<?php echo $row_work['week'] ?>&type=0">Auto</a>
                            <?php } ?>
                            <?php if ($row_work['type'] == 0) { ?>
                                <a href="index.php?weektype=<?php echo $row_work['week'] ?>&type=1">Manual</a>
                            <?php } ?>
                            <?php if ($row_work['type'] == 2) { ?>
                               -
                            <?php } ?>
                        </td>
                        <td>
                            <?php if ($row_work['type'] == 2) { ?>
                                <a style="color:red" href="index.php?weekerror=<?php echo $row_work['week'] ?>&type=0">UnError</a>
                            <?php } ?>
                            <?php if ($row_work['type'] != 2) { ?>
                                <a style="color:red" href="index.php?weekerror=<?php echo $row_work['week'] ?>&type=2">Error</a>
                            <?php } ?>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    </center>
</div>

<?php
if ($_GET['week']) {
    $sql_update = "update problem set status='" . $_GET['status'] . "' where week='" . $_GET['week'] . "'";
    if ($conn->query($sql_update) === TRUE) {
        echo "<script> location.replace('index.php'); </script>";
    }
}
if ($_GET['weektype']) {
    $sql_update = "update problem set type='" . $_GET['type'] . "' where week='" . $_GET['weektype'] . "'";
    if ($conn->query($sql_update) === TRUE) {
        echo "<script> location.replace('index.php'); </script>";
    }
}
if ($_GET['weekerror']) {
    $sql_update = "update problem set type='" . $_GET['type'] . "' where week='" . $_GET['weekerror'] . "'";
    if ($conn->query($sql_update) === TRUE) {
        echo "<script> location.replace('index.php'); </script>";
    }
}

?>
<?php mysqli_close($conn); ?>

</html>