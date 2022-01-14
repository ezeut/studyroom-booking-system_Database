<?php
    include "dbConnect.php";
    session_start();

    if(isset($_SESSION['user_id'])) $user_id = $_SESSION['user_id'];
    else $user_id = "";
    if(isset($_SESSION['name'])) $name = $_SESSION['name'];
    else $name = "";
    
    $sname = $_POST ['sname'];
    $rdate = $_POST ['rdate'];
    $rtime = $_POST ['rtime'];
	
	$r_sql = "SELECT * FROM reservation WHERE sname = '$sname' AND rdate = '$rdate' AND rtime = '$rtime' ";
	
    $result = mysqli_query($connect, $r_sql);
	$num_match = mysqli_num_rows($result);
	
	if($num_match) {	
        ?>
        <script>
            alert("이미 예약된 시간입니다. 다시 선택해주세요");
            history.go(-1);
        </script>
        <?php

	} else {
        $sql = "INSERT INTO reservation(mid, sname, rdate, rtime) VALUES('$user_id','$sname', '$rdate','$rtime');";
        $result = mysqli_query($connect,$sql);

        $rnum = $connect->insert_id;
        $sql2 = "INSERT INTO r_check(rnum) VALUES('$rnum')";
        mysqli_query($connect,$sql2);
        mysqli_close;
        
        ?>
        <meta charset="utf-8" />
        <script type="text/javascript">alert('예약이 완료되었습니다.'); </script>
        <meta http-equiv="refresh" content="0 url=index.php">
        <?php
    }
    ?>
   


