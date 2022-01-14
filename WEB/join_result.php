<?php
	include "dbConnect.php";

	$mid = $_POST['user_id'];
	$mpw = ($_POST['pw']);
	$mname = $_POST['name'];
	$mtel = $_POST['tel'];

	$id_sql = "select * from member where MID='$mid'";
	$result = mysqli_query($connect,$id_sql);
	$members = mysqli_fetch_array($result);
	if($members)
	{
?>
	<script>
		alert('이미 존재하는 아이디입니다. 아이디를 다시 입력해주세요.');
		history.go(-1);
	</script>

<?php 
	} else{
		$sql = "INSERT INTO member(mid, mpw, mname, mtel) VALUES('$mid', '$mpw','$mname', '$mtel');";
	
		mysqli_query($connect,$sql);
		mysqli_close;
?>
	
	<meta charset="utf-8" />
	<script type="text/javascript">alert('회원가입이 완료되었습니다.');</script>
	<meta http-equiv="refresh" content="0 url=index.php">
<?php
	}
?>

