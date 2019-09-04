<?php
header('Content-Type: text/html; charset=utf-8');
session_start();
date_default_timezone_set("Asia/Bangkok");
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
$user = $_SESSION['username'];
$sql_server_st = "select * from server where id=1";
$result_server = mysqli_query($conn, $sql_server_st);
$row_server = mysqli_fetch_array($result_server);
$sql = "select * from problem where status=1";
$result = mysqli_query($conn, $sql);
$sql_student = "select * from student where username='" . $_SESSION['username'] . "'";
$result_student = mysqli_query($conn, $sql_student);
$sql_file = "select * from file where status=1";
$result_file = mysqli_query($conn, $sql_file);
$sql_ban = "select * from student where username='" . $_SESSION['username'] . "'";
$result_ban = mysqli_query($conn, $sql_student);
$row_ban = mysqli_fetch_array($result_ban);
if ($row_ban['ban'] == 0 && $row_server['ban'] == 1) {
    echo "<script>alert('ban !!!')</script>";
    header("Refresh:0,url=../logout.php");
}
?>
<!doctype html>
<html lang="en">

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
        <li><a class="active" href="#">User : <?php echo $_SESSION['name']; ?></a></li>
        <li><a href="profile.php">Profile</a></li>
        <li><a href="score.php">Score</a></li>
        <li style="float:right"><a href="../logout.php">Logout</a></li>
    </ul>
