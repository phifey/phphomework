<?php

	require 'connection.php';
	
	$event_name = $_POST[event_name];
	$event_description = $_POST[event_description];
	$event_presenter = $_POST[event_presenter];
	$event_date = $_POST[event_date];
	$event_time = $_POST[event_time];
	
	try {
	$sql = "INSERT INTO wdv341_events (event_name, event_description, event_presenter, event_date, event_time) VALUES (:eventName,:eventDescription, :eventPresenter, :eventDate, :eventTime)";
	$stmt = $conn->prepare($sql);
	$stmt->bindParam(':eventName',$event_name);
	$stmt->bindParam(':eventDescription',$event_description);
	$stmt->bindParam(':eventPresenter',$event_presenter;
	$stmt->bindParam(':eventDate',$event_date);
	$stmt->bindParam(':eventTime',$event_time);
	$stmt->execute();
		echo ", Database is updated with your submission, thank you";
	}
	catch(PDOException $e)
	{
		echo $e->getMessage();
	}


?>
<!doctype html>
<head>
</head>
<body>
</body>
</html>