<?php
	session_start();
    include "dbConnect.php";
    if(isset($_SESSION['user_id'])) $user_id = $_SESSION['user_id'];
    else $user_id = "";

	$mpw = $_POST['pw'];

    $sql = "UPDATE member SET mpw = '$mpw' WHERE mid = '$user_id';";
	
	mysqli_query($connect,$sql);
    mysqli_close;

?> 

 <meta charset="utf-8" />
 <script type="text/javascript">alert('비밀번호가 변경되었습니다. 다시 로그인 해주세요.');</script>
 <meta http-equiv="refresh" content="0 url=logout.php">
