<?php
include('include/db.php');

global $conn; 
$sql = "SELECT * FROM ajax";
if ($stmt = $conn->query($sql)) {
	echo "<table style='width:400px;text-align:center;'><tr><th>Email Address</th><th>Date</th></tr>";
        foreach ($conn->query($sql) as $row) {
        echo "<tr><td>" . $row['eAddress'] . "</td><td>" . $row['modified'] . "</td><td><a href=\"delete.php?id=" . $row['id'] . "\">Delete</a></td></tr>";
         }
	echo "</table>";
    }
  else {
      echo "<tr><td>No Email Address not found!</td></tr>";
    }

$stmt = null;
$conn = null;
?>

<style>table, th, td {border: 1px solid black;border-collapse: collapse;} tr{'width:200px;}</style>
