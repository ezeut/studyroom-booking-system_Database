<?php
	include "dbConnect.php";
	$mid = $_GET["mid"];
	$sql = "select * from member where MID='$mid'";
	$result = mysqli_query($connect,$sql);
	$members = mysqli_fetch_array($result);
	if($members==0)
	{
?>
	<div><?php echo $mid;?>는 사용가능한 아이디입니다.</div>
<?php 
	}else{
?>
	<div style='color:red;'><?php echo $mid; ?>이미 존재하는 아이디입니다. 아이디를 다시 입력해주세요.</div>
<?php
	}
	
	mysqli_close($connect);
?> 

    <br><input type="button" value="창닫기" onClick="window.close()">

