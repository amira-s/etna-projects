<?php
function shell_sort(&$array) {
    $len = count($array);

    $n = 1;
    while ($n < $len) {
        $n = $n * 2 + 1;
    }
    while ($n > 0) {
        for ($c = 0; $c < $n; $c++) {
            for ($i = $n; $i < $len; $i += $n) {
                $temp = $array[$i];
                for ($j = $i - $n; $j >= 0 && $array[$j] > $temp; $j -= $n) {
                    $array[$j + $n] = $array[$j];
                }
                $array[$j + $n] = $temp;
            }
        }
        $n = ($n - 1) / 2;
    }
}

function quick_sort ($array) {
    $len = count($array);

    if ($len < 2)
        return $array;

    $pivot = $array[0];
    $left = $right = array();
    for ($i = 1; $i < $len; $i++) {
        if ($array[$i] < $pivot) {
            $left[] = $array[$i];
        } else {
            $right[] = $array[$i];
        }
    }
    return array_merge(quick_sort($left), array($pivot), quick_sort($right));
}
