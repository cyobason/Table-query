<?php
include 'function.php';
$data = ['0' => 11, '1' => 0, '2' => 38, '3' => 198];
get_table_limit($data);
$result = [];
if ($table_limit){
  foreach($table_limit as $limit){
    $result = array_merge_recursive($result, get_data($limit));
  }
}
print($result);
