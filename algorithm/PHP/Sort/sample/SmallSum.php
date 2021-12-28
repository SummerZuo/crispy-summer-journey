<?php

/**
 *小和问题
 *一个数组，若在下标i，在0～i-1中，找出小于 i 位置的数，依次i++，并将找到的数累计
 */
class SmallSum
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

    public function merge(&$arr, $l, $mid, $r): int
    {
        $res = 0;
        $help = [];
        $p1 = $l;
        $p2 = $mid + 1;
        while($p1 <= $mid && $p2 <= $r) {
            // 比较大小，并放入到help数组中
            // 只有左数组小于右数组才记录小和
            $res +=  $arr[$p1] < $arr[$p2] ? ($r - $p2 + 1) * $arr[$p1] : 0;
            $help[] = $arr[$p1] < $arr[$p2] ? $arr[$p1++] : $arr[$p2++];
        }

        while ($p1 <= $mid) {
            $help[] = $arr[$p1++];
        }

        while ($p2 <= $r) {
            $help[] = $arr[$p2++];
        }
        for ($i=0; $i< count($help); $i++) {
            $arr[$i+$l] = $help[$i];
        }
        return $res;
    }

    // 对比方法
    public function comparator($arr): int
    {
        $res = 0;
        for ($i=1; $i<count($arr); $i++) {
            for ($j=0; $j<$i; $j++) {
                if ($arr[$j] < $arr[$i]) {
                    $res += $arr[$j];
                }
            }
        }
        return $res;
    }
}

$ss = new SmallSum();

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
    $randomArr = randomArray(11);
    $res1 = $ss->getResult($randomArr);
    $res2 = $ss->comparator($randomArr);
    if ($res1 != $res2) {
        var_dump('出错啦');
    }
}

var_dump('测试结束');