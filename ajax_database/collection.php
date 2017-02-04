<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "emails";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   
    if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
	$output = json_encode(array('type'=>'error', 'text' => 'Request must come from Ajax'));
	die($output);
	} 

	if (get_magic_quotes_gpc()) {
		$process = array(&$_GET, &$_POST, &$_COOKIE, &$_REQUEST);
		while (list($key, $val) = each($process)) {
			foreach ($val as $k => $v) {
				unset($process[$key][$k]);
				if (is_array($v)) {
					$process[$key][stripslashes($k)] = $v;
					$process[] = &$process[$key][stripslashes($k)];
				} else {
					$process[$key][stripslashes($k)] = stripslashes($v);
				}
			}
		}
		unset($process);
	}
	
	$eAddress = filter_var($_POST["eAddress"], FILTER_SANITIZE_EMAIL);
	
	if(!filter_var($eAddress, FILTER_VALIDATE_EMAIL)){
	$output = json_encode(array('type'=>'error', 'text' => 'Please enter a valid email!'));
	die($output);
	}
    
	function is_valid_email($eAddress){
	if(preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", $eAddress)) {
	return true;
	} else {
	return false;
	}
	}
	
	$eAddress = isset($_POST['eAddress']) ? $_POST['eAddress'] : '';
	$modified = isset($_POST['modified']) ? $_POST['modified'] : '';

    $sql = "INSERT INTO ajax (eAddress,modified) VALUES(:eAddress,CURRENT_TIMESTAMP)";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':eAddress', $eAddress);

    $results = $stmt->execute();

	$confirm = $results;
	
	if($confirm){
	$output = json_encode(array('type'=>'message', 'text' => 'Thank you for subscribing!'));
	die($output);
	}
	
} catch(PDOException $e){
    echo "Error: " . $e->getMessage();
}

    $conn = null;

?>