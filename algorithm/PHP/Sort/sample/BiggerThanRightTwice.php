<?php

/**
 * 找出左侧的数比右侧的2倍还大的元素总个数
 */
class BiggerThanRightTwice
{
    public function getResult($arr): int
    {
        // 步骤
        // 1.让左部分排好序
        // 2.让右部分排好序
        // 3.合并左右部分结果
        return $this->process($arr, 0, count($arr) - 1);
    }

    // 此处为递归部分
    public function process(&$arr, $l, $r): int
    {
        // 结束条件
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
        $p1 = $l;
        $p2 = $mid + 1;
        $help = [];

        // 目前遍历了的数为 [$mid+1, $windowR)，这里为开区间，表示达不到，所以最开始为0
        $windowR = $mid + 1;
        $ans = 0;
        // 循环左组
        for ($i = $l; $i <= $mid; $i++) {
            // 当左组 > 右组 * 2，则把右组右移
            while ($windowR <= $r && ($arr[$i] > $arr[$windowR] * 2)) {
                $windowR++;
            }
            $ans += $windowR - $mid - 1;
        }

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

        return $ans;
    }


    // 对比方法
    public function comparator($arr): int
    {
        $res = 0;
        for ($i = 0; $i < count($arr) - 1; $i++) {
            for ($j = $i + 1; $j < count($arr); $j++) {
                if ($arr[$i] > $arr[$j] * 2) {
                    $res++;
                }
            }
        }
        return $res;
    }
}

// 生成随机数组，长度为10
function randomArray($len = 10)
{
    $res = [];
    for ($i = 0; $i < $len; $i++) {
        $res[] = random_int(1, 50);
    }
    return $res;
}

$ss = new BiggerThanRightTwice();

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