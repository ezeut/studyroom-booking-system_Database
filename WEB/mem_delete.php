<?php
    session_start();
    include "dbConnect.php";
    if(isset($_SESSION['user_id'])) $user_id = $_SESSION['user_id'];
    else $user_id = "";
    if(isset($_SESSION['name'])) $name = $_SESSION['name'];
    else $name = "";

    $sql = "DELETE FROM r_check WHERE rnum = (SELECT rnum FROM reservation WHERE MID = '$user_id')";
    $result = mysqli_query($connect,$sql);

    $sql2 = "DELETE FROM reservation WHERE mid = '$user_id'";
    mysqli_query($connect, $sql2);
 
    $sql3 = "DELETE FROM member WHERE mid = '$user_id'";
    mysqli_query($connect, $sql3);

    mysqli_close($connect);

?>
 <meta charset="utf-8" />
<script>alert("탈퇴가 완료되었습니다.");</script>
<meta http-equiv="refresh" content="0 url=logout.php">
