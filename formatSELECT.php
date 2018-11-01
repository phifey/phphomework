<?php
	
	include 'conn.php';

	$stmt = $conn->prepare("SELECT event_id,event_name,event_description,event_presenter,event_date FROM wdv341_event ORDER BY event_date DESC");
	$stmt->execute();
?>
<!doctype html>
<head>
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.bundle.min.js" integrity="sha384-pjaaA8dDz/5BgdFUPX6M/9SUZv4d12SUPF0axWc+VRZkx5xU3daN+lYb49+Ax+Tl" crossorigin="anonymous"></script>
<link rel="stylesheet" type="text/css" href="events.css"/>
</head>
<body>

		<nav class="navbar navbar-light bg-light">
			<a class="navbar-brand" href="#">
				Navbar - Format Select Assignment
			</a>
		</nav>
		
		<div class="container-fluid">
			<div class="row">
				<div class="col-12 my-2">
					<header>
						Header
					</header>
				</div>
			</div>
			
			<div class="row">
			
			<div class="col-4">
			<aside>
			<?php 
			
			try {
	date_default_timezone_set('America/Chicago');
	$cur_month = date('m');
	$cur_day = date('d');
	$cur_year = date('Y');
	while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
	{
		$isCur = "";
		$isLater = "";
		$sql_date = $row['event_date'];
		$date = date_create($sql_date);
		$formatted_sql_date = date_format($date,"m/d/Y");
		$split = preg_split("/[-]/", $sql_date);
		
		if($split[1] == $cur_month)
		{
			$isCur = "current";
			if($split[2] > $cur_day)
			{
				$isLater = "later";
			}
		}
		else if ($split[1] > $cur_month || $split[0] > $cur_year)
		{
			$isLater = "later";
		}
		
		echo "<article class='my-2'>";
			echo "<div class='name-div" . " " . $isCur . " " . $isLater . "'>" . "<h1>" . $row['event_name'] . "</h1>" . "</div>";
			echo "<div class='date-div" . " " . $isCur . " " . $isLater . "'>" . "<p class='date'>" .  $formatted_sql_date . "</p>" . "</div>";	
			echo "<div class='desc-div" . " " . $isCur . " " . $isLater . "'>" . "<p>" .  $row['event_description'] . "</p>" . "</div>";
			echo "<div class='presenter-div" . " " . $isCur . " " . $isLater . "'>" . "<p>" . $row['event_presenter'] . "</p>" . "</div>";	
		echo "</article>";
	}
}
catch(PDOException $e)
{
	echo $e->getMessage();
}
			
			?>
				</aside>
			</div>
			
			<div class="col-8 my-2">
				<main>
					Main
				</main>
			</div>
			
		</div>
		
		<div class="row">
			<div class="col-12 my-2">
				<footer>
					Footer
				</footer>
			</div>
		</div>
	</div>
</body>
</html>