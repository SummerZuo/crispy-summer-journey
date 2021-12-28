<?php

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

// 比较器
class Comparetor extends SplHeap
{
    // 结果>0,则第一个数排前面
    // 结果<0,则第二个数排前面

    // 按年龄倒序排
    public function compare($value1, $value2)
    {
        throw new \Exception('aaaaaaddd');
        return $value1->age - $value2->age;
    }

    public function __destruct()
    {
        // TODO: Implement __destruct() method.
    }
}



register_shutdown_function(function () {
    var_dump(123);
});

register_shutdown_function(function () {
    var_dump(1234444);
});
$s1 = new Student(1, 20, 'A');
$s2 = new Student(2, 24, 'B');
$s3 = new Student(3, 22, 'C');
$s4 = new Student(4, 27, 'D');

$c = new Comparetor();
$c->insert($s1);
$c->insert($s2);
$c->insert($s3);
$c->insert($s4);
$s1->name= 'E';
foreach ($c as $item) {
    var_dump($item->name . ',' . $item->id . ',' . $item->age);
}