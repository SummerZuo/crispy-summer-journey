<?php

/**
 * 加强堆
 * 需要实现哪些功能：
 * 堆中如果存储了一个对象类型的数据，当把这个对象插入堆之后（在堆中已经变有序），若此时更改对象的排序属性，如何快速将堆变有序
 * 思路：
 * 记录一个反向索引表：方便我们根据对象很快能找到其在堆中对应的位置，然后再进行heapInsert或heapify操作
 * Class HeapGreater
 */
class HeapGreater
{
    // 堆数据存储
    /** @var array 堆保存结果 */
    public $arr = [];

    /** @var int 堆大小 */
    public $heapSize = 0;

    // 反向索引
    public $hashMap = [];

    /** @var callable 比较方法(对象的比较方法，需要由外部传入) */
    public $comparetor;

    public function __construct(callable $comparetor)
    {
        $this->comparetor = $comparetor;
    }

    public function getHashCode($obj)
    {
        return spl_object_id($obj);
    }

    public function setHashMap($obj, $v)
    {
        $objId = $this->getHashCode($obj);
        $this->hashMap[$objId] = $v;
    }

    public function compare($s1, $s2)
    {
        return call_user_func_array($this->comparetor, [$s1, $s2]);
    }

    /**
     * Extracts a node from top of the heap and sift up.
     * @return mixed The value of the extracted node.
     */
    public function extract()
    {
        $ans = $this->arr[0];
        $this->swap(0, $this->heapSize - 1);
        $this->setHashMap($ans, null);
        $this->heapify(0, --$this->heapSize);
        return $ans;
    }

    /**
     * Inserts an element in the heap by sifting it up.
     * @param mixed $value <p>
     * @return void
     */
    public function insert($value)
    {
        $this->arr[$this->heapSize] = $value;
        $this->heapInsert($this->heapSize);
        $this->setHashMap($value, $this->heapSize++);
    }

    /**
     * Peeks at the node from the top of the heap
     * @return mixed The value of the node on the top.
     */
    public function top()
    {
        return $this->arr[0];
    }

    /**
     * Counts the number of elements in the heap.
     * @return int the number of elements in the heap.
     */
    public function count()
    {
        return $this->heapSize;
    }

    /**
     * Checks whether the heap is empty.
     * @return bool whether the heap is empty.
     */
    public function isEmpty()
    {
        return $this->heapSize == 0;
    }

    public function resign($value)
    {
        // 1. 找到value对应的hashMap
        $hashId = $this->getHashCode($value);
        $arrKey = $this->hashMap[$hashId];
        $this->heapInsert($arrKey);
        $this->heapify($arrKey, $this->heapSize);
    }

    protected function heapInsert($i)
    {
        while ($this->compare($this->arr[$i], $this->arr[($i - 1) / 2])) {
            $this->swap($i, ($i - 1) / 2);
            $i = ($i - 1) / 2;
        }
    }

    protected function heapify($i, $size)
    {
        $left = $i * 2 + 1;

        while ($left < $size) {
            // 找出最大子节点的下标
            $largest = ($left + 1 < $size) && $this->compare($this->arr[$left + 1], $this->arr[$left])
                ? ($left + 1) : $left;

            if (!$this->compare($this->arr[$largest], $this->arr[$i])) {
                break;
            }
            $this->swap($i, $largest);
            $i = $largest;
            $left = $i * 2 + 1;
        }
    }

    /**
     * 不止要交换arr，也要交换hashMap
     * @param $i
     * @param $j
     */
    protected function swap($i, $j)
    {
        $o1 = $this->arr[$i];
        $o2 = $this->arr[$j];

        $this->arr[$i] = $o2;
        $this->arr[$j] = $o1;

        $this->setHashMap($o2, $i);
        $this->setHashMap($o1, $j);
    }

    /**
     * 删除节点
     * @param $obj
     */
    public function remove($obj)
    {

    }
}

class Student
{
    public $id;
    public $age;
    public $name;
    public function __construct($id, $age, $name)
    {
        $this->id = $id;
        $this->age = $age;
        $this->name = $name;
    }
}

$c = new HeapGreater(function (Student $s1, $s2) {
    return ($s1->age - $s2->age) > 0;
});


$s1 = new Student(1, 20, 'A');
$s2 = new Student(2, 24, 'B');
$s3 = new Student(3, 22, 'C');
$s4 = new Student(4, 27, 'D');

$c->insert($s1);
$c->insert($s2);
$c->insert($s3);
$c->insert($s4);

$s1->age = 40;
$c->resign($s1);
while(!$c->isEmpty()) {
   var_dump($c->extract());
}