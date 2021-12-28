<?php

error_reporting(E_ERROR);
class singleLink
{
    public $data;
    public $next;

//    public function __construct($data, $next)
//    {
//        $this->data = $data;
//        $this->next = $next;
//    }
}


function reverseSingleLink($head)
{
    $prev = null;
    $cur = $head;
    $next = $cur->next;

    do {
        $cur->next = $prev;
        $prev = $cur;
        $cur = $next;
        $next = $cur->next;
    }while($cur);
    return $prev;
}

function printSingleLink($head)
{
    do {
        var_dump($head->data);
        $head = $head->next;
    } while ($head);
}

// 1.拼接一个单链表
$length = 3;
$oldObj = null;
$preObj = null;
for ($i = 0; $i < $length; $i++) {
    $random = random_int(1, 100);
    $obj = new singleLink();
    $obj->data = $random;
    $obj->next = null;
    empty($preObj) && $preObj = $obj;
    if (!empty($oldObj)) {
        $oldObj->next = $obj;
    }
    $oldObj = $obj;
}

printSingleLink($preObj);
// 链表的倒置
$newHead = reverseSingleLink($preObj);
var_dump('-------');
printSingleLink($newHead);