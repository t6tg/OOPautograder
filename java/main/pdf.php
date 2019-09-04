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
$pdf = $_GET['file'];
$pdf_path = "437175ba4191210ee004e1d937494d09/$pdf";
$sql_file = "select * from file where filename='".$pdf."'";
$result_file = mysqli_query($conn, $sql_file);
$row_file = mysqli_fetch_array($result_file);
if($row_file['status'] == 0){
    header("Location:index.php");
}
if(empty($_GET['file'])){
    header("Location:index.php");
}
header('Content-type: application/pdf');
header('Content-Disposition: attachment; filename="' . basename($pdf_path) . '"');
header('Content-Transfer-Encoding: binary');
readfile($pdf_path);

mysqli_close($conn);

?>