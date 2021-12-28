<?php

class Node
{
    public $data;
    public function __construct($data)
    {
        $this->data = $data;
    }
}

class ArrayToQueue
{
    public $data = [];
    public $head = -1;
    public $tail = -1;
    public $size = 0;
    public $maxLen = 7;

    public function add($value)
    {
        if ($this->size == $this->maxLen) {
            throw new \Exception('队列满了，放不下了');
        }
        if ($this->head == -1) {
            $this->head = 0;
        }
        $this->tail = ($this->tail + 1 + $this->maxLen) % $this->maxLen;
//        $node = new Node($value);
        $this->data[$this->tail] = $value;
        $this->size++;
    }

    public function poll()
    {
        if ($this->size == 0) {
            throw new \Exception('队列空了');
        }
        $value = $this->data[$this->head];
        $this->head = ($this->head + 1 + $this->maxLen) % $this->maxLen;
        $this->size--;
        return $value;
    }
}
//
//// 打印双链表
//$dl = new ArrayToQueue();
//$dl->push(10);
//$dl->push(12);
//$dl->push(8);
//$dl->push(7);
//$dl->push(10);
//$dl->push(13);
//
//for ($i = 0; $i < 4; $i++) {
//    $t = $dl->pop();
//    var_dump($t->data);
//}
//
//
//$dl->push(80);
//$dl->push(70);
//
//for ($i = 0; $i < 10; $i++) {
//    $t = $dl->pop();
//    var_dump($t->data);
//}
//
