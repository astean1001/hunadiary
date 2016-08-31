<?php

session_start();

echo "<meta charset = 'utf-8'>";

if( $_SESSION[user_id] == "" )
	echo ("<script> alert('세션이 만료되었습니다.'); location.replace('login.php'); </script>");

$link = mysqli_connect("localhost", "root", "mysql123", "myfirst_db");


$titles = mysqli_real_escape_string($link, $_POST['title']);
$title = htmlspecialchars($titles);
$contents = mysqli_real_escape_string($link, $_POST[content]);
$content =  htmlspecialchars($contents);
$No = mysqli_real_escape_string($link, $_GET[No]);



$q = "select * from board where No = $No";
$result = mysqli_query($link, $q);
$result_arr = mysqli_fetch_array($result);
$session_id = $_SESSION[user_id];

if( $session_id != $result_arr[id] )
	echo ("<script> alert('작성자만 글을 삭제할 수 있습니다.'); history.bak(); </script>");
else {

	if($_FILES["file"]["error"] != 0 && $_FILES["file"]["error"] != 4) {
		echo "Error: " . $_FILES["file"]["error"] . "<br>";
	}
	else if($_FILES["file"]["error"] == 4) {		// 파일을 첨부하지 않은 경우 => 원래의 파일이 그대로 유지되어야함.	
		$q = "update board set title = '$title', content = '$content' where No = '$No'";
	}
	else {			// 새로운 파일을 첨부한 경우 => 원래 파일을 지워지고 새로운 파일이 db와 upload에 올라가야함
		$q = "select * from board where No = '$_GET[No]'";
		$result = mysqli_query($link, $q);
		$result_arr = mysqli_fetch_array($result);
		$filehash = $result_arr[filehash];
		unlink("upload/".$filehash);	// 기존의 파일 삭제
	
		$date = date("YmdHis", time());
		$filename = $_FILES["file"]["name"];
		$filehash = md5($date . $filename);
		$dir = "upload/" . $filehash;
		move_uploaded_file($_FILES["file"]["tmp_name"], $dir);	// 새 파일 업로드
	
		$q = "update board set title = '$title', content = '$content', filename = '$filename', filehash = '$filehash' where No = '$No'";
	}
	mysqli_query($link, $q);


	echo "<script> alert('글 수정 완료!'); location.replace('list.php');</script>";
}
?>
