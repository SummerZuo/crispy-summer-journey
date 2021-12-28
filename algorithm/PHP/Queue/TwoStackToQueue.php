<?php

require('../Stack/ArrayToStack.php');

/**
 *用栈来实现队列
 */
class TwoStackToQueue
{
    public $pushStack;

    public $popStack;

    public function __construct()
    {
        $this->pushStack = new ArrayToStack();
        $this->popStack = new ArrayToStack();
    }

    /**
     *将push栈的元素倒到pop栈
     * 原则1：push栈不能为空
     * 原则2：pop栈为空
     */
    private function pushToPop()
    {
        while ($this->popStack->empty()) {
            while (!$this->pushStack->empty()) {
                $this->popStack->push($this->pushStack->pop());
            }
        }
    }

    public function add($value)
    {
        $this->pushStack->push($value);
        $this->pushToPop();
    }

    public function poll()
    {
        // 从popStack中拿元素
        if ($this->pushStack->empty() && $this->popStack->empty()) {
            throw new \Exception('没有元素可拿了');
        }
        $this->pushToPop();
        return $this->popStack->pop();
    }
}

$queue = new TwoStackToQueue();
$queue->add(10);
$queue->add(11);
$queue->add(12);
$queue->add(13);
$queue->add(14);
$queue->add(15);


for ($i =0; $i< 5; $i++) {
    echo $queue->poll() . PHP_EOL;
}

var_dump('准备+元素了');

$queue->add(16);
$queue->add(17);
$queue->add(18);



for ($i =0; $i< 10; $i++) {
    echo $queue->poll() . PHP_EOL;
}
