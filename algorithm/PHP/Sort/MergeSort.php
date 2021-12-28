<?php

require('./InsertSort.php');

/**
 * 归并排序递归版实现
 * Class MergeSort
 */
class MergeSort
{
    // 建立一个步长变量，按照步长分左右，并将左右排好序，最后步长>=n/2时，数组已经有序
    public function sortWithNoRecursive($arr)
    {
        $step = 1;
        $count = count($arr);
        while ($step <= $count) {
            $l = 0;
            while ($l < $count) {
                // l..mid 表示 左边的数组
                // mid+1..r 表示右边的数组
                // 特别注意：mid的计算需要根据r与l之间的距离
                // 1.mid的取值 = (l+step -1) > $count，则说明没有右边的数组了
                // 2.r取值范围 min（mid + step, count - 1)
                $mid = ($l + $step - 1);
                // 左组不够 就结束把
                if ($mid >= $count - 1) {
                    break;
                }
                $r = min($mid + $step, $count -1);
                $this->merge($arr, $l, $mid, $r);
                $l = $r + 1;
            }
            $step *= 2;
            if ($step > $count / 2) {
                break;
            }
        }
        return $arr;
    }

    public function sort($arr)
    {
        // 步骤
        // 1.让左部分排好序
        // 2.让右部分排好序
        // 3.合并左右部分结果
        $this->sortRecursive($arr, 0, count($arr) - 1);
        return $arr;
    }

    // 此处为递归部分
    public function sortRecursive(&$arr, $l, $r)
    {
        // 结束条件
        if ($l == $r) {
            return;
        }

        $mid = $l + (($r - $l) >> 1);
        $this->sortRecursive($arr, $l, $mid);
        $this->sortRecursive($arr, $mid + 1, $r);
        $this->merge($arr, $l, $mid, $r);
    }

    public function merge(&$arr, $l, $mid, $r)
    {
        $p1 = $l;
        $p2 = $mid + 1;
        $help = [];

        // 必然有一个先循环完
        while ($p1 <= $mid && $p2 <= $r) {
            $help[] = $arr[$p1] < $arr[$p2] ? $arr[$p1++] : $arr[$p2++];
        }

        // 若左部分未循环完，则将剩下元素填入到help中
        while ($p1 <= $mid) {
            $help[] = $arr[$p1++];
        }

        while ($p2 <= $r) {
            $help[] = $arr[$p2++];
        }

        // 将结果刷回$arr中
        for ($i = 0; $i < count($help); $i++) {
            $arr[$l + $i] = $help[$i];
        }
    }
}

// 生成随机数组，长度为10
function randomArray($len = 10)
{
    $res = [];
    for ($i = 0; $i < $len; $i++) {
        $res[] = random_int(-35, 99);
    }
    return $res;
}

$ms = new MergeSort();
//$is = new InsertSort();

var_dump('测试开始');
$testTimes = 1000;
for ($i = 0; $i < $testTimes; $i++) {
    $randomArr = randomArray(11);
    $res1 = $ms->sort($randomArr);
    $res2 = $ms->sortWithNoRecursive($randomArr);
//    $res2 = $is->sort($randomArr);
    if (count($res1) != count($res2) || !empty(array_diff($res1, $res2))
    ) {
        var_dump('出错啦');
    }
}

var_dump('测试结束');