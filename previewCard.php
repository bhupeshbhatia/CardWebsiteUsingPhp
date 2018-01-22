<?php
session_start();
include "connect.php";

if (isset($_GET['receiver']) && (isset($_GET['sender'])) && $_GET['message']) {

	$fileName = $_SESSION['fileName'];
	$imageId = $_SESSION['imageId'];
	$holidayId = $_SESSION['holidayId'];
	$receiver = $_GET['receiver'];
	$sender = $_GET['sender'];
	$message = $_GET['message'];

	$data = array($holidayId, $imageId, $receiver, $sender, $message);

	$insertcommand = "INSERT INTO card (holidayId, imageId, toPerson, fromPerson, message)
	VALUES(?, ?, ?, ?, ?)";

	$stmt = $dbh -> prepare($insertcommand);

	$success = $stmt -> execute($data);
} else {
	echo "<script>alert('All required fields not found! Please start over...');window.location='selectCard.php';</script>";
}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Preview of Card</title>
		<link rel="stylesheet" href="css/selectionpage.css">
	</head>
	<body>
		<div id="bgWrap">
			<h1>Your card</h1>
			<?php
			if (isset($success)) {
				echo "<img src='images/$fileName' id='previewImage'>"; 
				echo "<p class='previewText'>To: $receiver</p>";
				echo "<p class='previewText'>From: $sender</p>";
				echo "<p id='previewMessage'>Dear $receiver,<br> <br> $message</p>";
			} else {
				echo "<script>alert('Unable to enter values into the database. Please try again');window.location='selectCard.php';</script>";
			}
			session_destroy();
			?>
		</div>
	</body>
</html>