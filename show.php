<?php
include_once "db.php";

$img = find('images', $_GET['id']);
dd($img);

echo "<img src='images/{$img['file_name']}'>";
?>