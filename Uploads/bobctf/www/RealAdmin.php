<?php

session_start();

	echo "<meta charset = 'utf-8'>";

	

	$link = mysqli_connect("localhost", "root", "mysql123", "myfirst_db");
	$q = "select * from boarddb.member where id='$_SESSION[user_id]'";
	$result = mysqli_query($link, $q);
	$result_arr = mysqli_fetch_row($result);
	$i=0;
	if($result_arr[5] != 'admin')
		echo "<script>alert('Oh you are not admin~!');location.replace('login.php');</script>";
	else{
		
		$q = "select * from boarddb.member";
		$result = mysqli_query($link, $q);
		

		?>
	<table cellspacing = '1' style="width:800px;height:50px;border:0px; border-collapse:collapse;" rules = "rows" frame = "hsides">
			
			<td align="center" valign="middle" width="5%" style="height:30px;">ID</td>
			<td align="center" valign="middle" width="60%" style="height:30px;">PW</td>
			<td align="center" valign="middle" width="15%" style="height:30px;">name</td>
			<td align="center" valign="middle" width="20%" style="height:30px;">mail</td>
			<td align="center" valign="middle" width="50%" style="height:30px;">phonenumber</td>
			<td align="center" valign="middle" width="30%" style="height:30px;">role</td>
		</tr>
	<?php
			echo "<form method = 'POST' action = 'admin_function.php'>";
			echo "회원 목록 ";
			while($result_arr = mysqli_fetch_row($result)){	
			echo "<tr><td align='center' valign='middle' width='5%' style='height:30px;'>$result_arr[0]</td>";
			echo "<td align='center' valign='middle' width='60%' style='height:30px;'>$result_arr[1]</td>";
			echo "<td align='center' valign='middle' width='15%' style='height:30px;'>$result_arr[2]</td>";
			echo "<td align='center' valign='middle' width='20%' style='height:30px;'>$result_arr[3]</td>";
			echo "<td align='center' valign='middle' width='50%' style='height:30px;'>$result_arr[4]</td>";
			echo "<td align='center' valign='middle' width='30%' style='height:30px;'>$result_arr[5]</td>";
			
			}
			echo "</table>";
			echo "</br>";
			echo "삭제할 회원 : <input name = 'id' type =  'text' maxlength = '200' autocomplete = off>";
			echo "<input type = 'submit' value =  '삭제하기'></a>";
			echo "</br>";
			echo "</br>";
			echo "(저희 게시판은 회원들의 의사표현의 권리를 존중합니다 그렇기 때문에 회원을 삭제하거나 회원의 글을 삭제 할 수 있을지 언정 회원의 글이나 정보를 무단 수정할 수는 없습니다)";
			
			
	}
		
	
	
?>
