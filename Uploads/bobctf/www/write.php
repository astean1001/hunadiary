<?php
	session_start();
	$user_id = $_SESSION['user_id'];
?>

<html>
	<head>
		<meta charset = "utf-8">
	</head>
	<body>
		<center>
		<form name = 'writing' method = 'POST' action = 'write_check.php' enctype='multipart/form-data'>
		제목 : <input name = 'title' type = 'text' maxlength = '50' style = "width:600" autocomplete = off></br>
		본문 : <input name = 'content' type = 'html' maxlength = '500' style = "width:600;height:550px; border: 1px solid #000000;padding : 5px 0px 0px 5px;" autocomplete = off></br>
		<input type="file" value="파일 첨부" name="file" enctype="multipart/form-data"></br>
		<input type = 'button' value  = '목록으로' onclick = "location.href = 'list.php'">
		<input type = submit value = '완료'>
		</center>
		</form>
	</body>
</html>	
