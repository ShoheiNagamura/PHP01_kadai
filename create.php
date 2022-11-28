<?php

// 現在時刻を取得し、$objDateTime()で整形
date_default_timezone_set('Asia/Tokyo');
$objDateTime = new DateTime();
$date = $objDateTime->format('Y-m-d');


// echo '<pre>';
// var_dump($_POST);
// echo '</pre>';
// exit();

// 入力した値を変数に格納
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

// csvファイルが生成されファイルを開き変数に格納
$file = fopen('data/fish_sale.csv', 'a');

// 開いたファイルをロック
flock($file, LOCK_EX);

// csvファイルに配列を書き込み
fputcsv($file, $datalist);

//ファイルのロックを解除
flock($file, LOCK_UN);

//ファイルを閉じる
fclose($file);

// 画面遷移
header('Location:index.php');
