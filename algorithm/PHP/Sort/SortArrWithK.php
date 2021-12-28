<?php

require('./utils/Utils.php');

/**
 * 给定一个无序数组
 * 但是每个数组最多移动k个位置一定会有序
 *
 * 思路：在0～k位置时，一定有一个最大数要排到0位置，同理可推，i~k+i位置有一个最大数
 * 所以可以利用堆的思想
 * 让堆的大小保持在k
 * 1.先弹出最大元素
 * 2.再取一个元素插入到堆中
 * 3.一次执行1、2，直到堆为空
 * Class SortArrWithK
 */
class SortArrWithK
{
    public function sort($arr, $k)
    {
        $heap = new SplMinHeap();

        for ($i = 0; $i <= $k; $i++) {
            $heap->insert($arr[$i]);
        }

        $res = [];
        while (!$heap->isEmpty()) {
            $res[] = $heap->extract();
            $i < count($arr) && $heap->insert($arr[$i++]);
        }
        return $res;
    }

    public function randomArrayNoMoveMoreK($k): array
    {
        $arr = Utils::randomArray(20);
        sort($arr);
        // 记录i交换过
        $isSwap = [];
        for ($i = 0; $i < count($arr); $i++) {
            $j = min($i + random_int(0, $k), count($arr) - 1);
            if (empty($isSwap[$i]) && empty($isSwap[$j])) {
                Utils::swap($arr, $i, $j);
                $isSwap[$i] = true;
                $isSwap[$j] = true;
            }
        }
        return $arr;
    }

    public function comparetor(&$arr)
    {
        sort($arr);
    }
}


$ms = new SortArrWithK();

var_dump('测试开始');
$testTimes = 10000;
for ($i = 0; $i < $testTimes; $i++) {
    $k = random_int(1, 7);
    $randomArr = $ms->randomArrayNoMoveMoreK($k);
    $res2 = $randomArr;
    $res1 = $ms->sort($randomArr, $k);
    $ms->comparetor($res2);

    if (!Utils::isEqual($res1, $res2)) {
        var_dump('出错了');
    }
}

var_dump('测试结束');
