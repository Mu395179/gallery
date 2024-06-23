<?php include_once "base.php";

$text = q("SELECT `text`.`id`,`file_name`, `original_name`,`description`,`purpose_ch_name`,`style_ch_name`,`size_name`,`method_ch_name` FROM `text` JOIN`purpose`ON`text`.`purpose` = `purpose`.`id` JOIN`style`ON`text`.`style` = `style`.`id` JOIN`size`ON`text`.`size` = `size`.`id` JOIN`method`ON`text`.`method` = `method`.`id` WHERE ");
echo json_encode($text);