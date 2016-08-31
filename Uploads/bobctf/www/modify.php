<?php

session_start();

if( $_SESSION[user_id] == "" ) 
	echo ("<script> alert('세션이 만료되었습니다.'); location.replace('login.php'); </script>");

$link = mysqli_connect("localhost", "root", "mysql123", "myfirst_db");

$No = mysqli_real_escape_string($link, $_GET[No]);

$q = "select * from board where No = $No";
$result = mysqli_query($link, $q);
$result_arr = mysqli_fetch_array($result);
$session_id = $_SESSION[user_id];	// 세션 데이터를 문자열로 바꾸기 위해 사용

if( $session_id != $result_arr[id] )
	echo ("<script> alert('작성자만 글을 수정할 수 있습니다.'); history.back(); </script>");

?>

<head>

<meta charset = "utf-8">

<script language="JavaScript">
	function check() {
		if( document.formSubmit.elements[0].value == "" ) 
			alert("제목을 입력해주세요");
		else if ( document.formSubmit.elements[1].value == "" ) 
			alert('내용을 입력해주세요'); 
		else
			return true;
		return false;
	}
	
</script>

</head>

<div style="float:right;">
	<?php echo "$_SESSION[user_id]님이 로그인중 "; ?>

	<input type = 'button' value = "logout" onclick = "location.href='logout.php'"></input>

</div>

<br />
<br />
<br />

<center>
	<form name='formSubmit' method = 'post' enctype = "multipart/form-data" action = 'board_modi.php?No=<?php echo $No; ?>' onsubmit = 'return check()'>
	<table cellspacing = 3 width = 700 height = 600>
		<tr height = 30>
			<td align = center width = 50>
			 제목 
			</td> 
			<td> 
				<input size = 70 name = 'title' value = <?php echo htmlspecialchars($result_arr[title]); ?> style = "padding:0px 0px 0px 5px; border: 1px solid #000000;"> </input> 
			</td>
		</tr>
		<tr>
			<td align = center>
			 내용
			</td>
			<td> 
				<textarea name = 'content' style = "width:600;height:550px; border: 1px solid #000000;padding : 5px 0px 0px 5px;"><?php echo htmlspecialchars($result_arr[content]); ?></textarea>
			</td>
		</tr>
		<tr height = 30>
                        <td align = center width = 50>
                         파일
                        </td>
                        <td>
                                <input type = 'file' name = 'file' style = "padding : 0px 5px 0px 0px; border: 1px solid #000000;">
				<?php echo $result_arr[filename];?>	<!-- 현재 들어있는 파일의 이름을 출력시켜줌 -->
                        </td>
                </tr>
		<tr height = 30>
			<td>
			</td>
			<td align = right > 
				<input name = 'back' type = 'button' value = 'Back' onclick = "location.href = 'view.php?No=<?php echo $No; ?>'"> 
				<input name = 'submit' type = 'submit' value = 'Submit'>
			</form>
			</td>
		</tr>
	</table>
</center>
