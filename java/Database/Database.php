<?php
    $host = "localhost";
    $user = "grader";
    $pass = "James15127*";
    $dbname = "java";
    $conn = new mysqli($host,$user,$pass,$dbname);
    mysqli_query($conn,"SET character_set_results=utf8");
    if($conn->connect_error){
        echo "<center>";
        echo "<h1 style='color:red;font-size:60;'>Alert !!</h1>";
        echo "<h1>";
        die("Connection failed : " . $conn->connect_error);
        echo "</h1>";
    }
?>
