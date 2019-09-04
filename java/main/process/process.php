<?php
//compile
require_once("../../Database/Database.php");
session_start();
date_default_timezone_set("Asia/Bangkok");
$week = $_POST['week'];
$sql = "SELECT * FROM problem where week='" . $week . "'";
$query = mysqli_query($conn, $sql);
$result = mysqli_fetch_array($query);
$sql_score = "SELECT * FROM student where username='$student'";
$query_score = mysqli_query($conn, $sql);
$result_score = mysqli_fetch_array($query);
$score_old = $result_score["$week"];
$score =  $result['score'];
$student = $_SESSION['username'];
$sql_student = "SELECT * FROM student where username='$student'";
$query_student =  mysqli_query($conn, $sql_student);
$result_student = mysqli_fetch_array($query_student);
$sfile = "$student" . _ . "$week";
$path = "91d9a2124569c9135979c12e3ec464f5/student/$week/$student/";
$type = strrchr($_FILES['file']['name'], ".");
$namefile = $path . $sfile . $type;
$sql_server = "select * from server where id=1";
$result_server = mysqli_query($conn, $sql_server);
$row_server = mysqli_fetch_array($result_server);
if ($row_server['server_st'] == 1) {
    if ($result_student['server'] == 1) {
    if ($result['week'] != $_POST['week']) {
        echo "<script>alert('ไม่มีข้อนี้อยู่ในระบบ')</script>";
        header("Refresh:0;url=../index.php");
    } else {
        if ($result['status'] == 0) {
            echo "<script>alert('ข้อนี้ถูกปิดอยู่')</script>";
            header("Refresh:0;url=../index.php");
        } else {
            if ($result['type'] == 0) {
                if ($type == ".jpg" || $type == ".jpeg" ) {
                    $file_sql = "insert into manual(week,username,file) values('" . $week . "' , '" . $student . "' , '" . "91d9a2124569c9135979c12e3ec464f5/student/$week/$sfile.jpg" . "')";
                    if ($conn->query($file_sql) === TRUE) {
                        move_uploaded_file($_FILES['file']['tmp_name'], "91d9a2124569c9135979c12e3ec464f5/student/$week/$sfile.jpg");
                        header("Refresh:0;url=../loading.php");
                        $add_sql  =   "update student set $week='upload' where username='$student'";
                        mysqli_query($conn, $add_sql);
                    } else {
                        echo "<script>alert('ผิดพลาด')</script>";
                        header("Refresh:0;url=../index.php");
                    }
                } else {
                    echo "<script>alert('นามสกุลของไฟล์ไม่ถูกต้อง')</script>";
                    header("Refresh:0;url=../index.php");
                }
            } else if ($result['type'] == 1) {
                $user_id = $_SESSION['username'];
                exec("mkdir ./91d9a2124569c9135979c12e3ec464f5/student/$week/$user_id");
                if ($type == ".java") {
                    move_uploaded_file($_FILES['file']['tmp_name'], "91d9a2124569c9135979c12e3ec464f5/student/$week/$user_id/Main.java");
    $score_user = 0;
	$CC="javac";
    $out="CLASSPATH=91d9a2124569c9135979c12e3ec464f5/student/$week/$user_id timeout 1 java Main";
    // $out="CLASSPATH=91d9a2124569c9135979c12e3ec464f5/student/$week/$user_id java Main";
    $filename_code="91d9a2124569c9135979c12e3ec464f5/student/$week/$user_id/Main.java";
    $arr_Score = [];
    $arr_P = [];
    $arr_time = [];
    $config = file_get_contents("./91d9a2124569c9135979c12e3ec464f5/input/$week/config.txt");
    for($i = 1 ; $i <= $config ; $i++){
	$filename_in="./91d9a2124569c9135979c12e3ec464f5/input/$week/$i.in";
	$filename_error="./91d9a2124569c9135979c12e3ec464f5/student/$week/$user_id/error.txt";
	$runtime_file="./91d9a2124569c9135979c12e3ec464f5/student/$week/$user_id/runtime.txt";
	$executable="*.class";
	$command=$CC." ".$filename_code;	
	$command_error=$command." 2>".$filename_error;
    $runtime_error_command=$out." 2>".$runtime_file;
    $file_in = file_get_contents("./91d9a2124569c9135979c12e3ec464f5/input/$week/$i.in");
	exec("chmod 777 $executable"); 
	exec("chmod 777 $filename_error");	

	shell_exec($command_error);
	$error=file_get_contents($filename_error);
	$executionStartTime = microtime(true);

	if(trim($error)=="")
	{
		if(trim($file_in)=="")
		{
			shell_exec($runtime_error_command);
            $runtime_error=file_get_contents($runtime_file);
			$output=shell_exec($out);
		}
		else
		{
			shell_exec($runtime_error_command);
			$runtime_error=file_get_contents($runtime_file);
            $out="".$out." < ".$filename_in." > ./91d9a2124569c9135979c12e3ec464f5/student/$week/$user_id/$i.sol";
            $output=shell_exec($out);
            // $output = file_get_contents("output.txt");
		}
	}
	$executionEndTime = microtime(true);
	$seconds = $executionEndTime - $executionStartTime;
	$seconds = sprintf('%0.2f', $seconds);
	$arr_time[$i-1] = $seconds;
	if($seconds>1)
	{
        $arr_P[$i-1] = "T";
        $arr_Score[$i-1] = 0;
	}
	else
	{
        if(trim($error)!="")
        {
            $arr_P[$i-1] = "E";
            $arr_Score[$i-1] = 0;
            $score_user += $arr_Score[$i-1];
        }
        else if(file_get_contents("./91d9a2124569c9135979c12e3ec464f5/student/$week/$user_id/$i.sol") == file_get_contents("./91d9a2124569c9135979c12e3ec464f5/ans/$week/$i.sol"))  {
            $arr_P[$i-1] = "P";
            $arr_Score[$i-1] = $score / $config;
            $score_user += $arr_Score[$i-1];
        }else{
            $arr_P[$i-1] = "F";
            $arr_Score[$i-1] = 0;
            $score_user += $arr_Score[$i-1];
        }
    }
}
$score_user = sprintf('%0.2f' , $score_user);
$add_sql  =  "update student set $week='$score_user' where username='$student'";
mysqli_query($conn,$add_sql);
$myfile = fopen("./91d9a2124569c9135979c12e3ec464f5/student/$week/$user_id/result.txt", "w");
for($i = 0 ; $i < $config ; $i++){
    $txt = $arr_time[$i]."\n";
    fwrite($myfile, $txt);
}
for($i = 0 ; $i < $config ; $i++){
    $txt = $arr_P[$i]."\n";
    fwrite($myfile, $txt);
}
for($i = 0 ; $i < $config ; $i++){
    $txt = sprintf('%0.2f' , $arr_Score[$i])."\n";
    fwrite($myfile, $txt);
}
$txt2 = $score_user;
fwrite($myfile, $txt2);
fclose($myfile);
$myfile2 = fopen("./91d9a2124569c9135979c12e3ec464f5/student/$week/$user_id/timestamp.txt", "w");
$txt_time = Date('d-m-Y H:i:s');
fwrite($myfile2, $txt_time);
fclose($myfile2);
exec("rm ./91d9a2124569c9135979c12e3ec464f5/student/$week/$user_id/$executable");
exec("rm ./91d9a2124569c9135979c12e3ec464f5/student/$week/$user_id/runtime.txt");
exec("rm ./91d9a2124569c9135979c12e3ec464f5/student/$week/$user_id/*.sol");
exec("rm ./91d9a2124569c9135979c12e3ec464f5/student/$week/$user_id/error.txt");
header("Refresh:0;url=../loading.php");
/////// process
} else {
echo "<script>
alert('นามสกุลของไฟล์ไม่ถูกต้อง')
</script>";
header("Refresh:0;url=../index.php");
}
} else if ($result['type'] == 2) {
if ($type == ".java") {
$file_sql ="insert into manual(week,username,file) values('" . $week . "' , '" . $student . "' , '" . "91d9a2124569c9135979c12e3ec464f5/student/$week/$sfile.java" . "')";
if ($conn->query($file_sql) === TRUE) {
move_uploaded_file($_FILES['file']['tmp_name'], "91d9a2124569c9135979c12e3ec464f5/student/$week/$sfile.java" );
header("Refresh:0;url=../loading.php");
$add_sql = "update student set $week='0.0' where username='$student'";
mysqli_query($conn, $add_sql);
} else {
echo "<script>
alert('ผิดพลาด')
</script>";
header("Refresh:0;url=../index.php");
}
} else {
echo "<script>
alert('นามสกุลของไฟล์ไม่ถูกต้อง')
</script>";
header("Refresh:0;url=../index.php");
}
}
mysqli_close($conn);
}
}
}else{
echo "<script>
alert('User Closed')
</script>";
header("Refresh:0;url=../index.php");
}
} else {
echo "<script>
alert('Grader Closed')
</script>";
header("Refresh:0;url=../index.php");
}