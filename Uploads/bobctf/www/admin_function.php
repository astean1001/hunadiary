<?php

session_start();

	echo "<meta charset = 'utf-8'>";

	

	$link = mysqli_connect("localhost", "root", "mysql123", "myfirst_db");
	$q = "select * from boarddb.member where id='$_SESSION[user_id]'";
	$result = mysqli_query($link, $q);
	$result_arr = mysqli_fetch_row($result);
	$ids=mysqli_real_escape_string($link,$_POST[id]);
	$id=htmlspecialchars($ids);
	if($result_arr[5] != 'admin')
		echo "<script>alert('Oh you are not admin~!');location.replace('login.php');</script>";
	else{

		$q = "select id from boarddb.member where id = '$id'";
		
		$result = mysqli_query($link, $q);

		$result_arr = mysqli_fetch_row($result);

		if(!($result_arr[0]==$id))
			echo "<script>alert('회원 삭제에 실패하였습니다 해당 계정이 존재하는지 확인해주세요');location.replace('RealAdmin.php');</script>";
		
		else{
		$q = "delete from boarddb.member where id = '$id'";
		
		$result = mysqli_query($link, $q);

		echo "<script>alert('회원이 정상적으로 삭제되었습니다');location.replace('RealAdmin.php');</script>"; 
		}
	}
	?>
