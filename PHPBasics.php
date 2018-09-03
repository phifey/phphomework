<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>PHP Basics</title>
</head>
<body>
    <?php 
    $yourName = "Nathan";
    $num1 = 55;
    $num2 = 90;
    $total = $num1 + $num2;

    echo "<h1>PHP Basics</h1>";
    echo "<p>" . "Number 1 is: " . $num1 . "</p>";
    echo "<p>" . "Number 2 is: " . $num2 . "</p>";
    echo "<p>" . "The total is: " . $total . "</p>";
    ?>

    <h2> <?php echo $yourName; ?></h2>
</body>
</html>