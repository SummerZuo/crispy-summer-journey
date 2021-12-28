<?php

/**
 * 找出最多的重合线段
 * Class CoverLineMax
 */
class CoverLineMax
{
    /**
     * 生成随机线段数组
     */
    public function randomLineArr($lineNums = 20)
    {
        $max = 99;
        for ($i = 0; $i < $lineNums; $i++) {
            $start = random_int(1, $max);
            $end = random_int($start + 1, $max + 2);
            $res[] = [$start, $end];
        }
        return $res;
    }

    /**
     * 思路：
     * 1.将线段数组按开始位置start排序（堆排序）
     * 2.依次遍历排好序的数组，弹出 <= start的数
     * 3.然后把当前位置的end加入堆中，当前堆的大小即为重合线段数
     */
    public function getMax($arr): int
    {
        // 排序
        $c = new StartCompare();
        $c->sort($arr);

        $heap = new SplMinHeap();
        $max = 0;
        for ($i = 0; $i < count($arr); $i++) {
            list($start, $end) = $arr[$i];
            while(!$heap->isEmpty() && $heap->top() <= $start) {
                $heap->extract();
            }
            $heap->insert($end);
            $max = max($heap->count(), $max);
        }

        return $max;
    }

    /**
     * 对比方法
     * 1.找出线段中的 start的最小值
     * 2.找出线段中的end最大值
     * 3.将线段按照每1个单位，按0.5等分，看有多少线段包含对应的.5，即为重合线段数
     * @param $arr
     * @return int
     */
    public function comparetor($arr): int
    {
        $minStart = null;
        $maxEnd = null;
        for ($i = 0; $i < count($arr); $i++) {
            list($start, $end) = $arr[$i];
            if ($i == 0) {
                $minStart = $start;
                $maxEnd = $end;
            } else {
                $minStart = min($minStart, $start);
                $maxEnd = max($maxEnd, $end);
            }
        }
        $max = 0;
        for ($i = $minStart; $i <= $maxEnd; $i++) {
            $compareValue = $i + 0.5;
            $count = 0;
            for ($j = 0; $j < count($arr); $j++) {
                list($start, $end) = $arr[$j];
                if ($start < $compareValue && $end > $compareValue) {
                    $count++;
                }
            }
            $max = max($max, $count);
        }
        return $max;
    }
}

class StartCompare extends SplHeap
{
    protected function compare($value1, $value2)
    {
        return $value2[0] - $value1[0];
    }

    public function sort(&$arr)
    {
        // 排序
        for ($i = 0; $i < count($arr); $i++) {
            $this->insert($arr[$i]);
        }
        $i = 0;
        while (!$this->isEmpty()) {
            $arr[$i++] = $this->extract();
        }
    }

}

$clm = new CoverLineMax();

var_dump('测试开始');
$testTimes = 1000;
for ($i = 0; $i < $testTimes; $i++) {
    $arr = $clm->randomLineArr();
    $max1 = $clm->getMax($arr);
    $max2 = $clm->comparetor($arr);

    if ($max1 != $max2) {
        var_dump('出错了');
    }
}
var_dump('测试结束');