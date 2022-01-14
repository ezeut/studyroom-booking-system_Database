<?php
   session_start();
   include "dbConnect.php";
   if(isset($_SESSION['user_id'])) $user_id = $_SESSION['user_id'];
   else $user_id = "";
   if(isset($_SESSION['name'])) $name = $_SESSION['name'];
   else $name = "";

?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>예약 관리</title>
        <meta charset="UTF-8">
        
    </head>
<?php
    $logged = $name."(" .$user_id.")님 예약관리중입니다. ";
?>
<?=$logged?>
    
<?php
	$sql = "SELECT distinct r.rnum, m.mname, r.sname, s.scapacity, r.rdate, r.rtime, c.cstate
            FROM reservation AS r, member AS m, studyroom AS s, r_check AS c
            JOIN member, studyroom, r_check
            WHERE r.mid = m.mid and r.rnum = c.rnum and r.sname = s.sname;";

	$result = mysqli_query($connect, $sql);
	
	$num_match = mysqli_num_rows($result);
	
	if(!$num_match) {
?>	 
    <hr>예약내역이 없습니다. </br></br>
    <hr>
	
<?php		
	} else {
?>
    
    <table border = 1>
        <caption> <h3> 예약 정보 </h3> </caption>
            <tr>
                <th>예약 번호</th>
                <th>회원 이름</th>
                <th>스터디 룸</th>
                <th>수용 인원</th>
                <th>예약 시간</th>
                <th>예약 날짜</th>
                <th>예약 상태</th>
                <th>예약 관리</th>
            </tr> 
<?php
    while ($row = mysqli_fetch_array($result)){	  
        ?><form method="POST" name="admin_reservation" action="admin_state_update.php?rnum=<?=$row['rnum']?>"><?php
	    echo "<tr>";
        echo "<td>".$row['rnum']."</td>" ;
        echo "<td>".$row['mname']."</td>" ;
	    echo "<td>".$row['sname']."</td>" ;
        echo "<td>".$row['scapacity']."</td>" ;
	    echo "<td>".$row['rtime'].":00 시</td>" ;
	    echo "<td>".$row['rdate']."</td>";
        echo "<td>";?>
        <input type="text" size="7" name="cstate" value="<?=$row['cstate']?>"><?php
        echo "</td>";
        echo "<td>" ;
        ?><input type="submit" onclick="update_state()" value="상태 변경">
        <?php
        echo "</td>";
        echo "</tr>";
        ?></form><?php

   }
   echo "</br>";
   mysqli_close($connect);
?>
    </table>
    <h4>예약상태를 입력하고 우측의 '상태 변경' 버튼을 클릭해야 반영이 됩니다.</h4>
    <script>
    function update_state(){
        document.admin_reservation.submit();          
    }
    </script>
<?php
    }
?>
    </br><button type = "button" onclick ="location.href='index.php'">메인화면</button>
    <button type = "button" onclick = "location.href='logout.php?'">로그아웃</button>
</html>
