<?php 
    session_start();
    if(isset($_SESSION['user_id'])) $user_id = $_SESSION['user_id'];
    else $user_id = "";
    if(isset($_SESSION['name'])) $name = $_SESSION['name'];
    else $name = "";
   
    $logged = $name."(" .$user_id.")님으로 예약중입니다. ";

?>
<?=$logged?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>예약하기</title>
        <meta charset="UTF-8">
        <script>
            function check_input(){

            if (!document.reservation_form.sname.value) {
                alert("스터디룸을 선택하세요.");    
                document.reservation_form.sname.focus();
                return;
            }
            if (!document.reservation_form.rdate.value) {
                alert("날짜를 선택하세요.");    
                document.reservation_form.rdate.focus();
                return;
            }
            if (!document.reservation_form.rtime.value) {
                alert("시간을 선택하세요.");    
                document.reservation_form.rtime.focus();
                return;
            }
            document.reservation_form.submit();
        }
        </script>
    </head>
    <form name="reservation_form" method="POST" action="reservation_result.php">
        <body>
            <p>STEP 1 스터디룸 선택</p>
            <ul>
                <li><input type="radio" name="sname" value="a">A</li>
                <li><input type="radio" name="sname" value="b">B</li>
                <li><input type="radio" name="sname" value="c">C</li>
                <li><input type="radio" name="sname" value="d">D</li>
                <li><input type="radio" name="sname" value="e">E</li>
                <li><input type="radio" name="sname" value="f">F</li>
                <li><input type="radio" name="sname" value="g">G</li>
                <li><input type="radio" name="sname" value="h">H</li>
                <li><input type="radio" name="sname" value="i">I</li>
                <li><input type="radio" name="sname" value="j">J</li>
            </ul>
    
            <p>STEP 2 날짜 선택</p>
                <input type="date" name="rdate">    
            <p>STEP 3 시간 선택</p>
            <ul>
                <li><input type="radio" name="rtime" value="10">10:00</li>
                <li><input type="radio" name="rtime" value="12">12:00</li>
                <li><input type="radio" name="rtime" value="14">14:00</li>
                <li><input type="radio" name="rtime" value="16">16:00</li>
                <li><input type="radio" name="rtime" value="18">18:00</li>
                <li><input type="radio" name="rtime" value="20">20:00</li>
            </ul>
        <hr/>
            <button type="button" onclick="check_input()">예약하기</button> &nbsp;
            <input type="reset" value="초기화"></br></br>
            <button type = "button" onclick ="location.href='index.php'">메인화면</button>
        </body>
    </form>
</html>