<?php
$table_limit = [];
function get_table_limit ($data, $page = 1){
    global $table_limit;
    $tpp = 20;
    $need = $tpp * $page;
    $count = 0;
    $min = ($page - 1) * $tpp;
    foreach ($data as $key => $val){
        $count += $val;
        if ($count > $min){
            $start = 0;
            $end = $tpp;
            $left = $tpp - ($count - $val);
            if ($left >= $count){
                $end = $val;
            }else{
                $start = ($page - 1) * $tpp - ($count - $val);
                if ($start < 0){
                    $start = 0;
                    $end = $left;
                }
                $diff = $val - $start;
                if ($diff < $tpp){
                    $end = $diff;
                }else{
                    if ($start == 0){
                        $end = $tpp - ($count - $val) % $tpp;
                    }
                }
            }
            $table_limit[] = [
                'table' => $key,
                'limit' => $start.','.$end
            ];
        }
        if ($count > $need){
            break;
        }
    }
}
