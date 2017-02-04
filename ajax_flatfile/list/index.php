<?php
$full_path = "./";
 
$dir = opendir($full_path) or die ("unable to open directory");

while($file = readdir($dir)){
	
	if($file == "." || $file == "index.php" || $file == "email_lists.php" || $file == "email.php" || $file == "edits.php")
	
	continue;
	
	echo "<tr><td><a style='text-decoration:none; color: #000000;' href='email.php'>View Email Lists</a></td></tr>";

	}

closedir($dir)
?>