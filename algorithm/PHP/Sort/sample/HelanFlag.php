<?php
require('../utils/Utils.php');
// 荷兰国旗问题
// 数组中分3层
// 左边放<target的数，中间放=target，右边放>target(左、右侧不需要内部有序)
class HelanFlag
{
    public function sort(&$arr): array
    {
        return $this->partition($arr, 0, count($arr) - 1);
    }

    public function partition(&$arr, $l, $r): array
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
$randomArr = [1, 5, 8, 4, 6, 2, 7, 3, 4];

$obj = new HelanFlag();

$ret = $obj->process($randomArr);
var_dump(implode(',', $randomArr), $ret);