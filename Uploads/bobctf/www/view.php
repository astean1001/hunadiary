<?php

session_start();

if( $_SESSION[user_id] == "" ) 
	echo ("<script> alert('세션이 만료되었습니다.'); location.replace('login.php'); </script>");


?>


<meta charset = "utf-8">

<script language="JavaScript">
	function check() {
		if( document.comment.elements[2].value == "" ) 
			alert("댓글 내용을 입력해주세요"); 
		else
			return true;
		return false;
	}
</script>

<div style="float:right;">	<!-- 오른쪽 정렬 -->
	<?php echo "$_SESSION[user_id]님이 로그인중 "; ?>

	<input type = 'button' value = "logout" onclick = "location.href='logout.php'"></input>

</div>

<br />
<br />
<br />

<center>
	<table cellspacing = 3 width = 700 height = 600>
		<tr height = 30>
			<td align = center width = 50>
				제목 
			</td> 
			<td style = "border-left: 1px solid; border-right: 1px solid; border-top: 1px solid; border-bottom: 1px solid;" bordercolor="#CCCCCC">
				<?php
				$No = preg_replace("/[\<\>\'\"\\\'\\\"\%\=\(\)\s]/", "", $_GET['No']);		// 글 번호(No)를 Get으로 전달받아서 출력하는 것으로 함
				$link = mysqli_connect("localhost", "root", "mysql123", "myfirst_db");
				$no = htmlspecialchars($No);
				$No = mysqli_real_escape_string($link,$no);	// SQL 인젝션 방지
				
				$q = "select * from board where No = $No";
				$result = mysqli_query($link, $q);
				$result_array = mysqli_fetch_array($result);		// 현재 글번호에 해당하는 데이터를 불러와서 배열에 저장

				$comment_num = $result_array['comment_num'];	// 밑에 댓글에 사용될 변수 저장				
				$filename = $result_array['filename'];
				$filehash = $result_array['filehash'];

				echo htmlspecialchars($result_array[title]);
				
				?>
			</td>
		</tr>
		<tr height = 30>
			<td>
				작성자
			</td>
			<td style = "border-left: 1px solid; border-right: 1px solid; border-top: 1px solid; border-bottom: 1px solid;" bordercolor="#CCCCCC">
				<?php echo htmlspecialchars($result_array[id]);?>
			</td>
		</tr>
		<tr height = 30>
			<td>
				작성일
			</td>
			<td style = "border-left: 1px solid; border-right: 1px solid; border-top: 1px solid; border-bottom: 1px solid;" bordercolor="#CCCCCC">
				<?php echo " $result_array[regidate]";?>
			</td>
		</tr>
		<tr>
			<td align = center>
				내용
			</td>
			<td align = left valign = top style = "border-left: 1px solid; border-right: 1px solid; border-top: 1px solid; border-bottom: 1px solid;" bordercolor="#CCCCCC" >
				<?php
				$allow_tag = "<a> <img>";	// <a> <img> 태그는 제한하지 않음
				//echo strip_tags($result_array[content], $allow_tag);	// 하지만 태스 자체가 없어지므로 다른 방법시도

				$content = htmlspecialchars($result_array[content]);
				$content = preg_replace('/&lt;img.+?&gt;/se',"html_entity_decode('$0')",$content);	//정규표현식, html 특수문자 표 참고
				$content = preg_replace('/&lt;a(.*)&gt;(.*)&lt;&#47;a&gt;/is', "html_entity_decode('$0')",$content);
				echo $result_array[content];
				
				?>

			</td>
		</tr>
		<tr height = 30>
			<td align = center>
				파일
			</td>
			<td align = left valign = mid style = "border-left: 1px solid; border-right: 1px solid; border-top: 1px solid; border-bottom: 1px solid;" bordercolor="#CCCCCC">
				<a href = "download.php?No=<?php echo "$No";?>"><?php echo $filename;?></a>
				<?php
					if($filename == "") {
						echo "업로드된 파일이 없습니다.";
					}
				?>
			</td>
		<tr height = 30>
			<td>
			</td>
			<td align = right > 
				<input name = 'back' type = 'button' value = 'Back' onclick = "location.href = 'list.php'">
				<input name = 'delete' type = 'button' value = 'Delete' onclick = "location.href = 'delete.php?No=<?php echo "$No" ?>'">
				<input name = 'modify' type = 'button' value = 'Modify' onclick = "location.href = 'modify.php?No=<?php echo "$No" ?>'">
			</td>
		</tr>
	</table>

	<table width = 800>
		<tr height = 30>
			<td>
			<H3>댓글</H3>
			</td><td></td>
		</tr>
		<?php
		
		$q = "select comment_num from board where No = '$No'";	//comment 테이블에서 현재 글번호를 가진 댓글들의 갯수를 가져옴
		$result = mysqli_fetch_row(mysqli_query($link, $q));
		$size = $result[0];

		for($i = 1; $i <= $size; $i++)
		{
			$q = "select * from comment where No ='$No' and No_num = '$i'";		//comment 테이블에서 현재 글번호와 i번째 댓글을 가져옴
			$result = mysqli_query($link, $q);
			$result_array = mysqli_fetch_array($result);
			if($result_array['id'] == "") {
				echo "<tr height = 40>";
				echo "<td align = 'center' style = 'width: 150px;'>";
				echo "</td>";
				echo "<td align = 'center' style = 'border-left: 1px solid; border-right: 1px solid; border-top: 1px solid; border-bottom: 1px solid;'>";
				echo "삭제된 댓글입니다.";
				echo "<td> </td>";
			}
			else {
				echo "<tr height = 60>";
				echo "<td align = 'center' style = width: 150px;'>";
				echo htmlspecialchars($result_array['id'])."<br />".htmlspecialchars($result_array['regidate']);
				echo "</td>";
				echo "<td style = ' border-left: 1px solid; border-right:1px solid; border-top: 1px solid; border-bottom: 1px solid;'>";
				echo htmlspecialchars($result_array['content']);
				echo "</td>";
				echo "<td align = 'center'>";
				echo "<input name = 'delete' type = 'button' value = '삭제' onclick = \"location.href = 'comment_delete.php?No=$No&No_num=$i'\">";
				echo "</td>";
				echo "</tr>";
			}
		}

		?>
		<!-- 댓글 입력 시작 -->
		<tr>
			<form name = 'comment' method = 'post' action = 'comment_regi.php' onsubmit = 'return check()'>
			<td>
			</td>	
			<input name = 'No' type = 'hidden' value = '<?php echo "$No";?>'>
			<!-- 글 번호를 히든으로 전달 댓글 번호는 히든으로 전달 X -->
<!--			<input name = 'comment_num' type = 'hidden' value = '<?php// echo "$comment_num";?>'> -->
			<td>
				<textarea name = 'content' style = 'width:500; height: 100;border: 1px solid #000000; padding: 5px 0px 0px 5px;'>해당 댓글 기능은 지금 지원하지 않습니다</textarea>
			</td>
			<td>
				
			</td>
		</tr>
	</table>
</center>
