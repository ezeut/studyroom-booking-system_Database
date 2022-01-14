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
        <title>회원 목록</title>
        <meta charset="UTF-8">        
    </head>
    <body>
    <h3>회원 목록</h3>
    
<?php
	
	$sql = "SELECT * FROM member";
	$result = mysqli_query($connect, $sql);
	
	$num_match = mysqli_num_rows($result);
	
	
?>
    
    <table border = 1>
            <tr>
                <th>회원ID</th>
                <th>회원이름</th>
                <th>전화번호</th>
            </tr> 
<?php
    while ($row = mysqli_fetch_array($result)){	  
	    echo "<tr>";
	    echo "<td>".$row['mid']."</td>" ;
	    echo "<td>".$row['mname']."</td>" ;
	    echo "<td>".$row['mtel']."</td>" ;

        echo "</tr>";
   }
   echo "</br>";
?>
    </table>

    </br><button type = "button" onclick ="location.href='index.php'">메인화면</button>
    <button type = "button" onclick = "location.href='logout.php?'">로그아웃</button>
    </body>
</html>
