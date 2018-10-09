<!DOCTYPE html>
<?php include 'emailerClass.php';?>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title></title>
</head>
<body>

	<h1>PHP Emailer Class</h1>

	<?php
	$emailer = new Mailer("nathan@n8te.org","okrekt@gmail.com","Nothing","How are you doing");
	$emailer->emailPerson();
	?>

</body>
</html>