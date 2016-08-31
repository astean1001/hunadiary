<?php

session_start();

echo "<meta charset = 'utf-8'>";

$link = mysqli_connect("localhost", "root", "mysql123", "myfirst_db");


$titles = mysqli_real_escape_string($link,$_POST['title']);
$title = htmlspecialchars($titles);
$contents = mysqli_real_escape_string($link,$_POST['content']);
$content = htmlspecialchars($contents);



if($_FILES["file"]["error"] != 0 && $_FILES["file"]["error"] != 4) {			// error 4는 파일을 첨부하지 않은 경우
	echo "Error: " . $_FILES["file"]["error"] . "<br>";
}
else {
	$date = date("YmdHis", time());
	$filename = $_FILES["file"]["name"];
	$filehash = md5($date . $_FILES["file"]["name"]);		// 현재시간과 파일명을 해시화
	$dir = "upload/" . $filehash;
	move_uploaded_file($_FILES["file"]["tmp_name"], $dir);		// 임시파일로 저장되어있던 업로드된 파일을 $dir에 해당하는 경로에 저장시킴
		
	$q = "insert board (id, title, content, filename, filehash) values ('$_SESSION[user_id]', '$title', '$content', '$filename', '$filehash');";
	
	mysqli_query($link, $q);
	echo "<script>location.replace('list.php');</script>";
	
}


?>
