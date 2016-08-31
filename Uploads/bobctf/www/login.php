<html>
	<head>
		<meta charset="utf-8">
		<title>
		Login page
		</title>
	</head>
	<body>
		<form method = "POST" action = "login_check.php">
		<center>
		Login page
		<table>
		<tr>
			<p>
			<td>ID : </td>
			<td><input name = "id" type =  "text" maxlength = "200" autocomplete = off>
			</td>
			</p>
		</tr>
		<tr>
			<td>password : </td>
			<td><input name = "pw" type = "password" maxlength = "200" autocomplete = off>
			<input type="hidden" name="isAdmin" value="FALSE">
			</td>
		</tr>
		</table>
		<p>
		<input type = "submit" value =  "로그인">
		<input type = "button" value = "회원가입" onclick = "location.href ='make_id.php'">
		</form>
		</p>
		<p>
		
		</p>
	</body>
</html>
