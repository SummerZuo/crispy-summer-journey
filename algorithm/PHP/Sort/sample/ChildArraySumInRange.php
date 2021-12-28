<?php

// 找出数组中子数组的和在 [lower, upper]
// 子数组元素需要连续
class ChildArraySumInRange
{
    public function getResult($arr, $lower, $upper): int
    {
        $sum = [];
        $sum[0] = $arr[0];
        // 1.先将数组转化为一个前缀和数组(sum[i]表示前i项de和)
        // 2.sum[j] - sum[i] = sum[i...j] (i~j的范围和)
        // 3.若[i..j]的结果在范围内，则存在一个结果

        // 此处要求所有满足条件的子数组，需要转换思维
        // 可转换为当此时位置为X时，0～X内有多少个子数组的和在[lower, upper]范围内
        // 可利用归并排序中左右分组的思想来计算
        // 右组中的元素位置为X，找出左组中元素满足[arr[X]-upper, arr[X]-lower]范围内的有多少
        for ($i = 1; $i < count($arr); $i++) {
            $sum[$i] = $sum[$i - 1] + $arr[$i];
        }
        return $this->process($sum, 0, count($sum) - 1, $lower, $upper);
    }

    // 找出符合条件的元素个数
    public function process(&$sum, $l, $r, $lower, $upper): int
    {
        // base case
        // 只有一个元素时，则元素范围在条件内，则返回1
        if ($l == $r) {
            return ($sum[$l] >= $lower && $sum[$l] <= $upper) ? 1 : 0;
        }
        $mid = ($l + (($r - $l) >> 1));
        return $this->process($sum, $l, $mid, $lower, $upper)
            + $this->process($sum, $mid + 1, $r, $lower, $upper)
            + $this->merge($sum, $l, $mid, $r, $lower, $upper);
    }

    // 合并数组，计算合并过程中产生的子数组个数
    public function merge(&$sum, $l, $mid, $r, $lower, $upper): int
    {
        $p1 = $l;
        $p2 = $mid + 1;
        $help = [];

        // 1. 计算个数 符合条件的数组范围[windowL, windowR),总个数为 = windowR - windowL
        $windowL = $l;
        $windowR = $l;
        // 由于min、max是递增的，所以可以利用此特性进行不回退操作
        // 下一次的windowL一定从上一次的windowL开始++ （同理windowR一样）
        $ans = 0;
        for ($i = $mid + 1; $i <= $r; $i++) {
            $min = $sum[$i] - $upper;
            $max = $sum[$i] - $lower;
            // 找一个数 >= min，如果找到则停下，没找到就继续往后找
            while ($windowL <= $mid && $sum[$windowL] < $min) {
                $windowL++;
            }
            // ps:由于结果为开区间，所以这里需要剔除掉等于
            // 找一个数 > max，则之前的数都要纳入计算
            while ($windowR <= $mid && $sum[$windowR] <= $max) {
                $windowR++;
            }

            // 存在一种异常情况， 所有结果都不满足
            // 则此时 [min, max]， 若左组所有数都 < min,则此时 windowL 会一直跑到M
            // 而 左组所有数都 < max，所以windowR不会动，此时 windowL > windowR，这种情况就应该返回0

            $ans += max(($windowR - $windowL), 0);
        }
        // 2. 处理左右组合并过程

        while ($p1 <= $mid && $p2 <= $r) {
            $help[] = $sum[$p1] < $sum[$p2] ? $sum[$p1++] : $sum[$p2++];
        }
        while ($p1 <= $mid) {
            $help[] = $sum[$p1++];
        }
        while ($p2 <= $r) {
            $help[] = $sum[$p2++];
        }
        for ($i = 0; $i < count($help); $i++) {
            $sum[$l + $i] = $help[$i];
        }
        return $ans;
    }

    public function comparator($arr, $lower, $upper)
    {
        $ans = 0;
        for ($i = 0; $i <= count($arr) - 1; $i++) {
            $sum = 0;
            for ($j = $i; $j < count($arr); $j++) {
                $sum += $arr[$j];
                if ($sum <= $upper && $sum >= $lower) {
                    $ans++;
                }
            }
        }
        return $ans;
    }
}


// 生成随机数组，长度为10
function randomArray($len = 10)
{
    $res = [];
    for ($i = 0; $i < $len; $i++) {
        $res[] = random_int(-10, 20);
    }
    return $res;
}

$ss = new ChildArraySumInRange();

var_dump('测试开始');

$testTimes = 1000;
for ($i = 0; $i < $testTimes; $i++) {
    $randomArr = randomArray(10);
    $res1 = $ss->getResult($randomArr, 10, 20);
    $res2 = $ss->comparator($randomArr, 10, 20);
    if ($res1 != $res2) {
        var_dump('出错啦');
    }
}

var_dump('测试结束');