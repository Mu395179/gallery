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
    if (!empty($_POST)) {
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
            'file_name' => $newFileName,
            'type' => $_FILES['file']['type'],
            'size' => $_FILES['file']['size'],
        ];
        save("images", $data);
        $text = [
            'file_name' => $newFileName,
            'original_name' => $_POST['name'],
            'description' => $_POST['description'],
            'style' => $_POST['style'],
            'method' => $_POST['method'],
            'purpose' => $_POST['purpose'],
            'size' => $_POST['size'],
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        form {
            background-color: lightgray;
            border: 1px black solid;
            padding-left: 30px;
            padding-right: 30px;
            padding-bottom: 20px;
        }

        .form-control {
            border: 1px solid black;

        }

        .carousel-control-prev {
            background-color: gray;
            width: 30px;
        }

        .carousel-control-next {
            background-color: gray;
            width: 30px;
        }
    </style>
</head>

<body>
    <h1 class="header">檔案上傳</h1>
    <div class="container ">
        <div class="row">
            <div class="col-6">
                <form action="upload.php" method="post" enctype="multipart/form-data">
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

                </form>
            </div>

            <!-- 建立一個連結來查看上傳後的圖檔 -->
            <?php
            $images = show('text');
            ?>
            <div class="col-6 mt-5">
                <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <?php foreach ($images as $index => $image) { ?>
                            <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">

                                <div class="card m-auto mt-3" style="width:400px">
                                    <img class="card-img-top" <?= "src='images/{$image['file_name']}'" ?> alt="Card image"
                                        style="width:100%">
                                    <div class="card-body">
                                        <h4 class="card-title"><?= "{$image['original_name']}" ?></h4>
                                        <p class="card-text"><?= "{$image['purpose_ch_name']}" ?></p>
                                        <p class="card-text"><?= "{$image['style_ch_name']}" ?></p>
                                        <p class="card-text"><?= "{$image['size_name']}" ?></p>
                                        <p class="card-text"><?= "{$image['method_ch_name']}" ?></p>
                                        <p class="card-text"><?= "{$image['description']}" ?></p>
                                        <!-- <a href="#" class="btn btn-primary">See Profile</a> -->
                                    </div>
                                    <div class="row">
                                        <div class="col-3"></div>
                                        <div class="col-4">
                                            <a <?= "href='edit_image.php?id={$image['id']}'" ?>
                                                class="btn btn-primary">編輯</a>
                                        </div>
                                        <div class="col-4">
                                            <a <?= "href='del_image.php?id={$image['id']}'" ?> class="btn btn-primary">刪除</a>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        <?php } ?>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>

        <!-- <h1>直幅</h1>
        <?php
        $images = all('text', "WHERE style = 1");
        foreach ($images as $image) {
            echo "<div class='upload-img'>";
            echo "<a class='pen' href='edit_image.php?id={$image['id']}'>";
            echo "<img src='./pen.png' style='width:15px;height:15px;'>";
            echo "</a>";
            echo "<a class='del' href='del_image.php?id={$image['id']}'>X</a>";
            echo "<img src='images/{$image['file_name']}'>";
            echo "</div>";
        }
        ?>
        <h1>橫幅</h1>
        <?php
        $images2 = all('text', "WHERE style = 2");
        foreach ($images2 as $image2) {
            echo "<div class='upload-img'>";
            echo "<a class='pen' href='edit_image.php?id={$image2['id']}'>";
            echo "<img src='./pen.png' style='width:15px;height:15px;'>";
            echo "</a>";
            echo "<a class='del' href='del_image.php?id={$image2['id']}'>X</a>";
            echo "<img src='images/{$image2['file_name']}'>";
            echo "</div>";
        }

        ?> -->




</body>

</html>