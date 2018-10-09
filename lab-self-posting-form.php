<?php
$name_errMsg = "";
$email_errMsg = "";
$validForm = false;
$captcha_Msg = "";
$message = "";

if(isset($_POST['my_submit']))
{
	$lab_name = $_POST['lab_name'];
	$lab_email = $_POST['lab_email'];
	// require conn file
	try {

		//BEGIN FORM VALIDATION
		$validForm = true;		
	
		//validate name - Cannot be empty
		if( empty($lab_name)) {
			$name_errMsg = "Please enter a name";
			$validForm = false;
		}

		//validate email using PHP filter
		if( !filter_var($lab_email, FILTER_VALIDATE_EMAIL)) {
			$email_errMsg = "Invalid email";
			$validForm = false;	
		}
		
	    $url = 'https://google.com/recaptcha/api/siteverify';
		$privatekey = "6Lcji3MUAAAAAM4NxK9chODJ1ZVXsUu1PAcqQHy5";

		$response = file_get_contents($url . "?secret=" . $privatekey . "&response=" . $_POST['g-recaptcha-response'] . "&remoteip=" . $_SERVER['REMOTE_ADDR']);
		$data = json_decode($response);

		if (isset($data->success) AND $data->success == true) {
			$captcha_Msg = "Successful";
		} else {
			$captcha_Msg = "ReCAPTCHA was unsuccessful";
			$validForm = false;
		}
		
		if($validForm)
		{
			$message = "Thank you! Your information has been sent. We will get back to you shortly";
			//Insert
			//Prepared Statement
			//Binding Parameters
			//Execution
		}
		else 
		{
			$message = "One or more things were not successfully filled out! ReCAPTCHA is required.";
		}
	}
	catch(Exception $e)
	{
		echo "Exception: ", $e->getMessage(), "\n";
	}
}
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>WDV341 Intro PHP</title>
<style>

#protection, #my_protection {
	display: none;
}

</style>
<script src='https://www.google.com/recaptcha/api.js'></script>
</head>

<body>
<h1>WDV341 Intro PHP</h1>
<h2>Unit-7 and Unit-8 Form Validations and Self Posting Forms.</h2>
<h3>In Class Lab - Self Posting Form</h3>
<p><strong>Instructions:</strong></p>
<ol>
  <li>Modify this page as needed to convert it into a PHP self posting form.</li>
  <li>Use the validations provided on the page for the server side validation. You do NOT need to code any validations.</li>
  <li>Modify the page as needed to display any input errors.</li>
  <li>Include some form of form protection.</li>
  <li>You do NOT need to do any database work with this form. </li>
</ol>
<p>When complete:</p>
<ol>
  <li>Post a copy on your host account.</li>
  <li>Push a copy to your repo.</li>
  <li>Submit the assignment on Blackboard. Include a link to your page and to your repo.</li>
</ol>
<form name="form1" method="post" action="lab-self-posting-form.php">
	<?php if($validForm) { ?>
	<span id="success"> <?php echo $message ?></span>
	<?php } else { ?>
	<span id="failure"> <?php echo $message ?></span>
  <p>
    <label for="lab_name">Name:</label>
    <input type="text" name="lab_name" id="lab_name" value="<?php echo $name_errMsg ?>">
  </p>
  <p>
    <label for="lab_email">Email:</label>
    <input type="text" name="lab_email" id="lab_email" value="<?php echo $email_errMsg ?>">
  </p>
    <p id="protection">
    <label for="my_protection"></label>
    <input type="text" name="my_protection" id="my_protection">
	</p>
	<div class="g-recaptcha" data-sitekey="6Lcji3MUAAAAAERAECuLLgERaWajd1FqJCKLGqvz"></div>
	<span id="recaptcha_failure"> <?php echo $captcha_Msg ?></span>
  <p>
    <input type="submit" name="my_submit" id="my_submit" value="Submit">
  </p>
	<?php } ?>
</form>
<p>&nbsp;</p>
</body>
</html>
