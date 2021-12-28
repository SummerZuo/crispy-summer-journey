<?php

// 选择排序
function selectSort(array $arr)
{
    // 选一个最小的值放入i位置
    // 第i个位置的值依次与后面的值进行比较，将最小值放置于i位置
    for ($i = 0; $i < count($arr) - 1; $i++) {
        for ($j = $i + 1; $j < count($arr); $j++) {
            if ($arr[$i] > $arr[$j]) {
                $tmp = $arr[$i];
                $arr[$i] = $arr[$j];
                $arr[$j] = $tmp;
            }
        }
    }
}