<?php

/*
 * First step to establish a connection by creating a database handler object. The variable 'dbh' store the instance of the PDO object which is reponsible for maintaining the database connection.
 * The Exception class is needed for error handling if the connection could not be established. 
 */

try{
	$dbh = new PDO('mysql:host=localhost;dbname=bhatiabh', "bhatiabh", "991411669");
}
catch (Exception $e){
	die('Could not connect to DB: ' . $e->getMessage());
}

?>