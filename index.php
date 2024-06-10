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
body{
    height: 100vh;
    background-color: lightyellow;
}
.nav-link{
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
        </div>
    
        <div class="row mt-5">
            <p class="h1">風景</p>
            <?php
            $images = all('text', "WHERE purpose = 1");
            foreach ($images as $image) {
                echo "<div class='text-center col-2'>";
                echo "<img src='images/{$image['file_name']}' class='card-img-top border border-dark border-5 rounded-0 shadow p-0 mb-5 bg-body rounded'>";
                echo "</div>";
            } ?>
        </div>
        <div class="row mt-5">
            <p class="h1">靜物</p>
            <?php
            $images = all('text', "WHERE purpose = 2");
            foreach ($images as $image) {
                echo "<div class='text-center col-2'>";
                echo "<img src='images/{$image['file_name']}' class='card-img-top border border-dark border-5 rounded-0 shadow p-0 mb-5 bg-body rounded'>";
                echo "</div>";
            } ?>
        </div>
        <div class="row mt-5">
            <p class="h1">肖像</p>
            <?php
            $images = all('text', "WHERE purpose = 3");
            foreach ($images as $image) {
                echo "<div class='text-center col-2'>";
                echo "<img src='images/{$image['file_name']}' class='card-img-top border border-dark border-5 rounded-0 shadow p-0 mb-5 bg-body rounded'>";
                echo "</div>";
            } ?>
        </div>
        <div class="row mt-5 pb-5">
            <p class="h1">寵物</p>
            <?php
            $images = all('text', "WHERE purpose = 4");
            foreach ($images as $image) {
                echo "<div class='text-center col-2'>";
                echo "<img src='images/{$image['file_name']}' class='card-img-top border border-dark border-5 rounded-0 shadow p-0 mb-5 bg-body rounded'>";
                echo "</div>";
            } ?>
        </div>
    </div>
</body>

</html>