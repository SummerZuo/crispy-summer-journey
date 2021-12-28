<?php

error_reporting(E_ERROR);

class FindK
{
// 数组中有一个数出现了k次，其他数出现了m次，m > 1 且 k < m
// 找出出现了k次的数

    // 笨办法
    public function findK2($arr, $k, $m)
    {
        // 统计每个数字出现的频率，若次数为k，则返回结果
        $t = [];
        foreach ($arr as $item) {
            $t[$item]++;
        }
        foreach ($t as $value => $time) {
            if ($time == $k) {
                return $value;
            }
        }
        return -1;
    }

    public function findK1($arr, $k, $m)
    {
        // 1.申请一个新数组t，存放传入数组arr中每个值对应二进制表示下第i位的和
        // 2.如果t[i] % m == 0 表示i位置不存在出现k次的元素
        // 3.   t[i] % m != 0 则第i位一定出现了出现k次的元素
        $t = [];
        foreach ($arr as $item) {
            for ($i = 0; $i < 64; $i++) {
                // 每次都取一位
                $t[$i] += (($item >> $i) & 1);
            }
        }
        $ans = 0;
        for ($i = 0; $i < 64; $i++) {
            if ($t[$i] % $m != 0) {
                // 只需要将1左移
                $ans |= (1 << $i);
            }
        }
        return $ans;
    }
    /**
     * 生成随机数组
     *
     */
    public static function randomArray($range, $diffNums, $k, $m)
    {
        $res = [];
        $map = [];
        // 1.生成kingNum
        // 2.数组前k项为kingNum
        // 3.循环 diffNum - 1 次，每次生成一个随机数（必须要唯一）
        // 4.拼装到arr中返回

        // kingNum也要放到map中
        $kingNum = random_int(-$range, $range);
        $map[$kingNum] = true;
        for ($i=0; $i<$k; $i++) {
            $res[] = $kingNum;
        }
        for ($i=0; $i<$diffNums - 1; $i++) {
            do {
                $randNum = random_int(-$range, $range);
            }while(isset($map[$randNum]));
            $map[$randNum] = true;
            for ($j=0; $j<$m; $j++) {
                $res[] = $randNum;
            }
        }

        for ($i =0; $i < count($res); $i++) {
            $j = random_int(0, count($res) - 1);
//            $tmp = $res[$i];
//            $res[$i] = $res[$j];
//            $res[$j] = $tmp;
            // 这里不能直接用异或来交换，因为两个值可能相等
            if ($res[$i] != $res[$j]) {
                $res[$i] = $res[$i] ^ $res[$j];
                $res[$j] = $res[$i] ^ $res[$j];
                $res[$i] = $res[$i] ^ $res[$j];
            }
        }
        return $res;
    }

    public function test()
    {
        $testTimes = 10000;
        $range = 100;
        $diffMaxNums = 10;

        var_dump('开始执行-----');
        for ($i = 0; $i < $testTimes; $i++) {
            // 不同的数的个数
            $diffNums = random_int(1, $diffMaxNums) + 1;
            do {
                $k = random_int(1, 10);
                $m = random_int(1, 10);
            } while ($k >= $m);
            $arr = $this->randomArray($range, $diffNums, $k, $m);
            $res1 = $this->findK1($arr, $k, $m);
            $res2 = $this->findK2($arr, $k, $m);
            if ($res1 != $res2) {
                var_dump('出错了');
                var_dump($arr, $k, $m, $res1, $res2);die;
            }
        }

        var_dump('执行结束');
    }


}

//$obj = new FindK;
//$obj->test();