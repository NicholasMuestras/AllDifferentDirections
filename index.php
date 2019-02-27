<?php
/**
 * Created by PhpStorm.
 * User: Nicholas Muestras
 * Date: 16.02.2019
 * Time: 21:09
 */
include 'vendor/autoload.php';

$title = 'All Different Directions';

if (!empty($_POST['request']) && preg_match("/^[0-9a-z \s\.\-]+$/", $_POST['request'])) {
    $rawData = $_POST['request'];
    $launcher = new app\models\Launcher($rawData);
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title><?= $title ?></title>
</head>
<body>
<h1><?= $title ?></h1>
<form id="mainForm" name="mainForm" action="index.php" method="post">
    <textarea id="request" name="request" rows="20" placeholder="input data"
              style="width: 48%"><?= $rawData ?? '' ?></textarea>
    <textarea id="response" name="response" rows="20" readonly disabled
              style="width: 48%"><?= isset($launcher) ? $launcher->run() : '' ?></textarea>
    <br>
    <input type="button" id="clear" name="clear" value="Clear">
    <input type="button" id="b1" name="b1" value="Set test data">
    <input type="submit" value="Send">
</form>

<input type="hidden" id="testData" name="testData" value="3
87.342 34.30 start 0 walk 10.0
2.6762 75.2811 start -45.0 walk 40 turn 40.0 walk 60
58.518 93.508 start 270 walk 50 turn 90 walk 40 turn 13 walk 5
2
30 40 start 90 walk 5
40 50 start 180 walk 10 turn 90 walk 5
0">

<script>
    let b1 = document.getElementById('b1');
    let testData = document.getElementById('testData');
    let f1 = document.getElementById('request');
    let clear = document.getElementById('clear');


    b1.onclick = function () {
        f1.value = testData.value;
    };

    clear.onclick = function() {
        f1.value = '';
    }
</script>

</body>
</html>
