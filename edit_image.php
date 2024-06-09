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
            'method' => $_POST['method'],
            'purpose' => $_POST['purpose'],
            'size' => $_POST['size'],
        ];
        save("text", $image);
        header("location:upload.php");
    } else {
        echo "檔案上傳失敗";
    }
}
?>
<h1 class="header">編輯檔案上傳</h1>
<div class="container d-flex justify-content-center">
    <div class="row">
        <div class="col-6">
            <form action="edit_image.php?id=<?= $_GET['id']; ?>" method="post" enctype="multipart/form-data">
                <label class="form-label mt-2" for="name">上傳檔案:</label>
                <input class="form-control " type="file" name="file">
                <label class="form-label mt-2" for="name">作品名稱:</label>
                <input class="form-control " type="text" name="name">
                <label class="form-label mt-2" for="description">描述:</label>
                <textarea class="form-control " type="text" name="description" rows="5" cols="100"></textarea>
                <label class="form-label mt-2" for="style">直幅/橫幅:</label>
                <select class="form-control " type="text" name="style">
                    <?php
                    $styles = $pdo->query('select * from style')->fetchAll();
                    foreach ($styles as $style) {
                        echo "<option value='{$style['id']}'>{$style['ch_name']}</option>";
                    }
                    ?>
                </select>
                <label class="form-label mt-2" for="method">手法:</label>
                <select class="form-control " type="text" name="method">
                    <?php
                    $methods = $pdo->query('select * from method')->fetchAll();
                    foreach ($methods as $method) {
                        echo "<option value='{$method['id']}'>{$method['ch_name']}</option>";
                    }
                    ?>
                </select>
                <label class="form-label mt-2" for="purpose">分類:</label>
                <select class="form-control " type="text" name="purpose">
                    <?php
                    $purposes = $pdo->query('select * from purpose')->fetchAll();
                    foreach ($purposes as $purpose) {
                        echo "<option value='{$purpose['id']}'>{$purpose['ch_name']}</option>";
                    }
                    ?>
                </select>
                <label class="form-label mt-2" for="size">尺寸:</label>
                <select class="form-control " type="text" name="size">
                    <?php
                    $sizes = $pdo->query('select * from size')->fetchAll();
                    foreach ($sizes as $size) {
                        echo "<option value='{$msize['id']}'>{$size['name']}</option>";
                    }
                    ?>
                </select>
                <input class="mt-5" type="submit" value="上傳">

            </form>
        </div>
    </div>
</div>

<?php
$images = all('text');

foreach ($images as $image) {
    ?>
    <div class="col-6">

        <div class="card" style="width:400px">
            <img class="card-img-top" <?= "src='images/{$image['file_name']}'" ?> alt="Card image" style="width:100%">
            <div class="card-body">
                <h4 class="card-title"><?= "{$image['original_name']}" ?></h4>
                <p class="card-text"><?= "{$image['method']}" ?></p>
                <p class="card-text"><?= "{$image['purpose']}" ?></p>
                <p class="card-text"><?= "{$image['size']}" ?></p>
                <p class="card-text"><?= "{$image['description']}" ?></p>
                <a href="#" class="btn btn-primary">See Profile</a>
            </div>
        </div>
    </div>
<?php } ?>