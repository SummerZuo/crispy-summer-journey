<?php

require('../Queue/ArrayToQueue.php');

/**
 *用两个队列 A，B
 *输入元素时，输入A中
 *输出时，将A中n-1项写入到B中，弹出A中元素，并将A, B名称互换
 */
class TwoQueueToStack
{
    public $queueOne;

    public $queueTwo;

//    public $writeQueue;
//
//    public $readQueue;

    public function __construct()
    {
        $this->queueOne = new ArrayToQueue();
        $this->queueTwo = new ArrayToQueue();
//        $this->writeQueue = $this->queueOne;
//        $this->readQueue
    }

    public function push($value)
    {
        // 只能往有元素的队列写
        $this->queueOne->add($value);
    }

    public function pop()
    {
        // 将queueOne的数据倒入到queueTwo中
        // 最后将queueOne与queueTwo互换
        if (empty($this->queueOne)) {
            throw new \Exception('队列已经空了');
        }
        while ($this->queueOne->size > 1) {
            $this->queueTwo->add($this->queueOne->poll());
        }
        $tmp = $this->queueOne;
        $this->queueOne = $this->queueTwo;
        $this->queueTwo = $tmp;
        return $this->queueTwo->poll();
    }
}

$stack = new TwoQueueToStack();
$stack->push(10);
$stack->push(11);
$stack->push(12);
$stack->push(13);
$stack->push(14);
$stack->push(15);

for ($i=0; $i< 2; $i++) {
    echo $stack->pop() . PHP_EOL;
}

$stack->push(16);
$stack->push(17);


echo $stack->pop() . PHP_EOL;
echo $stack->pop() . PHP_EOL;
echo $stack->pop() . PHP_EOL;

$stack->push(18);
$stack->push(19);


for ($i=0; $i< 10; $i++) {
    echo $stack->pop() . PHP_EOL;
}
