<?php
include_once "db.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>index</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            height: 100vh;
            background-color: lightyellow;
        }

        .nav-link {
            color: white;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <ul class="nav bg-dark">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">線上畫廊</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">關於</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">贊助</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">聯絡我們</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">

                        <img src="https://picsum.photos/1000/300/?random=10" class="d-block w-100">
                    </div>
                    <div class="carousel-item">
                        <img src="https://picsum.photos/1000/300/?random=11" class="d-block w-100">
                    </div>
                    <div class="carousel-item">
                        <img src="https://picsum.photos/1000/300/?random=12" class="d-block w-100">
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-4 mt-5">
                <a href="upload.php" class="btn btn-primary">上傳</a>
            </div>
            <div class="col-4 mt-5">
                <a href="test.php" class="btn btn-primary">test</a>
            </div>
        </div>

        <div class="row">
            <form action="index.php" method="post">
                <label class="form-label mt-2" for="style">直幅/橫幅:</label>
                <select class="form-control " type="text" name="style">
                    <?php
                    echo "<option value=''></option>";
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
                    echo "<option value=''></option>";
                    foreach ($methods as $method) {
                        echo "<option value='{$method['id']}'>{$method['method_ch_name']}</option>";
                    }
                    ?>
                </select>
                <label class="form-label mt-2" for="purpose">分類:</label>
                <select class="form-control " type="text" name="purpose">
                    <?php
                    $purposes = $pdo->query('select * from purpose')->fetchAll();
                    echo "<option value=''></option>";
                    foreach ($purposes as $purpose) {
                        echo "<option value='{$purpose['id']}'>{$purpose['purpose_ch_name']}</option>";
                    }
                    ?>
                </select>
                <label class="form-label mt-2" for="size">尺寸:</label>
                <select class="form-control " type="text" name="size">
                    <?php
                    $sizes = $pdo->query('select * from size')->fetchAll();
                    echo "<option value=''></option>";
                    foreach ($sizes as $size) {
                        echo "<option value='{$size['id']}'>{$size['size_name']}</option>";
                    }
                    ?>
                </select>
                <input class="btn btn-primary" type="submit" value="搜尋">
                <?php
                if (!empty($_POST)) {
                    dd($_POST);
                    $texts = [];
                    if (!empty($_POST['style'])) {
                        $texts['style'] = $_POST['style'];
                    }
                    if (!empty($_POST['method'])) {
                        $texts['method'] = $_POST['method'];
                    }
                    if (!empty($_POST['purpose'])) {
                        $texts['purpose'] = $_POST['purpose'];
                    }
                    if (!empty($_POST['size'])) {
                        $texts['size'] = $_POST['size'];
                    }

                    if (!empty($texts)) {
                        $tmp = array2sql($texts);
                        $sql = join(" AND ", $tmp); // 將條件用 AND 連接
                        $results = search('text', $sql);
                        ?>
                        <div class="row mt-5">
                            <p class="h1">搜尋結果</p>
                            <?php
                            foreach ($results as $result) {
                                echo "<div class='text-center col-2'>";
                                echo "<a href='show.php?id={$result['id']}'>";
                                echo "<img src='images/{$result['file_name']}' class='card-img-top border border-dark border-5 rounded-0 shadow p-0 mb-5 bg-body rounded'>";
                                echo "</a>";
                                echo "</div>";
                            }
                            ?>
                        </div>
                        <?php
                    } else {
                        echo "<p class='text-danger'>請至少選擇一個篩選條件。</p>";
                    }
                }
                ?>
        </div>


        <div class="row mt-5">
            <p class="h1">風景</p>
            <?php
            $images = all('text', "WHERE purpose = 1");
            foreach ($images as $image) {

                echo "<div class='text-center col-2'>";
                echo "<a href='show.php?id={$image['id']}'>";
                echo "<img src='images/{$image['file_name']}' class='card-img-top border border-dark border-5 rounded-0 shadow p-0 mb-5 bg-body rounded'>";
                echo "</a>";
                echo "</div>";
            } ?>
        </div>
        <div class="row mt-5">
            <p class="h1">靜物</p>
            <?php
            $images = all('text', "WHERE purpose = 2");
            foreach ($images as $image) {
                echo "<div class='text-center col-2'>";
                echo "<a href='show.php?id={$image['id']}'>";
                echo "<img src='images/{$image['file_name']}' class='card-img-top border border-dark border-5 rounded-0 shadow p-0 mb-5 bg-body rounded'>";
                echo "</a>";
                echo "</div>";
            } ?>
        </div>
        <div class="row mt-5">
            <p class="h1">肖像</p>
            <?php
            $images = all('text', "WHERE purpose = 3");
            foreach ($images as $image) {
                echo "<div class='text-center col-2'>";
                echo "<a href='show.php?id={$image['id']}'>";
                echo "<img src='images/{$image['file_name']}' class='card-img-top border border-dark border-5 rounded-0 shadow p-0 mb-5 bg-body rounded'>";
                echo "</a>";
                echo "</div>";
            } ?>
        </div>
        <div class="row mt-5 pb-5">
            <p class="h1">寵物</p>
            <?php
            $images = all('text', "WHERE purpose = 4");
            foreach ($images as $image) {
                echo "<div class='text-center col-2'>";
                echo "<a href='show.php?id={$image['id']}'>";
                echo "<img src='images/{$image['file_name']}' class='card-img-top border border-dark border-5 rounded-0 shadow p-0 mb-5 bg-body rounded'>";
                echo "</a>";
                echo "</div>";
            } ?>
        </div>
    </div>
</body>

</html>