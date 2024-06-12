<?php
include_once "db.php";

$img = find('text', $_GET['id']);
dd($img);

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
            <div class="col-12">作品名稱</div>
        </div>
        <div class="row">
            <div class="col-2">作品簡介

                <?php
                foreach ($img as $index => $image) { ?>
                    <h4 class="card-title"><?= "{$image['original_name']}" ?></h4>
                    <p class="card-text"><?= "{$image['purpose_ch_name']}" ?></p>
                    <p class="card-text"><?= "{$image['style_ch_name']}" ?></p>
                    <p class="card-text"><?= "{$image['size_name']}" ?></p>
                    <p class="card-text"><?= "{$image['method_ch_name']}" ?></p>
                    <p class="card-text"><?= "{$image['description']}" ?></p>
                <?php } ?>
            </div>
            <div class="col-6"><?php echo "<img class='img-thumbnail' src='images/{$image['file_name']}'>"; ?></div>
            <div class="col-4">作者介紹</div>



        </div>
    </div>
</body>

</html>