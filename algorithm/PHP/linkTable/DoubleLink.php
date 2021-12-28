<?php

class Node
{
    public $data;
    public $prev = null;
    public $next = null;

    public function __construct($data)
    {
        $this->data = $data;
    }
}

// 双链表
class DoubleLink
{
    public $head;
    public $tail;


    // 给一个数组，实现双链表
    public function add($value)
    {
        $node = new Node($value);
        $node->prev = $this->tail;
        if (empty($this->tail)) {
            $this->head = $node;
        } else {
            $this->tail->next = $node;
        }
        $this->tail = $node;
    }

    /**
     * 从头打印链表
     */
    public function popNodeFromHead()
    {
        $cur = $this->head;
        while ($cur) {
            var_dump($cur->data);
            $cur = $cur->next;
        }
    }

    /**
     * 从头打印链表
     */
    public function popNodeFromTail()
    {
        $cur = $this->tail;
        while ($cur) {
            var_dump($cur->data);
            $cur = $cur->prev;
        }
    }
}

// 打印双链表
$dl = new DoubleLink();
$dl->add(10);
$dl->add(12);
$dl->add(8);
$dl->add(7);
$dl->add(10);

$dl->popNodeFromTail();
