<html>
	<head>
		<meta charset = "utf-8">
	<title>
		회원 가입 페이지
	</title>
	<p>
	<center>회원 가입 페이지</center>
	</p>
	</head>
	<body>
		<form method = "post" action = "auth.php">
		<center>
		<table>
		
		<tr>
		<td>ID</td>

		<td>
		<input name ="nick" type = "text" maxlength = "20" autocomplete = off>
		</td>
		</tr>

		<tr>
		<td>비밀번호</td>

		<td>
		<input name = "word" type = "text" maxlength = "20" autocomplete = off>
		</td>
		
		</tr>
		<tr>
		<td>비밀번호 확인</td>
		<td>
		<input name = "words" type = "text" maxlength = "20" autocomplete = off>
		</td>
		</tr>
		<tr>
		<td>이름</td>
		
		<td>
		<input name = "name" type = "text" maxlength = "20" autocomplete= off>
		</td>
		</tr>

		<tr>
		<td>E-mail</td>
		
		<td>
		<input name = "mail" type = "text" maxlength = "20" autocomplete = off>
		</td>
		</tr>

		<tr>
		<td>전화번호</td>

		<td>
		<input name = "number" type ="text" maxlength = "20" autocomplete = off>
		</td>
		</tr>
		</table>
		<p></p><p></p>
		<input type ="submit">
		</center>
		</form>
		
	</body>
</html>
	
