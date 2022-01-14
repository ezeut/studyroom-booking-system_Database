<?php 
        include "dbConnect.php";
		$query ="select * from members";
        $result = mysqli_query($connect,$sql);
		
        session_start();
        $result = session_destroy();
 
        if($result) {
?>
        <script>
                alert("로그아웃 되었습니다.");
        </script>
<?php   }
?>
<meta http-equiv="refresh" content="0 url=index.php">
