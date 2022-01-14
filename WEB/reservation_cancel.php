<?php
    include "dbConnect.php";

    $rnum = $_GET['rnum'];
    $sql1 = "DELETE FROM r_check WHERE rnum = '$rnum'";
    mysqli_query($connect, $sql1);

    $sql2 = "DELETE FROM reservation WHERE rnum = '$rnum'";
    mysqli_query($connect, $sql2);
    mysqli_close($connect);
?>
<script>
    alert("취소되었습니다.");
    history.go(-1);
</script>