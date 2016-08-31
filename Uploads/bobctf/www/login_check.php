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
	$isAdmin = mysqli_real_escape_string($db,$_POST['isAdmin']);	

	

	

	if($db->connect_error){
		die("connection failed:" . $db->connect_error);
	}

	if($id ==""|| $pw =="")
                echo "<script>alert('공백이 존재합니다 다시 입력해주세요');history.go(-1);</script>";
		
	
	


	$q = "select * from member where id = '$id' and pass = '$pw'";
	

	$result = mysqli_query($db,$q);
	$arr = $result->fetch_assoc();
	

	if($arr){
		$uid = $arr['id'];
      		$sql = "SELECT Auth from access where id='$uid' and Auth='TRUE';";
		$result = mysqli_query($db,$sql);
		$arr = $result->fetch_assoc();
	
		if($arr['Auth']){
		$_SESSION['user_id'] = $uid;
		echo "<script>alert(\"로그인 성공~!! $uid 님 환영합니다!\");
		location.replace('list.php');</script>";
		}

		else{
		$_SESSION['user_id'] = $uid;
		$q = "update member set role='admin' where id='$uid'";
		$result = mysqli_query($db,$q);
		echo "<script>alert(\"관리자님 환영합니다!\");
		location.replace('list.php');</script>";
		}

	}
	
	
	else{
		echo "<script>alert(\"로그인 실패! 다시 로그인 해주세요\");
		location.replace('login.php');</script>";
				
	}

		
	

	
	?>
	</body>

</html>
