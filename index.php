<?php

$str = '
<tr>
    <th>氏名</th>
    <th>船名</th>
    <th>漁場</th>
    <th>品名</th>
    <th>規格</th>
    <th>重量(kg)</th>
    <th>単価</th>
    <th>金額</th>
</tr>
';

// ファイルを開く（読み取り専用）
$file = 'data/fish_sale.csv';
// echo $file;


if (file_exists($file)) {
    // ファイルをロック
    $file = fopen($file, 'r');
    flock($file, LOCK_EX);

    // fgets()で1行ずつ取得→$lineに格納
    if ($file) {
        while ($line = fgetcsv($file)) {
            // 取得したデータを`$str`に追加する
            $str .= "
                <tr>
                    <td>$line[0]</td>
                    <td>$line[1]</td>
                    <td>$line[2]</td>
                    <td>$line[3]</td>
                    <td>$line[4]</td>
                    <td>$line[5]</td>
                    <td>￥$line[6]</td>
                    <td>￥$line[7]</td>
                </tr>
            ";
            // echo '<pre>';
            // var_dump($line);
            // echo '</pre>';
        }
    }

    // ロックを解除する
    flock($file, LOCK_UN);
    // ファイルを閉じる
    fclose($file);
};


?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Zen+Kurenaido&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/style.css">
    <title>Document</title>
</head>

<body>
    <h1>水揚げ情報管理サイト</h1>

    <div class="form-area">
        <form class="input-form" action="create.php" method="POST">
            <h2>ーー入力画面ーー</h2>
            <div class="input-area">
                <label for="name">氏名</label>
                <input type="text" id="name" name="name">

                <label for="ship_name">船名</label>
                <input type="text" id="ship_name" name="ship_name">

                <label for="ground">漁場</label>
                <input type="text" id="ground" name="ground">

                <label for="fishName">品名</label>
                <input type="text" id="fishName" name="fishName">

                <label for="standard">規格</label>
                <select name="standard" id="standard">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                </select>

                <label for="weight">重量</label>
                <input type="number" id="weight" name="weight">

                <label for="unit_price">単価</label>
                <input type="number" id="unit_price" name="unit_price">
            </div>

            <button>登録</button>
        </form>
    </div>

    <div class="output-area">
        <table>
            <?= $str ?>
        </table>
    </div>

    <script src="./js/main.js"></script>
</body>

</html>