<?php	
	include "dbConnect.php";
	
	$user_id = $_POST['user_id'];
	$pw = $_POST['pw'];
	
	$sql = "select * from member where MID = '$user_id' ";
	$result = mysqli_query($connect, $sql);
	
	$num_match = mysqli_num_rows($result);
	
	if(!$num_match) {
		echo( "
		<script>
		 window.alert('등록되지 않은 아이디입니다.')
		 history.go(-1)
		</script>
        ");		
	} else {
		$row = mysqli_fetch_array($result);
		$mpw = $row['mpw'];
		
		mysqli_close($connect);
		
		if( $mpw == $pw) {
		 session_start();
		 $_SESSION['user_id'] = $row['mid'];
		 $_SESSION['name'] = $row['mname'];
		
		 echo("
		  <script>
		   location.href = 'index.php' ; 
		  </script>
		 "); 			
		} else {
			echo("
			 <script> 
			  window.alert('비밀번호가 틀립니다.')
			  history.go(-1)
			 </script>
            ");
           exit;				

	    }
	}
	 
?>
