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
            height: 90%;
            z-index: -1;
        }

        .print {
            margin-top: 20%;
            margin-left: 28%;
            width: 40%;
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
            <div class="col-4">
                <!-- Buttons to switch images -->
                <button id="button1">Wall 01</button>
                <button id="button2">Wall 02</button>
                <button id="button3">Wall 03</button>
            </div>
            <div class="col-6 mt-5" id="wall01">
                <img class="img-fluid wall" src="wall/wall01.jpg" alt="">
                <img class='print' src='images/20240612205447.jpg' alt=''>
            </div>
            <div class="col-6 mt-5" id="wall02">
                <img class="img-fluid wall" src="wall/wall02.jpg" alt="">
                <img class='print' src='images/20240612205447.jpg' alt=''>
            </div>
            <div class="col-6 mt-5" id="wall03">
                <img class="img-fluid wall" src="wall/wall03.jpg" alt="">
                <img class='print' src='images/20240612205447.jpg' alt=''>
            </div>
            <div class="col-2"></div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            // Initially show the second wall (assuming wall02 is the default as per your initial code)
            $("#wall02").addClass("active");

            // Handle button clicks
            $("#button1").click(function () {
                $(".col-6").removeClass("active");
                $("#wall01").addClass("active");
            });

            $("#button2").click(function () {
                $(".col-6").removeClass("active");
                $("#wall02").addClass("active");
            });

            $("#button3").click(function () {
                $(".col-6").removeClass("active");
                $("#wall03").addClass("active");
            });
        });
    </script>


</body>

</html>