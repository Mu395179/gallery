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
            margin-left: 25%;
            width: 30%;
            /* position: relative; */

        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-2"></div>
            <div class="col-7 mt-5"><img class="img-fluid wall" src="wall/wall02.jpg" alt="">
                <img class='print' src='images/20240612205447.jpg'>
            </div>
            <div class="col-3"></div>
        </div>
    </div>

</body>

</html>