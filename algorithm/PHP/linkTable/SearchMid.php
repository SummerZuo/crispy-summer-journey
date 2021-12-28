<?php

/**
 * 寻找链表的中点位置
 * 如果为基数，就为中点值
 * 如果为偶数，则找出第一个中点值
 * Class SearchMid
 */

require('../utils/Utils.php');

class link
{
    public $data;
    public $next;

    public function __construct($data, $next = null)
    {
        $this->data = $data;
        $this->next = $next;
    }
}


class SearchMid
{
    // 生成链表
    public function create(array $arr): link
    {
        $head = null;
        $prevNode = null;
        for ($i = 0; $i < count($arr); $i++) {
            $node = new link($arr[$i]);
            empty($head) && $head = $node;
            if (!empty($prevNode)) {
                $prevNode->next = $node;
            }
            $prevNode = $node;
        }
        return $head;
    }

    public function getPrevMid(link $head)
    {
        // 当链表<=2个元素时，返回头节点
        if ($head == null || $head->next == null || $head->next->next == null) {
            return $head;
        }

        $slow = $head->next;
        $fast = $head->next->next;
        while ($fast->next && $fast->next->next) {
            $slow = $slow->next;
            $fast = $fast->next->next;
        }

        return $slow;
    }

    /**
     * 找上中点的前一个节点
     * @param link $head
     * @return link|null
     */
    public function getBeforePrevMidNode(link $head)
    {
        // 当链表<=2个元素时，返回头节点
        if ($head == null || $head->next == null || $head->next->next == null) {
            return null;
        }

        $slow = $head->next;
        $fast = $head->next->next;
        $prev = $head;
        while ($fast->next && $fast->next->next) {
            $prev = $slow;
            $slow = $slow->next;
            $fast = $fast->next->next;
        }

        return $prev;
    }

    public function getNextMid(link $head)
    {
        // 当链表<=2个元素时，返回头节点
        if ($head == null || $head->next == null || $head->next->next == null) {
            return $head;
        }

        $slow = $head->next;
        $fast = $head->next;
        while ($fast->next && $fast->next->next) {
            $slow = $slow->next;
            $fast = $fast->next->next;
        }

        return $slow;
    }

    public function compare(link $head)
    {
        // 将元素遍历一次，放入到数组容器中
        // 根据下标取出中点元素
        $arr = [];
        while ($head) {
            $arr[] = $head;
            $head = $head->next;
        }
        $mid = ceil((count($arr) - 1) / 2);
        return $arr[$mid];
    }
}

$link = new SearchMid();
$len = 10;
for ($j=0; $j< $len; $j++) {
    $arr[] = $j+1;
}
$head = $link->create($arr);

var_dump('测试开始');
$testTimes = 10000;
for ($i = 0; $i < $testTimes; $i++) {

    $link->getBeforePrevMidNode($head);

    $res1 = $link->getNextMid($head);
    $res2 = $link->compare($head);
    if ($res1 !== $res2) {
        var_dump('出错了');
    }
}

var_dump('测试结束');

