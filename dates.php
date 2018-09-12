<!doctype html>
<head>
</head>
<body>

<?php
function formatDate($input)
{
	return date_format($input,"m/d/Y");
}
function formatIntDate($input)
{
	return date_format($input,"d/m/Y");
}
function processStr($str)
{
	$length = strlen($str);
	$trim = trim($str);
	$lower = strtolower($str);
	$find = stripos($str,"DMACC");
	if($find)
	{
		$string = "DMACC was found!";
	}
	else
	{
		$string = "DMACC wasn't found.";
	}
$specs = array($length,$trim,$lower,$string);
	
	return implode("<br>",$specs);
}
function formatNum($num)
{
	return number_format($num);
}
function currencyFormat($value)
{
	return '$' . number_format($value, 2);
}

$string = " Hello it is DMACL how are you? ";
$date = date_create("2018-09-21");
$num = 123456789;
$num2 = 123456;
echo "<p>" . formatDate($date) . "</p>";
echo "<p>" . formatIntDate($date) . "</p>";
echo "<p>" . processStr($string) . "</p>";
echo "<p>" . formatNum($num) . "</p>";
echo "<p>" . currencyFormat($num2) . "</p>";
?>




</body>
</html>