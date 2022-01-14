
<?php
    include "dbConnect.php";
    $rnum = $_GET['rnum'];
    $cstate = $_POST['cstate'];
    $sql = "UPDATE r_check SET cstate = '$cstate' WHERE rnum = '$rnum'";
    mysqli_query($connect, $sql);
    mysqli_close($connect);
?>
<script>alert("변경되었습니다.");</script>
<meta http-equiv="refresh" content="0 url=admin_reservation.php">