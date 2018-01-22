<?php
session_start();
include "connect.php";

if (isset($_GET["fileName"])) {
	$cardimage = $_GET["fileName"];
	$_SESSION["fileName"] = $cardimage;

	$selectcommand = "SELECT id, holidayId FROM image WHERE fileName = '$cardimage'";
	$stmt = $dbh -> prepare($selectcommand);
	$success = $stmt -> execute();

	while ($row = $stmt -> fetch()) {
		$_SESSION['imageId'] = $row['id'];
		$_SESSION['holidayId'] = $row['holidayId'];
		// $imageId = $_SESSION['imageId'];
		// $holidayId = $_SESSION['holidayId'];
	}
} else {
	echo "<script>alert('No card selected. Please select a card');window.location='selectCard.php';</script>";
}
?>

<!DOCTYPE html>
<htm>
	<head>
		<title>Insert message in a card</title>
		<link rel="stylesheet" href="css/selectionpage.css">
	</head>
	<body>
		<div id="bgWrap">
			<h1>Please fill out all the fields to send your card:</h1>
			
			<?php
			if (isset($cardimage)) {
				echo "<img src='images/$cardimage' id='imageonmessage'><br>";
			}
			?>
			<div id="wrapForm">
			<form action="previewCard.php" method="get">
				<label>To:
					<input type="text" name="receiver" placeholder="To" autofocus>
				</label>
				<br>
				<label>From:
					<input type="text" name="sender" placeholder="From">
				</label>
				<br>
				<label>Message: 				
					<textarea name="message" placeholder="Message"></textArea>
<br>				</label>
				<input type="submit" value = "Send Card" id='previewButton'>

			</form>
			</div>
		</div>
	</body>
</htm>