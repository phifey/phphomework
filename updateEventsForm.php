<?php
session_start();
include 'connectionLocal.php';
$eventName = '';
$eventDescription = '';
$eventPresenter = '';
$eventDate = '';
$eventTime = '';

if(isset($_GET['eventID']) && !empty($_GET['eventID']))
{
	$id = $_GET['eventID'];
	$_SESSION['id'] = $_GET['eventID'];
	try {
		$stmt = $conn->prepare("SELECT * FROM wdv341_event WHERE event_id = $id");
		$stmt->execute();
		$fetch = $stmt->fetch();
	} catch (PDOException $e)
	{
		error_log($e->getMessage());
		print_r(debug_backtrace(true));
	}
}

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['button']))
{
	$id = $_SESSION['id'];
	$eventName = $_POST['event_name'];
	$eventDescription = $_POST['event_description'];
	$eventPresenter = $_POST['event_presenter'];
	$eventDate = $_POST['event_date'];
	$eventTime = $_POST['event_time'];
	
	try {
		$stmt = $conn->prepare("UPDATE wdv341_event SET event_name = :eventName, event_description = :eventDescription, event_presenter = :eventPresenter, event_date = :eventDate, event_time = :eventTime WHERE event_id = :id");
		$stmt->bindParam(':eventName', $eventName, PDO::PARAM_STR);
		$stmt->bindParam(':eventDescription', $eventDescription, PDO::PARAM_STR);
		$stmt->bindParam(':eventPresenter', $eventPresenter, PDO::PARAM_STR);
		$stmt->bindParam(':eventDate', $eventDate, PDO::PARAM_STR);
		$stmt->bindParam(':eventTime', $eventTime, PDO::PARAM_STR);
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
		$stmt->execute();
		$_SESSION['success'] = "Row updated successfully!";
		header("Location: selectEventsUpdate.php");
	} catch (PDOException $e)
	{
		error_log($e->getMessage());
		print_r(debug_backtrace(true));
	}
}
?>
<!doctype html>
<head>
<title></title>
</head>
<body>
<form name="event_form" id="eventForm" action="updateEventsForm.php" method="post">
	<div>
		<p>
		<label for="eventName">Event Name</label>
			<input type="text" name="event_name" id="eventName" value="<?php if(isset($fetch)) echo $fetch["event_name"]; ?>"/>
		<label for="eventDescription">Event Description</label>
			<input type="text" name="event_description" id="eventDescription" value="<?php if(isset($fetch)) echo $fetch["event_description"]; ?>"/>
		<label for="eventPresenter">Event Presenter</label>
			<input type="text" name="event_presenter" id="eventPresenter" value="<?php if(isset($fetch)) echo $fetch["event_presenter"]; ?>"/>
		<label for="eventDate">Event Date</label>
			<input type="date" name="event_date" id="eventDate" value="<?php if(isset($fetch)) echo $fetch["event_date"]; ?>"/>
		<label for="eventTime">Event Time</label>
			<input type="time" name="event_time" id="eventTime" value="<?php if(isset($fetch)) echo $fetch["event_time"]; ?>"/>
		</p>
		<button type="submit" name="button" id="button" value="submit">Submit</button>
	</div>
</form>
</body>
</html>