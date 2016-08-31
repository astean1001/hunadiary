<html>
	<head>
		<meta charset="utf-8">
	</head>
	<body>
<?php
	
		
	
	$nick = preg_replace("/[\<\>\'\"\\\'\\\"\%\=\(\)\s]/", "", $_POST['nick']);
	$word = preg_replace("/[\<\>\'\"\\\'\\\"\%\=\(\)\s]/", "", $_POST['word']);
	$name = preg_replace("/[\<\>\'\"\\\'\\\"\%\=\(\)\s]/", "", $_POST['name']);
	$mail = preg_replace("/[\<\>\'\"\\\'\\\"\%\=\(\)\s]/", "", $_POST['mail']);
	$number = preg_replace("/[\<\>\'\"\\\'\\\"\%\=\(\)\s]/", "", $_POST['number']);
	
	if($nick==""||$word==""||$name==""||$mail==""||$number==""){
	
		echo "<script>alert('공백이 존재 합니다');history.go(-1);</script>";

	}

	$db = mysqli_connect("localhost","root","mysql123","boarddb");
		
	$q = "select count(id) from member where id='$nick'";
	
	$result = mysqli_query($db,$q);
	$result_arr = mysqli_fetch_row($result);
	$total = $result_arr[0];
	
		
	if($total){
		echo "<script>alert('이미 존재하는 아이디 입니다 ');
		history.go(-1);</script>";
	}
	
	else
	{
	
		
	$query = "INSERT INTO member (id,pass,name,mail,phonenumber) VALUES ('$nick','$word','$name','$mail','$number')";

	$results = mysqli_query($db,$query);
		
			
		
	$sql = "INSERT into access (id, Auth) values ((select id from member where id='$nick'), 'TRUE');";

  	mysqli_query($db, $sql);

	mysqli_close($db);


	if($results){	
      	echo "<script>alert('아이디가 성공적으로 생성 되셨습니다');
				location.replace('login.php')</script>";
		}	
	else{
	echo "<script>alert('아이디 생성에 실패하였습니다 다시 시도해주세요');location.replace('make_id.php')</script>";
	}		
		
	
	}
?>
	</body>
</html>
