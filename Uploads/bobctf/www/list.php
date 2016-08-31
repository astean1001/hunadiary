<?php

session_start();

echo "<meta charset = 'utf-8'>";
?>

<div style="float:right;"> <!-- 오른쪽 정렬 --> 
	<?php echo "$_SESSION[user_id]님이 로그인중 "; 
				
	?>

	<input type = 'button' value = "logout" onclick = "location.href='logout.php'"></input>
	<!-- 로그아웃 -->
</div>

<br />
<br />
<br />

<center>
<!-- 게시판 그림 삽입 -->

<br />
<br />

<!-- 글목록 시작-->
	
	<table cellspacing = '1' style="width:800px;height:50px;border:0px; border-collapse:collapse;" rules = "rows" frame = "hsides">
		<tr style = "background-color:#999999;">	
			<td align="center" valign="middle" width="5%" style="height:30px;">번호</td>
			<td align="center" valign="middle" width="60%" style="height:30px;">제목</td>
			<td align="center" valign="middle" width="15%" style="height:30px;">작성자</td>
			<td align="center" valign="middle" width="20%" style="height:30px;">작성일</td>
		</tr>
<?php

$link = mysqli_connect("localhost", "root", "mysql123", "myfirst_db");
	$q = "select role from boarddb.member where id='$_SESSION[user_id]'";
	$result = mysqli_query($link, $q);
	$result_arr = mysqli_fetch_row($result);

	if($result_arr[0] == 'admin')
	echo "<a href = 'RealAdmin.php'>Admin</a>";
	

if($_GET['page'] == "")
	$_GET['page'] = 1;	// 로그인 후 바로 list.php로 들어왔을 경우에 대한 처리 => 첫 페이지를 보여준다.

$is_nothing = 1;	// 게시물이 하나라도 존재하는지 체크
$page_size = 10;

$page = mysqli_real_escape_string($link, $_GET['page']);

$q = "select count(*) from board";
$result = mysqli_query($link, $q);
$result_arr = mysqli_fetch_row($result);
$total = $result_arr[0];	// 총 게시물 수
$page_num = ceil($total/$page_size);

$q = "select * from board order by No desc limit ".(($page-1)*$page_size).", 1";
$result = mysqli_query($link, $q);
$result_arr = mysqli_fetch_row($result);
$top = $result_arr[0];		// 해당 페이지 맨위에 위치할 글의 번호를 추출
$q = "select * from board order by No desc limit ".((($page-1)*$page_size)+$page_size).", 1";
$result = mysqli_query($link, $q);
$result_arr = mysqli_fetch_row($result);
$bottom = $result_arr[0];	// 해당 페이지 맨아래에 위치할 글의 번호를 추출

for($i = $top; $i > $bottom; $i--) {
	$q = "select count(*) from comment where No = '$i'";
	$result = mysqli_query($link, $q);	
	$arr_result = mysqli_fetch_row($result);
	$No_num = $arr_result[0];		// 해당 게시글의 댓글 갯수를 불러온다.

	$q = "select * from board where No = '$i'";
	$result = mysqli_query($link, $q);	// 각 줄에대한 정보를 가져온다. 높은번호(최근) 부터 가져옴.
	$arr_result = mysqli_fetch_array($result);
	if( $arr_result[No] == "")
		continue;

	echo "	<tr>
			<td align='center' valign='middle' width='5%' style='height:30px;'>".htmlspecialchars($arr_result[No])."</td>
			<td align='center' valign='middle' width='60%' style='height:30px;'><a href = 'view.php?No=$arr_result[No]'>".htmlspecialchars($arr_result[title])."</a> [$No_num]</td>
			<td align='center' valign='middle' width='15%' style='height:30px;'>".htmlspecialchars($arr_result[id])."</td>
			<td align='center' valign='middle' width='20%' style='height:30px;'>$arr_result[regidate]</td>
		</tr>";
	$is_nothing = 0;
}

if( $is_nothing == 1 )
	echo "  <tr>
			<th colspan = 4 align='center' valign='middle' width='100%' style='height:30px;'> 게시물이 존재하지 않습니다. </th>
		</tr>";

?>
	</table>
<!-- 글목록 끝-->

	<br />
	<?php
// $page_num 은 총 페이지 개수 == 마지막 페이지 번호

	if($page_num > 10) {
		if( $page > 5 && $page < $page_num - 4 ) {		// 중간부분
	
			echo "<a href = 'list.php?page=".($page - 5)."'>◀ 이전</a>  ";
			echo "<a href = 'list.php?page=1'>1</a>  ...  ";		
	
			for($i = $page - 4; $i <= $page + 4; $i++)
			{
				if($i == $page)
					echo "$i ";
				else
					echo "<a href = 'list.php?page=$i'>$i</a>  ";
			}
			
			echo "...  <a href = 'list.php?page=$page_num'>$page_num</a>  ";
			echo "<a href = 'list.php?page=".($page + 5)."'>다음 ▶</a>";
		}
		else if( $page <= 5) {					// 앞부분
			for($i = 1; $i <= $page + 4; $i++)
			{
				if($i == $page)
					echo "$i ";
				else
					echo "<a href = 'list.php?page=$i'>$i</a>  ";
			}
		
		echo "... <a href = 'list.php?page=$page_num'>$page_num</a>  ";
				echo "<a href = 'list.php?page=".($page + 5)."'>다음 ▶</a>";
		}
		else if( $page >= $page_num -4 ) {			// 뒷부분
			echo "<a href = 'list.php?page=".($page - 5)."'>◀ 이전</a>  ";
			echo "<a href = 'list.php?page=1'>1</a>  ...  ";		
	
			for($i = $page - 4; $i <= $page_num; $i++)
			{
				if($i == $page)
					echo "$i ";
				else
					echo "<a href = 'list.php?page=$i'>$i</a>  ";
			}
		}
	} else{
		for($i = 1; $i <= $page_num; $i++) {
			if($i == $page)
				echo "$i ";
			else
				echo "<a href = 'list.php?page=$i'>$i</a>  ";
		}
	}
	?>
	<br />
	<br />
	<input name = 'write' type = 'button' value = 'write' onclick = "location.href = 'write.php'">
</center>
