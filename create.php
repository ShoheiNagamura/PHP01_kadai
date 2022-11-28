<?php

date_default_timezone_set('Asia/Tokyo');
$objDateTime = new DateTime();
$date = $objDateTime->format('Y-m-d');


// echo '<pre>';
var_dump($_POST);
// echo '</pre>';
// exit();

$name = $_POST['name'];
$ship_name = $_POST['ship_name'];
$ground = $_POST['ground'];
$fishName = $_POST['fishName'];
$standard = $_POST['standard'];
$weight = $_POST['weight'];
$unit_price = $_POST['unit_price'];
$price = $weight * $unit_price;

//csv用に配列に格納
$datalist = [
    $name, $ship_name, $ground, $fishName, $standard, $weight, $unit_price, $price
];

//txtファイル用
// $wite_data = "\n {$ground} {$fishName} {$standard} {$weight} {$unit_price} {$price} {$date}";

$file = fopen('data/fish_sale.csv', 'a');

flock($file, LOCK_EX);

fputcsv($file, $datalist);

flock($file, LOCK_UN);

fclose($file);

header('Location:index.php');
