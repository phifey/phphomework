<?php
include 'conn.php';

if (isset($_GET['eventID']) && is_numeric($_GET['eventID']))
	{
	$Message = "";
	$id = $_GET['eventID'];
	$filterID = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
	try
		{
		$stmt = $conn->prepare("DELETE FROM wdv341_events WHERE event_id = :id");
		$stmt->bindParam(':id', $filterID, PDO::PARAM_INT);
		$stmt->execute();
		if ($stmt->rowCount() > 0)
			{
			$Message = urlencode("Delete was successful, thank you so much! Row {$filterID} was deleted.");
			header("Location:eventsSelectAll.php?Success={$Message}");
			}
		  else
			{
			$Message = urlencode("Deletion was unsuccessful. We are aware of the problem. We apologize for the inconvenience.");
			header("Location:eventsSelectAll.php?Failure={$Message}");
			}
		}

	catch(PDOException $e)
		{
		echo $e->getMessage();
		}
	}

?>