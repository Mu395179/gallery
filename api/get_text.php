<?php include_once "base.php";

$text = q('select `classroom` from `students` group by `classroom`');
echo json_encode($classrooms);