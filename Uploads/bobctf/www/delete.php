<?php

session_start();

echo "<meta charset = 'utf-8'>";

if( $_SESSION[user_id] == "" ) 
	echo ("<script> alert('세션이 만료되었습니다.'); location.replace('login.php'); </script>");

$link = mysqli_connect("localhost", "root", "mysql123", "myfirst_db");

$No = mysqli_real_escape_string($link, $_GET[No]);

$q = "select * from board where No = $No";
$result = mysqli_query($link, $q);
$result_arr = mysqli_fetch_array($result);
$session_id = $_SESSION[user_id];	// 세션 데이터를 문자열로 바꾸기 위해 사용

if( ($session_id != $result_arr[id]) && (strcmp($result_arr[role],'admin')) )
	echo ("<script> alert('작성자만 글을 삭제할 수 있습니다.'); history.back(); </script>");
else {
	$filehash = $result_arr[filehash];
	unlink("upload/".$filehash);		// 파일 삭제
	$q = "delete from board where No = '$No'";		// 해당 글 삭제
	mysqli_query($link, $q);
	$q = "delete from comment where No = '$No'";
	mysqli_query($link, $q);
	
	$q = "select No from board order by No desc";
	$result = mysqli_query($link, $q);
	$result_row = mysqli_fetch_row($result);
	$top = $result_row[0];	
	
	for($i = $No+1; $i <= $top; $i++) {
		
		$q = "update board set No = ".($i-1)." where No = '$i'"; // 해당 글보다 높은 글번호들 하나씩 당기기
		mysqli_query($link, $q);
		$q = "update comment set No = ".($i-1)." where No = '$i'"; // 당겨진 글들에 달려있는 댓글들도 같이 글번호 수정
		mysqli_query($link, $q);
	}
	$q = "alter table board auto_increment = $top";
	mysqli_query($link, $q);
	echo "<script> alert('삭제 완료!'); location.replace('list.php'); </script>";
}


?>
