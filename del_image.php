<?php

include_once "db.php";


$img = find('images', $_GET['id']);

dd($img);

unlink('images/' .$img['file_name']);

del('images', $_GET['id']);

del('text', $_GET['id']);

header("location:upload.php");