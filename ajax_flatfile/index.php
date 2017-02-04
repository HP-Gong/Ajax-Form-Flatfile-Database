<!DOCTYPE html>
<html prefix="og: http://ogp.me/ns#" lang="en-US">
<head> 
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Ajax Email Address</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
<script src="js/jquery-3.1.1.min.js"></script>
</head>
<body>
<script type="text/javascript">
$(document).ready(function() {
$("#e").hide();
$("#btn_blue").click(function() { 

var email_address = $('input[class=email]').val();
var proceed = true;

if(email_address==""){ 
$('input[class=email]').css('border-color','red');
$("#e").toggle();
proceed = false;
}

var email_reg = /^[a-z0-9]+([-._][a-z0-9]+)*@([a-z0-9]+(-[a-z0-9]+)*\.)+[a-z]{2,4}$/;
if($(this).attr("type")=="email" && !email_reg.test($.trim($(this).val()))){
$('input[class=email]').css('border-color','red');
proceed = false;           
}  

if(proceed) {
post_data = {'eAddress':email_address};
$.post('collection.php', post_data, function(response){  
     
if(response.type == 'error'){
output = '<br><div class="error">'+response.text+'</div>';
}else{
output = '<br><div class="success">'+response.text+'</div>';
$("#email_form")[0].reset();
}
$("#result").hide().html(output).slideDown();
}, 'json');
}
});

$("#email_form input").keyup(function() { 
$("#email_form input").css('border-color','blue'); 
$("#result").slideUp();
});

});
</script>

<div class="container">	
<div class="wrapper">
<h2 class="title">Keep Me Updated</h2>
<div class="email-wrapper">
<div id="message">Sign up and receive all the latest updates straight to your inbox!<br>Email:</div>
<div class="form-wrapper">
<form id="email_form"> 
<fieldset>
<input type="email" id="email" name="email" class="email" placeholder="Enter Your Email">
</fieldset>
</form>
</div>
<input type="submit" id="btn_blue" class="btn_blue" value="Subscribe">
<div id="result"></div>
<p><div id="e">Input fields are empty!</div></p>
</div>
</div>
<p><a href="list/index.php" target="_blank">Results</a> </p>	
</div>

</body>
</html>
