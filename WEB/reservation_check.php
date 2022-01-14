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
        <title>예약 확인</title>
        <meta charset="UTF-8">
        
    </head>
<?php
    $logged = $name."(" .$user_id.")님의 예약내역입니다. ";
?>
<?=$logged?>
    
<?php
	
	$sql = "SELECT r.rnum, r.sname, r.rdate, r.rtime, c.cstate FROM reservation AS r JOIN r_check AS c WHERE r.rnum = c.rnum AND r.mid = '$user_id'";
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
        <caption> <h1> 예약 정보 </h1> </caption>
            <tr>
                <th>예약 번호</th>
                <th>스터디 룸</th>
                <th>예약 날짜</th>
                <th>예약 시간</th>
                <th>예약 상태</th>
                <th> 취소 </th>
            </tr> 
<?php
    while ($row = mysqli_fetch_array($result)){	  
        ?><form method="POST" name="reservation_check" action="reservation_cancel.php?rnum=<?=$row['rnum']?>"><?php
	    echo "<tr>";

        $rnum = $row[0];
        echo "<td>".$rnum."</td>" ;
	    echo "<td>".$row[1]."</td>" ;
	    echo "<td>".$row[2]."</td>" ;
	    echo "<td>".$row[3]."시</td>" ;
        echo "<td>".$row[4]."</td>";
        echo "<td>" ;
        ?><input type="submit" onclick="cancel()" value="취소">
        <script>
            function cancel(){
                const con = confirm("정말 취소하시겠습니까?");
                if(con){
                    document.reservation_check.submit();
                }
                else{
                }
        }
        </script>
        <?php
        echo "</td>";
        echo "</tr>";
        ?></form><?php
   }
   echo "</br>";
?>
    </table>
    

<?php
    }
?>
    </br><button type = "button" onclick ="location.href='index.php'">메인화면</button>
    <button type = "button" onclick = "location.href='logout.php?'">로그아웃</button>
</html>
