<?php 
   session_start();
   include "dbConnect.php";

   if(isset($_SESSION['user_id'])) $user_id = $_SESSION['user_id'];
   else $user_id = "";
   if(isset($_SESSION['name'])) $name = $_SESSION['name'];
   else $name = "";

?>

<?php
    if(!$user_id) {
?>	 
    <p>로그인 후 이용가능합니다. </br></br>
	<button type = "button" onclick = "location.href='login.php'">로그인</button> &nbsp;&nbsp;
    <button onclick ="location.href='join.php'">회원가입</button> &nbsp;
<?php
    }
    elseif($user_id=='admin'){
        $logged = $name."(관리자)님 안녕하세요! ";
?>
    <?=$logged?>
    </br></br>
    <button onclick = "location.href='admin_reservation.php'">예약관리</button> &nbsp;&nbsp;
    <button onclick = "location.href='admin_memlist.php'">회원목록</button></br></br>
    <button type = "button" onclick = "location.href='logout.php?'">로그아웃</button></br></br>
    <?php

 } else {
	$logged = $name."(" .$user_id.")님 안녕하세요! ";
?>
    <?=$logged?>
    </br></br>
    <button onclick = "location.href='reservation.php'">예약하기</button> &nbsp;&nbsp;
    <button onclick = "location.href='reservation_check.php'">예약 확인하기</button></br></br>
    <button onclick = "location.href='mem_modify.php'">회원정보수정</button> &nbsp;&nbsp;
    <button type = "button" onclick = "location.href='logout.php?'">로그아웃</button></br></br>
    <form method = "POST" name = "mem_delete" action="mem_delete.php">
    <input type = "submit"  onclick ="m_delete()" value="회원탈퇴">
    </form>
    <script>
            function m_delete(){
                const con = confirm("예약 내역이 모두 삭제됩니다. 정말 탈퇴하시겠습니까?");
                if(con){
                    document.mem_delete.submit();
                }
                else{
                }
        }
    </script>

<?php
 }
?>

