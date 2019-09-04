<?php
date_default_timezone_set('asia/bangkok');
?><!doctype html>
<html lang="en">
  <head>
    <title>Student ( Java )</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="../img/cnrlogo.png">
    <link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">
    <link rel="stylesheet" href="../style/indexpython.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
      <div class="container">
      <center>
         <div class="indexbox">
                 <bR><br>
                 <img src="../img/logo.png"   alt="logo" width="200">
                 <p></p>
                 <b><p>ADMIN <br> ( Java )</p></b><br>
                 <form action="checklogin_admin.php" name="myform" onsubmit="return validateForm()" method="post">
                   <input class="login" type="text" name="sid"  placeholder="username">
                   <p></p>
                  <input class="login"  type="password" name="pass" placeholder="password">
                  <br>
                  <br>
                  <input class="submit" name="submit" type="submit" value="เข้าสู่ระบบ">
                 </form>
                 <br>
                </div><br>
                <p style="font-size:11px;"> &copy; สงวนลิขสิทธิ์ 2561 - <?php echo Date('Y')  +543?> โดย    นายธนวัฒน์ กุลาตี นักศึกษาภาควิชาวิทยาการคอมพิวเตอร์และสารสนเทศ
<br> คณะวิทยาศาสตร์ประยุกต์  มหาวิทยาลัยเทคโนโลยีพระจอมเกล้าพระนครเหนือ</p>
        </center>
      </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>