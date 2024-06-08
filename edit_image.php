<?php
include_once "db.php";
$image = find('images', $_GET['id']);

if (!empty($_FILES)) {
    echo "檔案名稱" . $_FILES['file']['name'] . "<br>";
    echo "檔案類型" . $_FILES['file']['type'] . "<br>";
    echo "檔案大小" . $_FILES['file']['size'] . "<br>";

    // 檢查文字資料是否有上傳成功
    if (!empty($_POST)) {
        echo "作品名稱：" . $_POST['name'] . "<br>";
        echo "描述：" . $_POST['description'] . "<br>";
    } else {
        echo "作品名稱和描述不能為空。<br>";
        exit;
    }
    unlink("images/" . $image['file_name']);
    del('images', $_GET['id']);
    del('text', $_GET['id']);
    $fileExtension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
    // 新檔名=當下年月日時分秒.副檔名
    $newFileName = $date->format('Y' . 'm' . 'd' . 'H' . 'i' . 's') . '.' . $fileExtension;
    if (move_uploaded_file($_FILES['file']['tmp_name'], "images/" . $newFileName)) {
        // 陣列name 為新檔名
        $image = [
            'file_name' => $newFileName,
            'type' => $_FILES['file']['type'],
            'size' => $_FILES['file']['size'],
        ];
        save("images", $image);

        $image = [
            'file_name' => $newFileName,
            'original_name' => $_POST['name'],
            'description' => $_POST['description'],
            'style' => $_POST['style'],
        ];
        save("text", $image);
        header("location:upload.php");
    } else {
        echo "檔案上傳失敗";
    }
}
?>

<form action="edit_image.php?id=<?= $_GET['id']; ?>" method="post" enctype="multipart/form-data">
    <input type="file" name="file">
    <label for="name">作品名稱:</label>
    <input type="text" name="name">
    <label for="description">描述:</label>
    <textarea type="text" name="description" rows="10" cols="100"></textarea>
    <label for="style">直幅/橫幅</label>
    <select type="text" name="style">
        <?php
        $styles = $pdo->query('select * from style')->fetchAll();
        foreach ($styles as $style) {
            echo "<option value='{$style['id']}'>{$style['ch_name']}</option>";
        }
        ?>

    </select>
    <input type="submit" value="上傳">

</form>

<?php
echo "<img src='images/{$image['file_name']}'>";
?>