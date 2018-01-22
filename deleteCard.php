<?php

session_start();
include "connect.php";

if(isset($_GET['fileName'])){
	$fileName = $_GET['fileName'];
	
	$deletecommand = "DELETE FROM image WHERE fileName=?";
	
	$stmt = $dbh->prepare($deletecommand);
	$success = $stmt->execute(array($fileName));
}
else{
	echo "<p>Unable to delete information</p>";
}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Deleting a card</title>
	</head>
	<body>
		<div id="bgWrap">
			<?php
			if(isset($fileName)){
				
				if($success){
					echo "<p id='deleteCard'>$fileName Card has been deleted.</p>";
				}
				else{
					echo "<img src='images/$imageholiday[$i]' width=100 height=100><br>
					<p>Unable to delete card.</p>";
				}
			}
			else{
				echo "<p>Card not found</p>";
			}
			session_destroy();
			?>		
			
			<p><a href="selectCard.php">Go Back</a></p>
		</div>
	</body>
</html>