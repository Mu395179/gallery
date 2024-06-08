<?php
include_once "db.php";
// 1.建立表單
// 2.建立處理檔案程式
// 3.搬移檔案
// 4.顯示檔案列表

// 檢查檔案是否有上傳成功
if (!empty($_FILES)) {
    echo "檔案名稱" . $_FILES['file']['name'] . "<br>";
    echo "檔案類型" . $_FILES['file']['type'] . "<br>";
    echo "檔案大小" . $_FILES['file']['size'] . "<br>";

    // 檢查文字資料是否有上傳成功
    if (!empty($_POST['name']) && !empty($_POST['description'])) {
        echo "作品名稱：" . $_POST['name'] . "<br>";
        echo "描述：" . $_POST['description'] . "<br>";
    } else {
        echo "作品名稱和描述不能為空。<br>";
        exit;
    }
    // 提取副檔名
    $fileExtension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
    // 新檔名=當下年月日時分秒.副檔名
    $newFileName = $date->format('Y' . 'm' . 'd' . 'H' . 'i' . 's') . '.' . $fileExtension;
    if (move_uploaded_file($_FILES['file']['tmp_name'], "images/" . $newFileName)) {
        // 陣列name 為新檔名
        $data = [
            'name' => $newFileName,
            'type' => $_FILES['file']['type'],
            'size' => $_FILES['file']['size'],
        ];
        save("images", $data);
        $text = [
            'original_name' => $_POST['name'],
            'description' => $_POST['description'],
        ];
        save("text", $text);


        echo "檔案上傳成功，新檔名為：" . $newFileName;
    } else {
        echo "檔案上傳失敗";
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>檔案上傳</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1 class="header">檔案上傳</h1>

    <form action="upload.php" method="post" enctype="multipart/form-data">
        <input type="file" name="file">
        <label for="name">作品名稱:</label>
        <input type="text" name="name">
        <label for="information">描述:</label>
        <textarea type="text" name="description" rows="10" cols="100"></textarea>
        <input type="submit" value="上傳">

    </form>
    <!-- 建立一個連結來查看上傳後的圖檔 -->
    <?php

    $images = all('images');

    foreach ($images as $image) {
        echo "<div class='upload-img'>";
        echo "<a class='pen' href='edit_image.php?id={$image['id']}'>";
        echo "<img src='./pen.png' style='width:15px;height:15px;'>";
        echo "</a>";
        echo "<a class='del' href='del_image.php?id={$image['id']}'>X</a>";
        echo "<img src='images/{$image['name']}'>";
        echo "</div>";
    }

    ?>




</body>

</html>