<?php

class Node
{
    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }
}

/**
 * 用数组实现栈
 */
class ArrayToStack
{
    public $data = [];
    public $tail = -1;

    public function empty()
    {
        return $this->tail == -1;
    }

    public function pop()
    {
        if ($this->tail == -1) {
            throw new \Exception('栈空了');
        }
        $currPos = $this->tail;
        $this->tail--;
        return $this->data[$currPos];
    }

    public function push($value)
    {
//        $node = new Node($value);
        $this->tail++;
        $this->data[$this->tail] = $value;
    }

    public function peek()
    {
        return $this->tail == -1 ? null : $this->data[$this->tail];
    }
}


class MyStack
{
    public $dataStack;
    public $miniStack;

    public function __construct()
    {
        $this->dataStack = new ArrayToStack();
        $this->miniStack = new ArrayToStack();
    }

    public function push($value)
    {
        $this->dataStack->push($value);
        $peekValue = $this->miniStack->peek();
        $this->miniStack->push(is_null($peekValue) ? $value : min($peekValue, $value));
    }

    public function pop()
    {
        $this->miniStack->pop();
        return  $this->dataStack->pop();
    }

    public function peek()
    {
        return $this->dataStack->peek();
    }

    public function getMin()
    {
        return $this->miniStack->peek();
    }
}

// 打印双链表
//$dl = new MyStack();
//$dl->push(10);
//$dl->push(12);
//$dl->push(8);
//$dl->push(7);
//$dl->push(10);
//$dl->push(13);

//while ($dl->peek()) {
//   echo  $dl->miniStack->pop() . PHP_EOL;
//}
//die;
//for ($i = 0; $i < 6; $i++) {
////    $t = $dl->pop();
//    echo ' ', $dl->getMin(), ' ' , $dl->pop() . PHP_EOL;
//}
//die;
//$dl->push(80);
//$dl->push(70);
//
//for ($i = 0; $i < 6; $i++) {
//    $t = $dl->pop();
//    var_dump($t);
//}