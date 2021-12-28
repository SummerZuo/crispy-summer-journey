<?php

require('./utils/Utils.php');

/**
 * 大顶堆
 */
class MaxHeap
{
    public $heapSize = 0;

    public $arr;

    public function insert($value)
    {
        $this->arr[$this->heapSize] = $value;
        $this->headInsert($this->arr, $this->heapSize);
        $this->heapSize++;
    }

    /**
     * 弹出顶部元素
     */
    public function extract()
    {
        // 1.记录顶部元素，然后用底部元素来补
        if ($this->isEmpty()) {
            return null;
        }

        $top = $this->arr[0];
        Utils::swap($this->arr, 0, $this->heapSize - 1);
        $this->heapify($this->arr, 0, --$this->heapSize);
        return $top;
    }

    public function heapSort(array &$arr)
    {
        for ($i = 0; $i < count($arr); $i++) {
            $this->headInsert($arr, $i);
        }

        $size = count($arr);
        Utils::swap($arr, 0, --$size);
        while ($size > 1) {
            $this->heapify($arr, 0, $size);
            Utils::swap($arr, 0, --$size);
        }
        return $arr;
    }

    public function isEmpty()
    {
        return $this->heapSize == 0;
    }

    /**
     * 时间复杂度为O(logN)
     * @param $arr
     * @param $i
     */
    public function headInsert(&$arr, $i)
    {
        // 1.是否存在父节点，或者是否大于父节点的值
        while ($arr[$i] > $arr[($i - 1) / 2]) {
            Utils::swap($arr, $i, ($i - 1) / 2);
            $i = ($i - 1) / 2;
        }
    }

    /**
     * 时间复杂度为O(logN)
     * @param $arr
     * @param $index
     * @param $size
     */
    public function heapify(&$arr, $index, $size)
    {
        $left = $index * 2 + 1;
        // 如果父节点 < 大子节点，则与大子节点交换(直到没有子节点 或 > 子节点)
        while ($left < $size) {
            // 如果右节点存在，则左节点肯定存在，
//            $childMaxIndex = $right > $size ? $left :
            // 找到子节点最大值的下标

            // 取右节点的情况：右节点存在 && 右节点值>左节点值
            $largestIndex = ($left + 1) < $size && $arr[$left + 1] > $arr[$left] ? $left + 1 : $left;

            if ($arr[$largestIndex] <= $arr[$index]) {
                break;
            }
            Utils::swap($arr, $index, $largestIndex);
            $index = $largestIndex;
            $left = $index * 2 + 1;
        }
    }
}

$heap = new MaxHeap();
//$heap->insert(10);
//$heap->insert(20);
//$heap->insert(15);
//$heap->insert(30);
//$heap->insert(9);
//$heap->insert(11);
//$heap->insert(16);
//$heap->insert(8);

//$ret = $heap->extract();
//$ret = $heap->extract();
//$ret = $heap->extract();
//$ret = $heap->extract();
//$ret = $heap->extract();
//$ret = $heap->extract();
//$ret = $heap->extract();
//$ret = $heap->extract();

$arr = [10, 20, 15, 30, 9, 11, 16, 8];
$heap->heapSort($arr);
var_dump($arr);
die;

