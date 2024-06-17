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
        .wall {
            position: absolute;
            width: 30%;
            height: 90vh;
            z-index: -1;
        }

        .print {
            position: relative;
            margin-top: 15%;
            margin-left: 31%;
            width: 30%;
        }

        .col-6 {
            display: none;
        }

        .col-6.active {
            display: block;
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
            <div class="col-7"><?php echo "<img class='img-thumbnail' src='images/{$img['file_name']}'>"; ?></div>

            <div class="col-3">作者介紹</div>

            <div class="row">
                <div class="col-3">

                </div>
                <div class="col-6 mt-5" id="wall01">
                    <img class="img-fluid wall" src="wall/wall04.jpg" alt="">
                    <?php echo "<img class='print' style='box-shadow: 0px 20px 30px 1px rgba(0, 0, 0, 0.5)' src='images/{$img['file_name']}' >"; ?>
                </div>
                <div class="col-6 mt-5" id="wall02">
                    <img class="img-fluid wall" src="wall/wall02.jpg" alt="">
                    <?php echo "<img class='print' style='box-shadow: 20px 20px 30px 1px rgba(0, 0, 0, 0.3)' src='images/{$img['file_name']}'>"; ?>
                </div>
                <div class="col-6 mt-5" id="wall03">
                    <img class="img-fluid wall x-100" src="wall/wall06.jpg" alt="">
                    <?php echo "<img class='print' style='box-shadow: -20px 20px 30px 1px rgba(0, 0, 0, 0.4)' src='images/{$img['file_name']}'>"; ?>
                </div>
                <div class="col-3">
                    <!-- Buttons to switch images -->
                    <button id="button1">Wall 01</button>
                    <button id="button2">Wall 02</button>
                    <button id="button3">Wall 03</button>
                </div>
            </div>

            <!-- <div class="row">
                <div class="col-2"></div>
                <div class="col-7 mt-5"><img class="img-fluid wall" src="wall/wall02.jpg" alt="">
                    <?php echo "<img class='print' src='images/{$img['file_name']}'>"; ?>
                </div>
                <div class="col-3"></div>
            </div> -->


        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            // Initially show the second wall
            $("#wall02").addClass("active").fadeIn();

            // Handle button clicks
            $("#button1").click(function () {
                $(".col-6.active").fadeOut(function () {
                    $(this).removeClass("active");
                    $("#wall01").fadeIn().addClass("active");
                });
            });

            $("#button2").click(function () {
                $(".col-6.active").fadeOut(function () {
                    $(this).removeClass("active");
                    $("#wall02").fadeIn().addClass("active");
                });
            });

            $("#button3").click(function () {
                $(".col-6.active").fadeOut(function () {
                    $(this).removeClass("active");
                    $("#wall03").fadeIn().addClass("active");
                });
            });
        });
    </script>
</body>

</html>