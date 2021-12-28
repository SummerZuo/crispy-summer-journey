<?php

/**
 * 基数排序：对排序数组有要求:数组元素非负
 * 思路
 * 1.从数组中找到一个最大值，确认最大位数 maxBit（十进制下的位数）
 * 2.准备10个桶（队列或栈）
 * 3.循环 0-maxBit
 * 4.算出每个数字对应位置的值，放入对应桶中
 * 5.出桶，形成新数组
 * 完成第三步后，数组即有序
 * Class RadixSort
 */
error_reporting(E_ERROR);
require('./utils/Utils.php');

class RadixSort
{
    public function sort(array &$arr)
    {
        $max = -1;
        for ($i = 0; $i < count($arr); $i++) {
            $max = max($arr[$i], $max);
        }
        $maxDigest = $this->getDigest($max);

        $this->sortInternal($arr, $maxDigest);
    }

    public function sortInternal(&$arr, $maxDigest)
    {
        // TODO 基数排序核心
        // 这里可以用一种优雅的方式来替代10个桶，完成入桶、出桶的操作
        for ($i = 0; $i < $maxDigest; $i++) {
            // 1.取出每个数字，每一位的值
            // 2.算出每一位出现的总数
            $count = [];
            foreach ($arr as $item) {
                $v = $this->getDigestNum($item, $i);
                $count[$v]++;
            }
            for ($j = 1; $j <= 9; $j++) {
                $count[$j] += $count[$j - 1];
            }
            $newArr = [];
            for ($j = count($arr) - 1; $j >= 0; $j--) {
                $v = $this->getDigestNum($arr[$j], $i);
                $newArr[--$count[$v]] = $arr[$j];
            }
            $arr = $newArr;
        }
        ksort($arr);
    }

    // 获取值的位数
    public function getDigest(int $num): int
    {
        if ($num === 0) {
            return 1;
        }
        $res = 0;
        while ($num > 0) {
            $num = intval($num / 10);
            $res++;
        }
        return $res;
    }

    /**
     * 获取数字中对应位上的值
     * @param $num
     * @param $i
     */
    public function getDigestNum($num, $i): int
    {
        $res = 0;
        while ($i >= 0 && $num > 0) {
            $res = $num % 10;
            $num = $num / 10;
            $i--;
        }
        if ($i >= 0) {
            return 0;
        }
        return $res;
    }
}
sort($arr);
$arr = Utils::randomArray(10);
$radix = new RadixSort();
$radix->sort($arr);
var_dump($arr);die;