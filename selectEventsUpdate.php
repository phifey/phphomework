<?php
	session_start();
	include 'connectionLocal.php';
	try {
		$stmt = $conn->prepare("SELECT * FROM wdv341_event");
		$stmt->execute();
	} catch(PDOException $e)
	{
		error_log($e->getMessage());
		print_r(debug_backtrace(true));
	}
?>
<table border='1'>
	<tr>
		<td>ID</td>
		<td>Name</td>
		<td>Description</td>
		<td>Presenter</td>
		<td>UPDATE</td>
<?php 
try {
	while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
	{
		echo "<tr>";
			echo "<td>" . $row['event_id'] . "</td>";
			echo "<td>" . $row['event_name'] . "</td>";	
			echo "<td>" . $row['event_description'] . "</td>";
			echo "<td>" . $row['event_presenter'] . "</td>";
			echo "<td><a href='updateEventsForm.php?eventID=" . $row['event_id'] . "'>Update</a></td>"; 	
		echo "</tr>";
	}
}
catch(PDOException $e)
{
	echo $e->getMessage();
}
?>
</table>
<?php
if(isset($_SESSION['success']))
{
	echo $_SESSION['success'];
}
?>