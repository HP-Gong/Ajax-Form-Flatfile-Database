<?php
  include('include/db.php');
    global $conn;
	$id = isset($_GET['id']) ? $_GET['id'] : '';
	$sql = "DELETE FROM ajax WHERE id = '$id'";
	$stmt = $conn->prepare($sql);
	$stmt->execute();
 
	echo "Email Address Deleted!";
	echo "<br>";
	echo '<tr><td><a href="email_list.php">Return to the list!</a></td></tr>';	

   $conn = null;
?>