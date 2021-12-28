<?php

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

/**
 * 给定一个比较值，将链表按照小中大3块 组合
 * Class SmallEqualLarge
 */
class SmallEqualLarge
{
    public function get($head, int $value)
    {
        $lH = null;
        $lT = null;
        $eH = null;
        $eT = null;
        $bH = null;
        $bT = null;

        $cur = $head;
        while ($cur) {
            $next = $cur->next;
            $cur->next = null;
            if ($cur->data < $value) {
                if (!$lH) {
                   $lH = $cur;
                   $lT = $cur;
                } else {
                    $lT->next = $cur;
                    $lT = $lT->next;
                }
            } else if ($cur->data == $value) {
                if (!$eH) {
                    $eH = $cur;
                    $eT = $cur;
                } else {
                    $eT->next = $cur;
                    $eT = $eT->next;
                }
            } else {
                if (!$bH) {
                    $bH = $cur;
                    $bT = $cur;
                } else {
                    $bT->next = $cur;
                    $bT = $bT->next;
                }
            }

            $cur = $next;
        }

        // 组装节点
        $newHead = null;
        $newTail = null;
        if ($lH) {
            $newHead = $lH;
            $newTail = $lT;
        }

        if ($eH) {
            if (!$newHead) {
                $newHead = $eH;
                $newTail = $eT;
            } else {
                $newTail->next = $eH;
                $newTail = $eT;
            }
        }

        if ($bH) {
            if (!$newHead) {
                $newHead = $bH;
            } else {
                $newTail->next = $bH;
            }
        }
        return $newHead;
    }

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

    public function printLinkTable($head)
    {
        $msg = '';
        while ($head) {
            $msg .= ' |  ' . $head->data;
            $head = $head->next;
        }
        var_dump($msg);
    }
}

require('../utils/Utils.php');

$arr = Utils::randomArray(5);
$link = new SmallEqualLarge();
$arr[] = 50;
$head = $link->create($arr);
$link->printLinkTable($head);
$newHead = $link->get($head, 50);

// 打印链表值
$link->printLinkTable($newHead);

