<?php
	if(isset($_GET['Success']))
	{
		echo $_GET['Success'];
	}
	if(isset($_GET['Failure']))
	{
		echo $_GET['Failure'];
	}
	
	include 'conn.php';			//connects to the database

	$stmt = $conn->prepare("SELECT event_id,event_name,event_description,event_presenter FROM wdv341_events");
	$stmt->execute();
?>
<table border='1'>
	<tr>
		<td>ID</td>
		<td>Name</td>
		<td>Description</td>
		<td>Presenter</td>
		<td>UPDATE</td>
		<td>DELETE</td>
<?php 
try {
	while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
	{
		echo "<tr>";
			echo "<td>" . $row['event_id'] . "</td>";
			echo "<td>" . $row['event_name'] . "</td>";	
			echo "<td>" . $row['event_description'] . "</td>";
			echo "<td>" . $row['event_presenter'] . "</td>";
			echo "<td><a href='updateEvent.php?eventID=" . $row['event_id'] . "'>Update</a></td>"; 
			echo "<td><a href='deleteEvent.php?eventID=" . $row['event_id'] . "'>Delete</a></td>"; 		
		echo "</tr>";
	}
}
catch(PDOException $e)
{
	echo $e->getMessage();
}
?>
</table>