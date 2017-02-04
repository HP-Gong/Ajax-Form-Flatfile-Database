<?php
 
$file_name = 'email_lists.php';

$file_read = fopen($file_name, 'r');

$emails = fread($file_read, filesize($file_name));

fclose($file_read);

?>

<html>
<body>
<form action="edits.php" method="POST"> 
Email Address List<br>
<textarea name="edit" cols="30" row="20"><?php echo $emails;?></textarea>
<input type="hidden" name="file_name" value="<?php echo $file_name;?>">
<br>
<input type="submit" value="Save">
</form>
</body>
</html>