<?php   
 include "dbConnect.php"; 
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>로그인</title>
    </head>
    <body>
	<form method="POST" action="login_check.php">
		<h1>로그인</h1>
			<table>
                <tr>
				    <td>아이디</td>
				    <td><input type="text" size="35" name="user_id" id="uid" placeholder="아이디" required></td>
				</tr>
				<tr>
					<td>비밀번호</td>
					<td><input type="password" size="35" name="pw" placeholder="비밀번호"></td>
				</tr>
			</table><br>
		<button type = "submit" id="btn" >로그인</button>&nbsp
        <button type = "button" onclick ="location.href='join.php'">회원가입</button>&nbsp
        <button type = "button" onclick ="location.href='index.php'">메인화면</button>
	</form>
    </body>
</html>

