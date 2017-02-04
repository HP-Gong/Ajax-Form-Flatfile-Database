<?php
if(isset($_POST["eAddress"])){
	
    if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
		$output = json_encode(array('type'=>'error', 'text' => 'Request must come from Ajax'));
        die($output);
    } 
	 
	$email_address = filter_var($_POST["eAddress"], FILTER_SANITIZE_EMAIL);
	
	if(!filter_var($email_address, FILTER_VALIDATE_EMAIL)){
	$output = json_encode(array('type'=>'error', 'text' => 'Please enter a valid email!'));
	die($output);
	}
    
	function is_valid_email($email_address){
	if(preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", $email_address)) {
	return true;
	} else {
	return false;
	}
	}

	$myDoc = "list/email_lists.php";
	$fh = fopen($myDoc, 'a') or die("can't open file");
	$stringData = "$email_address\r\n";
	fwrite($fh, $stringData);
	fclose($fh);
	
	$confirm = $myDoc;
	
	if($confirm){
	$output = json_encode(array('type'=>'message', 'text' => 'Thank you for subscribing!'));
	die($output);
	}
	
	}
?>
