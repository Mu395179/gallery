<?php
include_once "db.php";
if (!empty($_POST)) {
$texts = [
    'style' => $_POST['style'],
    'method' => $_POST['method'],
    'purpose' => $_POST['purpose'],
    'size' => $_POST['size'],
];

$tmp = array2sql($texts);
$sql = join(" AND ", $tmp); // 將條件用 AND 連接
$results = search('text', $sql);
// dd($results);

foreach ($results as $result) {
    echo "<div class='upload-img'>";

    echo "<img src='images/{$result['file_name']}'>";
    echo "</div>";
}}else{
    echo "";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="test.php" method="post">
        <label class="form-label mt-2" for="style">直幅/橫幅:</label>
        <select class="form-control " type="text" name="style">
            <?php
            $styles = $pdo->query('select * from style')->fetchAll();
            foreach ($styles as $style) {
                echo "<option value='{$style['id']}'>{$style['style_ch_name']}</option>";
            }
            ?>
        </select>
        <label class="form-label mt-2" for="method">手法:</label>
        <select class="form-control " type="text" name="method">
            <?php
            $methods = $pdo->query('select * from method')->fetchAll();
            foreach ($methods as $method) {
                echo "<option value='{$method['id']}'>{$method['method_ch_name']}</option>";
            }
            ?>
        </select>
        <label class="form-label mt-2" for="purpose">分類:</label>
        <select class="form-control " type="text" name="purpose">
            <?php
            $purposes = $pdo->query('select * from purpose')->fetchAll();
            foreach ($purposes as $purpose) {
                echo "<option value='{$purpose['id']}'>{$purpose['purpose_ch_name']}</option>";
            }
            ?>
        </select>
        <label class="form-label mt-2" for="size">尺寸:</label>
        <select class="form-control " type="text" name="size">
            <?php
            $sizes = $pdo->query('select * from size')->fetchAll();
            foreach ($sizes as $size) {
                echo "<option value='{$size['id']}'>{$size['size_name']}</option>";
            }
            ?>
        </select>
        <input class="mt-5" type="submit" value="上傳">

</body>

</html>