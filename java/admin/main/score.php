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
$result = mysqli_fetch_array($query);
$i = $result['class'];
if ($_POST['submit_class']) {
    $class_sql = "update server set class='" . $_POST['class'] . "' where id=1";
    if ($conn->query($class_sql) === TRUE) {
        echo "<script>alert('Update class sucessful')</script>";
        header("Refresh:0");
    }
}
$sql_problem = "select * from problem";
$result_problem = mysqli_query($conn, $sql_problem);
$sql_student = "select * from student where class='" . $i . "'";
$result_student = mysqli_query($conn, $sql_student);
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
        <li><a href="manual.php">MANUAL</a></li>
        <li><a href="file.php">FILE</a></li>
        <li><a href="quiz.php">QUIZ</a></li>
        <li><a class="active" href="score.php">Score</a></li>
        <li style="float:right"><a href="../../logout.php">Logout</a></li>
    </ul>
</body>
<center>
    <div class="container">
        <h2>Score : <?php echo $i ?></h2>
        <form action="" method="post">
            Class :
            <select style="width:100px;" name="class">
                <?php for ($j = 1; $j <= 4; $j++) { ?>
                    <option value="<?php echo $j ?>"><?php echo $j; ?></option>
                <?php } ?>
            </select>
            <input type="submit" name="submit_class" value="submit">
        </form>
        <br>
        <table border="1">
            <tr>
                <th>student id</th>
                <th>name</th>
                <?php while ($row_week = mysqli_fetch_array($result_problem)) { ?>
                    <th><?php echo $row_week['week']; ?></th>
                <?php } ?>
                <th>Score</th>
            </tr>
            <?php while ($row_aprov = mysqli_fetch_array($result_student)) { ?>
                <tr>
                    <td><?php echo $row_aprov['username']; ?></td>
                    <td><?php echo $row_aprov['name']; ?></td>
                    <?php $i = 0; ?>
                    <?php $sql = "select * from problem";
                    $result = mysqli_query($conn, $sql);
                    $sum = 0;
                    $sql_student = "select * from student where username='" . $row_aprov['username'] . "'"; ?>
                    <?php while ($row_week = mysqli_fetch_array($result)) { ?>
                        <td><?php $score = $row_week['week'];
                            if ($row_aprov[$score] == 'upload') {
                                echo 0;
                            } else {
                                echo $row_aprov[$score];
                            }
                            $sum += $row_aprov[$score]; ?></td>
                        <?php $i++ ?>
                    <?php } ?>
                    <td><?php echo $sum ?></td>
                </tr>
            <?php } ?>
        </table>
    </div>
</center>

</html>
<?php


?>
<?php mysqli_close($conn); ?>