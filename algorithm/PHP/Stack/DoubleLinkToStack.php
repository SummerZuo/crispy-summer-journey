<?php

/**
 * 双向链表实现栈（先进后出）
 * Class DoubleLinkToStack
 */

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

class DoubleLinkToStack
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
            // 第一个元素 不需要指定tail的next
            $this->head = $node;
        } else {
            $this->tail->next = $node;
        }
        $this->tail = $node;
    }

    /**
     * 弹出元素
     */
    public function pop()
    {
        if ($this->tail == null) {
            throw new \Exception('栈空了');
        }
        $node = $this->tail;
        !empty($this->tail->prev) && $this->tail->prev->next = null;
        $this->tail = $this->tail->prev;
        return $node->data;
    }
}


// 打印双链表
$dl = new DoubleLinkToStack();
$dl->push(10);
$dl->push(12);
$dl->push(8);
$dl->push(7);
$dl->push(10);
$dl->push(13);

for ($i = 0; $i < 10; $i++) {
    $t = $dl->pop();
    var_dump($t);
}