<?php
include_once "db.php";

$img = joinfind('text', $_GET['id']);

// echo "<img src='images/{$img['file_name']}'>";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>

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
            <div class="col-4 mt-5">
                <a href="index.php" class="btn btn-primary">回首頁</a>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-12">
            <h4 class="card-title"><?= "{$img['original_name']}" ?></h4>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-2">
                    <p class="card-text mt-5"><?= "{$img['purpose_ch_name']}" ?></p>
                    <p class="card-text mt-5"><?= "{$img['style_ch_name']}" ?></p>
                    <p class="card-text mt-5"><?= "{$img['size_name']}" ?></p>
                    <p class="card-text mt-5"><?= "{$img['method_ch_name']}" ?></p>
                    <p class="card-text mt-5"><?= "{$img['description']}" ?></p>

            </div>
            <div class="col-6"><?php echo "<img class='img-thumbnail' src='images/{$img['file_name']}'>"; ?></div>
            <div class="col-4">作者介紹</div>



        </div>
    </div>
</body>

</html>