<!DOCTYPE HTML>
<html>
    <head>
        <title>회원가입</title>
        <meta charset="UTF-8">
        <script>
            function checkid(){
                var mid = document.getElementById("uid").value;
                if(mid)
                {
                url = "id_check.php?mid="+mid;
                    window.open(url,"chkid","width=400,height=150");
                }else{
                    alert("아이디를 입력하세요");
                }
            }
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
        <form name="member_form" method="POST" action="join_result.php" onsubmit="return checkpw();">
            <h1>회원가입</h1>            
                <table>
                    <tr>
                        <td>아이디</td>
                        <td><input type="text" size="15" name="user_id" id="uid" autocomplete="off" required>
					        <input type="button" value="중복검사" onclick="checkid();">
                        </td>
                    </tr>
                    <tr>
                        <td>비밀번호</td>
                        <td><input type="password" size="15" name="pw" id="upw" required></td>
                    </tr>
                    <tr>
                        <td>비밀번호 확인</td>
                        <td><input type="password" size="15" name="pw_confirm" id="upw2" onchange="checkpw()">&nbsp<span id="check"></span></td>
                    </tr>	


                    <tr>
                        <td>이름</td>
                        <td><input type="text" name="name" id="uname" size="10" autocomplete="off" required></td>
                    </tr>
                    <tr>
                        <td>전화번호</td>
                        <td><input type="text" name="tel" id="utel" maxlength="12" placeholder="-없이 숫자만 입력하세요" autocomplete="off" required></td>
                    </tr>
                    
                </table></br>

                <button type="button" onclick="check_input()">회원가입</button> &nbsp; <input type="reset" value="초기화"></br></br>
                <button type ="button" onclick ="location.href='index.php'">메인화면</button>
        </form>
    </body>
</html>
