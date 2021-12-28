<?php

/**
 * 逆序对，左侧的数 > 右侧的数（不需要两个数相邻）,找出总共有多少对这样的数
 * Class ReversePair
 */
class ReversePair
{
    public function getResult($arr): int
    {
        return $this->process($arr, 0, count($arr) - 1);
    }

    /**
     * 求小和的过程（递归）
     * 左侧的小和数
     * 右侧的小和数
     * 合并过程的小和数
     */
    public function process(&$arr, $l, $r): int
    {
        if ($l == $r) {
            return 0;
        }
        $mid = $l + (($r - $l) >> 1);
        return $this->process($arr, $l, $mid)
            + $this->process($arr, $mid + 1, $r)
            + $this->merge($arr, $l, $mid, $r);
    }

    // 站在右组的角度来看
    public function merge(&$arr, $l, $mid, $r): int
    {
        $res = 0;
        $help = [];
        $p1 = $mid;
        $p2 = $r;
        $index = $r - $l;
        while ($p1 >= $l && $p2 >= $mid + 1) {
            $res += $arr[$p1] > $arr[$p2] ? ($p2 - $mid) : 0;
            $help[$index--] = $arr[$p1] > $arr[$p2] ? $arr[$p1--] : $arr[$p2--];
        }

        while ($p1 >= $l) {
            $help[$index--] = $arr[$p1--];
        }

        while ($p2 >= $mid+1) {
            $help[$index--] = $arr[$p2--];
        }
        for ($i = 0; $i < count($help); $i++) {
            $arr[$i + $l] = $help[$i];
        }
        return $res;
    }

    // 对比方法
    public function comparator($arr): int
    {
        $res = 0;
        for ($i = 0; $i < count($arr) - 1; $i++) {
            for ($j = $i + 1; $j < count($arr); $j++) {
                if ($arr[$j] < $arr[$i]) {
                    $res++;
                }
            }
        }
        return $res;
    }
}

$ss = new ReversePair();

// 生成随机数组，长度为10
function randomArray($len = 10)
{
    $res = [];
    for ($i = 0; $i < $len; $i++) {
        $res[] = random_int(-35, 99);
    }
    return $res;
}

var_dump('测试开始');

$testTimes = 1000;
for ($i = 0; $i < $testTimes; $i++) {
    $randomArr = randomArray(10);
    $res1 = $ss->getResult($randomArr);
    $res2 = $ss->comparator($randomArr);
    if ($res1 != $res2) {
        var_dump('出错啦');
    }
}

var_dump('测试结束');