<div class="container">
    <p><b>Problem :
            <?php
            while ($row_file = mysqli_fetch_array($result_file)) { ?>
                <?php
                $file =  $row_file['filename'];
                echo "<a name='filename' href='pdf.php?file=" . $file . "'>" . $file . "</a>";
                ?>
            <?php } ?></b>
            <span style="float:right;">
                    <button onclick="javascript:alert('1).ตั้งชื่อไฟล์ว่า Main.java เท่านั้น ( public class Main ) \n2).ให้ลบ package ....... ออกจากไฟล์ก่อนส่ง \nตัวอย่างหน้าตาของไฟล์ : \nimport java.util.Scanner;\npublic class Main \n { \n public static void main(String[] args) { \n \t \t Scanner input = new Scanner(System.in);\n \t \t}\n}')">การตั้งค่าไฟล์ก่อนส่ง</button>
            </span>
        <br><br>

        <?php $i = 1;
            $arr = [];
            $k = 0;
        ?>
        
        <?php while ($row = mysqli_fetch_array($result)) { ?>
            <?php $week = $row['week']; ?>
            <?php $score = $row['score']; ?>
            <?php if ($row['type'] == "1") {
                $type = "( Auto )";
            } else {
                $type = "( Manual )";
            } ?>
            <form action="process/process.php" method="post" enctype="multipart/form-data">
                <div class="card" style="height: 150px;">
                    <div style="margin-left: 20px;margin-top:20px;"> <b><?php echo $week . $type; ?>
                            <?php $sql_student = "select * from student where username='" . $_SESSION['username'] . "' and $week=$week";
                            $result_student = mysqli_query($conn, $sql_student);
                            ?>
                            <?php while ($row_student = mysqli_fetch_array($result_student)) { ?>
                            </b> <?php if ($row_student[$week] == "") {
                                        echo "";
                                    } else if ($row_student[$week] != "" ) {
                                        if($row['type'] == "0"){
                                            if($row_student[$week]== "upload"){
                                                echo "<span style='color:orange;'>[ No Check ]</span>";
                                            }else if($row_student == "0"){
                                                echo "<span style='color:red;'>[ F ]</span>";
                                            }else{
                                                echo "<span style='color:green;'>[ P ]</span>";
                                            }
                                        }else if($row['type']  == "2" ){
                                                echo "<span style='color:orange;'>[ No Check ]</span>";
                                        }else{
                                            $time = file_get_contents("./process/91d9a2124569c9135979c12e3ec464f5/student/$week/$user/timestamp.txt");
                                            echo "<b style='color:#1542a3'>( Uploaded )</b>";
                                            $config = file_get_contents("./process/91d9a2124569c9135979c12e3ec464f5/input/$week/config.txt");
                                            $fn = fopen("./process/91d9a2124569c9135979c12e3ec464f5/student/$week/$user/result.txt","r");
                                            while(! feof($fn))  {
                                                $result_file_score = fgets($fn);
                                                $arr[$k] = $result_file_score;
                                                $k++;
                                              }
                                             ?>
                                              <table class="table" border="2" style="text-align: center;max-width:55%;float:right;margin-right:10px;">
                  <tr>
              <th> </th>
            <?php for($j = 0 ; $j < $config ; $j++){ ?>
                <td style="padding: 0px;"><b>Case <?php echo $j+1 ?></th>
                    <?php } ?>
                        <td style="padding: 0px;background:green;color:white;"><B>SUM</td>
                    </tr>
                   <tr>
                   <td style="padding: 0px;"><b>Time</td>
                   <?php for($j = 0 ; $j < $config ; $j++){ ?>
                        <td style="padding: 0px;"><?php echo $arr[$j]  ?></td>
                   <?php } ?>
                        <td style="padding: 0px;background:green;color:white;"><b><?php echo end($arr)  . " / " . $row['score']; ; ?></td>
                   </tr>
                   <tr>
                   <td style="padding: 0px;"><b>Status</td>
                   <?php for($j = $config  ; $j < $config+$config ; $j++){ ?>
                       <td style="padding: 0px;"><?php echo $arr[$j]?></td>
                   <?php } ?>
                   <td style="padding: 0px;background:green;color:white;"></td>
                   </tr>
                   <tr>
                   <td style="padding: 0px;"><b>Score</td>
                   <?php for($j = $config*2  ; $j < $config*3 ; $j++){ ?>
                       <td style="padding: 0px;"><?php echo $arr[$j] ?></td>
                 <?php } ?>
                 <td style="padding: 0px;background:green;color:white;"></td>
                    </tr>
             </table>
                                     <?php
                                              $arr = [];
                                            $k = 0;
                                              fclose($fn);
                                        
                                        }
                                        echo '<br><span style="font-size:13px"> Time : '. $time.'</span>';
                                    }
                                    ?><br>
                                    <p id="display_<?php echo $week ?>"></p>
                            <input type="hidden" name="week"  value="<?php echo $week; ?>"><?php } ?>
                        <input type="file" id="file_<?php echo $week ?>" name="file" required>
                        <input style="flaot:right;" type="submit"  name="submit" id="submit_<?php echo $week?>" onclick="progress('<?php echo $week ?>')" value="submit">
                    </div>
                </div>
                <script>
        function progress(i) {
        x = document.getElementById("file_"+i).value;
        if(x != ""){
            document.getElementById("display_"+i).innerHTML = "<div class='progress' style='width: 40%'><div class='progress-bar progress-bar-striped progress-bar-animated bg-success' role='progressbar' aria-valuenow='75' aria-valuemin='0' aria-valuemax='100' style='width: 100%'></div></div>"
            document.getElementById('submit_'+i).style.display = "none";
        }
    }
</script>
            </form><br>
        <?php } ?>
        <br><br>
</div>
<center>
    <p style="font-size:13px">
        ***หมายเหตุ : ( Manual ) อัพไฟล์ได้เฉพาะนามสกุล .jpg หรือ .jpeg เท่านั้น ยกเว้นเหตุจำเป็นอาจารย์จะเปิดให้ลงไฟล์ .java ได้ <br>
        ( Auto ) อัพได้เฉพาะไฟล์ .java เท่านั้น<br>
        ( Uploaded ) แสดงว่า upload ไฟล์สำเร็จให้หากคะแนนขึ้นแสดงว่าทำข้อนั้นถูก<br>
        ข้อที่เป็น ( Manual ) เครื่องจะไม่ตรวจแต่อาจารย์จะเข้าไปตรวจและให้คะแนนภายหลัง<br><br>
    </p>
</center>
</body>
<?php mysqli_close($conn); ?>
</html>