<?php

session_start();

if( $_SESSION[user_id] == "")
	echo ("<script> alert('세션이 만료되었습니다.'); location.replace('login.php'); </script>");

else {
	$link = mysqli_connect("localhost", "root", "mysql123", "myfirst_db");

	$No = mysqli_real_escape_string($link, $_GET[No]);
	
	$q = "select * from board where No = $_GET[No]";
	$result = mysqli_query($link, $q);
	$result_array = mysqli_fetch_array($result);

	$filehash = $result_array['filehash'];
	$filename = $result_array['filename'];

	header("Content-Type: Application/octet-stream");
	header("Content-Disposition: attachement; filename=\"".$filename."\"");	//파일명
	header("Content-Transfer-Encoding: binary");
	header("Content-Length: ".filesize("upload/".$filehash));
	header("Pragma: no-cache");
	header("Expires: 0");	

	readfile("upload/".$filehash);
}
?>
