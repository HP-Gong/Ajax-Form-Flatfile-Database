<?php
 
$edit = $_POST['edit'];

$file_name = $_POST['file_name'];

$file = fopen($file_name, 'w');

fwrite($file,$edit);

fclose($file);

echo "The file is Saved! <br><br><a href='../index.php'>Click here to form</a>";

?>