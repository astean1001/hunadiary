<html>
        <head>
                <meta charset="utf-8">
                <title>
		Admin Login page
                </title>
        </head>
        <body>
                <form method = "POST" action = "../login_check.php">
                <center>
                Admin Login page
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
                        </td>
			
			<input type="hidden" name="isAdmin" value="FLASE">
                </tr>
                </table>
                <p>
                <input type = "submit" value =  "로그인">
                
                </form>
                </p>
                <p>

                </p>
        </body>
</html>
                       
