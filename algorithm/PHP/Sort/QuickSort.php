<?php

require('./utils/Utils.php');

class op
{
    public $l;
    public $r;

}

/**
 * 将数组分为左、中、右3部分
 */
class QuickSort
{
    public function sort(&$arr)
    {
        $this->partition3($arr, 0, count($arr) - 1);
    }

    /**
     * 3.0的非递归版本（迭代版本）
     * 把一个大任务拆除2个子任务，再单独执行（子任务没有相关性，我认为可以替换成队列来做）
     */
    public function sort2(&$arr)
    {
        if (count($arr) < 2) {
            return;
        }
//        $stack = new SplStack();
        $stack = new SplQueue();
        // 交换
        $cnt = count($arr) - 1;
        $this->swap($arr, $cnt, random_int(0, $cnt));
        $ret = $this->netherlandsFlag($arr, 0, $cnt);
        $stack->enqueue([0, $ret[0] - 1]);
        $stack->enqueue([$ret[1] + 1, $cnt]);
        while (!$stack->isEmpty()) {
            list($l, $r) = $stack->dequeue();
            if ($l < $r) {
                $this->swap($arr, $r, random_int($l, $r));
                $ret = $this->netherlandsFlag($arr, $l, $r);
                $stack->enqueue([$l, $ret[0] - 1]);
                $stack->enqueue([$ret[1] + 1, $r]);
            }
        }
    }

    /**
     * 快排2.0
     * 时间复杂度: O(N^2)
     * 核心：每次将数组的R作为比较基准，分为3块区域（ <R、 ==R、 >R ）
     * 排好后，记录等于R的开始、结束位置，分别作为下一次递归的结束、开始位置
     */
    public function partition2(&$arr, $l, $r)
    {
        if ($l >= $r) {
            return;
        }

        $ret = $this->nearthlandFlag($arr, $l, $r);
        $this->partition2($arr, $l, $ret[0] - 1);
        $this->partition2($arr, $ret[1] + 1, $r);
    }

    /**
     * 随机快排
     * 时间复杂度: O(N*logN) 利用master公式计算得来
     * 比2.0多了一步：在排序之前，在 l~r 之间产生一个随机值，来替换r的比较基准
     */
    public function partition3(&$arr, $l, $r)
    {
        if ($l >= $r) {
            return;
        }
        $this->swap($arr, $r, random_int($l, $r));
        $ret = $this->netherlandsFlag($arr, $l, $r);
        $this->partition3($arr, $l, $ret[0] - 1);
        $this->partition3($arr, $ret[1] + 1, $r);
    }

    public function netherlandsFlag(&$arr, $l, $r): array
    {
        $less = $l - 1;
        $more = $r;
        // 解法：准备两个指针
        // 左指针：表示[0...l]为<target的数
        // 右指针：表示[r...cnt]为>target的数
        // [l...r]表示=target的数

        // 准备一个遍历指针，从0开始
        // 如果i位置的数<target，则将i划到左侧区域：i与l+1的位置交互，l++,i++
        // 如果 arr[i] == target, i++
        // 如果 arr[i] > target, 则将arr[i]划到右侧区域：i与r-1位置交换，r--,i不变
        $i = $l;
        while ($i < $more) {
            if ($arr[$i] < $arr[$r]) {
                $this->swap($arr, ++$less, $i++);
            } else if ($arr[$i] == $arr[$r]) {
                $i++;
            } else {
                $this->swap($arr, --$more, $i);
            }
        }
        // 交换r 与more位置的值
        $this->swap($arr, $more, $r);
        return [$less + 1, $more];
    }

    public function swap(&$arr, $l, $r)
    {
        $tmp = $arr[$l];
        $arr[$l] = $arr[$r];
        $arr[$r] = $tmp;
    }

}


$randomArr = Utils::randomArray();
//$randomArr = [1, 5, 8, 4, 6, 2, 7, 3, 4];

$qs = new QuickSort();
var_dump($randomArr);
$qs->sort2($randomArr);

var_dump($randomArr);