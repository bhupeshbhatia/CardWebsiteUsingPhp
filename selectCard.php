<!DOCTYPE html>
<?php
/*
 * Name: Bhupesh Bhatia
 * Student Number: 991411669 
 */

/*
 * This page will display a list of holidays along with greeting cards found in the database. The list of holidays is displayed in a table with the greeting cards shown right beside them. Both the list of holidays and greeting cards are retrieved from the server.
 */

//Points towards the page where the connection is established using a database handler object. 'Include' statement is a link connecting selectCard.php page with connect.php 
include "connect.php";

// Create arrays to hold the holidayname and Greeting card image fileName
$holidayname = Array();
$imageholiday = Array();

//The SQL commands to get data from the tables in the database. The columns selected is fileName from image table and name from holiday table. 
$command = "SELECT A.fileName, B.name FROM `image` A, `holiday` B WHERE A.holidayId = B.id";
//Preparing the statement from the select command. This binds the SQL query and tells the database what the parameters are.
$stmt = $dbh->prepare($command);

//Executing statement with object dereferencing 
$stmt->execute();

//Fetch and store the holiday names and fileNames in an array using a while loop. Once all the rows have been fetched the loop with stop.
while($row = $stmt->fetch()){
	array_push($imageholiday, $row['fileName']);
	array_push($holidayname, $row['name']);
}
?>

<html>
	<head>
		<!--Links to the css page.  -->
		<title>Selecting a card...</title>
		<link rel="stylesheet" href="css/selectionpage.css">
	</head>
	
	<body>
		<div id="bgWrap">
		<h1>Greeting Cards</h1>
		<hr>
		<h2>Please select a greeting card to personalise: </h2>
		
		<?php
		//Output for holiday name and their respective images in greenting cards
		echo "<table id='tableheader'>
		<tr>
			<th>Holiday</th>
			<th>Card</th>
			<th>Delete Card</th>
			</tr>
			</table>";
			
/*
 * Using a for loop to access the array stored in variables imageholiday and holidayname. The loop runs till count of imageholiday variable runs out. This will display the holiday name along with their images in a table format.
 * 
 */
			
		for ($i=0; $i < count($imageholiday); $i++) { 
			//display cards
			echo"<table id='cardtable'>
			<tr>
			<td id='holidayName'>$holidayname[$i]</td>
			<td><a href='sendCard.php?fileName={$imageholiday[$i]}'><img src='images/$imageholiday[$i]' width=100 height =100 id='greetingcards'></a></td>
			<td><a href='deleteCard.php?fileName={$imageholiday[$i]}'><img src='images/delete.jpg' width=50 height=50></a></td>
			</table>";
		}
		
		?>
		</div>
	</body>
</html>