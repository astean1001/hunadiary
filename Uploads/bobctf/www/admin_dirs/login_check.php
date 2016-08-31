<?php
        session_start();
?>

<html>
        <head>
                <meta charset = "utf-8">
        </head>
        <body>
        <?php





        $db = mysqli_connect("localhost","root","mysql123","boarddb");

        $id = mysqli_real_escape_string($db,$_POST['id']);
        $pw = mysqli_real_escape_string($db,$_POST['pw']);


        if($db->connect_error){
                die("connection failed:" . $db->connect_error);
        }

        if($id ==""|| $pw =="")
                echo "<script>alert('공백이 존재합니다 다시 입력해주세요');history.go(-1);</script>";

        $q = "select role from member where id = '$id' and pass = '$pw'";



        $result = mysqli_query($db,$q);

	$list = mysqli_fetch_row($result);
        if(!strcmp($list['1'],"admin")){
                $_SESSION['user_id'] = $id;
                echo "<script>alert(\"로그인 성공~!! $id 님 환영합니다!\");
                location.replace('../list.php');</script>";


        }


        else{
		echo "<script>alert($list[role]);</script>";
                echo "<script>alert(\" 로그인에 실패하셨거나 접속할수 없는 계정입니다! 다시 로그인 해주세요\");
                location.replace('adm_login.php');</script>";

        }
	?>
	</body>
</html>
