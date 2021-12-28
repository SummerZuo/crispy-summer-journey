<?php

/**
 * 回文链表
 * Class Palindrome
 */
class singleLink
{
    public $data;
    public $next;

    public function __construct($data)
    {
        $this->data = $data;
    }
}

class Palindrome
{
    // 生成链表
    public function create(array $arr)
    {
        $head = null;
        $prevNode = null;
        for ($i = 0; $i < count($arr); $i++) {
            $node = new singleLink($arr[$i]);
            empty($head) && $head = $node;
            if (!empty($prevNode)) {
                $prevNode->next = $node;
            }
            $prevNode = $node;
        }
        return $head;
    }

    /**
     * 是否为回文链表
     */
    public function isPalindrome(singleLink $head): bool
    {
        // 思路：1.找到链表上中点
        // 2.将中点的next指向null
        // 3.将链表后半截指针指向反转
        // 4.依次遍历头节点，与尾节点对应位置进行对比
        if ($head == null || $head->next == null) {
            return true;
        }

        $slow = $head;
        $fast = $head;
        while ($fast->next && $fast->next->next) {
            $slow = $slow->next;
            $fast = $fast->next->next;
        }
        // 最终slow来到上中点
        $prev = null;
        do {
            $next = $slow->next;
            $slow->next = $prev;
            $prev = $slow;
            $slow = $next;
        } while ($slow);

        // prev为最终尾节点
        $isPalindrome = true;
        $start = $head;
        $tail = $prev;
        while ($start) {
            if ($start->data != $prev->data) {
                $isPalindrome = false;
            }
            $start = $start->next;
            $prev = $prev->next;
        }

        // 还原链表
        $prev = null;
        while ($tail) {
            $next = $tail->next;
            $tail->next = $prev;
            $prev = $tail;
            $tail = $next;
        }

        return $isPalindrome;
    }

    public function compare($head): bool
    {
        $stack = new SplStack();
        $start = $head;
        while ($start) {
            $stack->push($start);
            $start = $start->next;
        }

        while ($head) {
            if ($head->data != $stack->pop()->data) {
                return false;
            }
            $head = $head->next;
        }
        return true;
    }
}

$link = new Palindrome();
$arr = [1, 2, 3, 4, 2, 1];
$head = $link->create($arr);

var_dump('测试开始');
$testTimes = 10000;
//for ($i = 0; $i < $testTimes; $i++) {

    $res1 = $link->isPalindrome($head);
    $res2 = $link->compare($head);
    var_dump($res1, $res2);
    if ($res1 !== $res2) {
        var_dump('出错了');
    }
//}

var_dump('测试结束');