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

// 双向链表实现队列
class DoubleLinkToQueue
{
    public $head;
    public $tail;

    /**
     * 放入元素
     */
    public function push($value)
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
     * 弹出元素
     * 从头部出
     */
    public function pop()
    {
        if (($this->head == null) && ($this->tail == null)) {
            throw new \Exception('队列已经空了');
        }
        $node = $this->head;
        !empty($this->head->next) && $this->head->next->prev = null;
        $this->head = $this->head->next;
        if ($this->head == null) {
            $this->tail = null;
        }
        return $node->data;
    }
}

// 打印双链表
$dl = new DoubleLinkToQueue();
$dl->push(10);
$dl->push(12);
$dl->push(8);
$dl->push(7);
$dl->push(10);

for ($i = 0; $i < 10; $i++) {
    $t = $dl->pop();
    var_dump($t);
}