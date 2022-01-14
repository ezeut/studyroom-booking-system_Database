<?php  
	session_start();
    include "dbConnect.php";
    if(isset($_SESSION['user_id'])) $user_id = $_SESSION['user_id'];
    else $user_id = "";
    if(isset($_SESSION['name'])) $name = $_SESSION['name'];
    else $name = "";
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>비밀번호 변경</title>
	<script>
	  function checkpw(){
                var password = document.getElementById("upw").value;
                var password2 = document.getElementById("upw2").value;
                    
                if(!password){
                    alert("비밀번호를 입력하세요");
                    return false;
                } else { }
                if(password != password2){
                    document.getElementById('check').innerHTML='비밀번호가 일치하지 않습니다.';
                    document.getElementById('check').style.color='red';                    	  
                } else {
                    document.getElementById('check').innerHTML='비밀번호가 일치합니다.'
                    document.getElementById('check').style.color='blue';  
                }
            }
            function check_input(){

                if (!document.member_form.pw_confirm.value) {
                    alert("비밀번호확인을 입력하세요!");    
                    document.member_form.pw_confirm.focus();
                    return;
                }

                if (document.member_form.pw.value != 
                        document.member_form.pw_confirm.value) {
                    alert("비밀번호가 일치하지 않습니다.\n다시 입력해 주세요!");
                    document.member_form.pw.focus();
                    document.member_form.pw.select();
                    return;
                }

                document.member_form.submit();
            }  
    </script>
</head>
<body>
	<form method="POST" action="mem_update.php" onsubmit="return checkpw();"> 
		<h3>비밀번호 변경</h3>
					<table>
                        <tr>
                            <td>비밀번호</td>
                            <td><input type="password" size="15" name="pw" id="upw" required></td>
                        </tr>
                        <tr>
                            <td>비밀번호 확인</td>
                            <td><input type="password" size="15" name="pw_confirm" id="upw2" onchange="checkpw()">&nbsp<span id="check"></span></td>
                        </tr>				
					</table><br>

				<input type="submit" value="수정" /> &nbsp;&nbsp;
                <button type = "button" onclick ="location.href='index.php'">메인화면</button>
				
	</form>
</body>
</html>

