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

function get_data($limit){
    // 下面只为例子展示，可自行更改成自己的查询语句
    return $db->fetchAll('select * from table_'.$limit['table'].' where condition = ? limit '.$limit['limit']);
}
