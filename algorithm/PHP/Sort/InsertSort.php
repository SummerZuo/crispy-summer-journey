<?php

// 每次都保证前i项有序
class InsertSort
{
    public function sort($arr)
    {
        if (count($arr) < 2) {
            return $arr;
        }

        for ($i = 1; $i < count($arr); $i++) {
            for ($j = $i - 1; $j >= 0 && $arr[$j + 1] < $arr[$j]; $j--) {
                $tmp = $arr[$j + 1];
                $arr[$j + 1] = $arr[$j];
                $arr[$j] = $tmp;
            }
        }
        return $arr;
    }
}