<?php


class Utils
{
// 生成随机数组，长度为10
    public static function randomArray($len = 10)
    {
        $res = [];
        for ($i = 0; $i < $len; $i++) {
            $res[] = random_int(0, 100);
        }
        return $res;
    }

    public static function swap(&$arr, $l, $r)
    {
        $tmp = $arr[$l];
        $arr[$l] = $arr[$r];
        $arr[$r] = $tmp;
    }

    public static function isEqual($arr1, $arr2): bool
    {
        if (count($arr1) != count($arr2)) {
            return false;
        }

        for ($i = 0; $i < count($arr1); $i++) {
            if ($arr1[$i] != $arr2[$i]) {
                return false;
            }
        }
        return true;
    }
}