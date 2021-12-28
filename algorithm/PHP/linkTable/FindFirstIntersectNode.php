<?php

/**
 * 找两个单链表的相交节点
 * Class FindFirstIntersectNode
 */
class FindFirstIntersectNode
{
    public function get($head1, $head2)
    {
        // 1.若head1、head2都无环
        $loop1 = $this->getEntryLoopNode($head1);
        $loop2 = $this->getEntryLoopNode($head2);

        // 1.两个无环节点相交问题
        if ($loop1 == null && $loop2 == null) {
            return $this->noLoop($head1, $head2);
        } else if ($loop1 != null && $loop2 != null) {
            return $this->bothLoop($head1, $loop1, $head2, $loop2);
        }

        return null;
    }

    public function getEntryLoopNode($head)
    {
        if ($head == null || $head->next == null || $head->next->next == null) {
            return null;
        }
        $fast = $head;
        $slow = $head;
        while ($fast->next && $fast->next->next) {
            $slow = $slow->next;
            $fast = $fast->next->next;
            // 若快、慢指针相交，则有环
            if ($slow == $fast) {
                $fast = $head;
                while ($fast != $slow) {
                    $fast = $fast->next;
                    $slow = $slow->next;
                }
                return $fast;
            }
        }
        return null;
    }

    private function noLoop($head1, $head2)
    {
        $l1 = $head1;
        $l2 = $head2;
        $n = 0;
        while ($l1->next) {
            $n++;
            $l1 = $l1->next;
        }

        while ($l2->next) {
            $n--;
            $l2 = $l2->next;
        }

        // 如果走到最后，两个链表相遇了
        if ($l1 === $l2) {
            $l1 = $n > 0 ? $head1 : $head2;
            $l2 = $l1 === $head1 ? $head2 : $head1;
            $n = abs($n);
            // 让l1先走n步
            while ($l1 !== $l2) {
                if ($n <= 0) {
                    $l2 = $l2->next;
                }
                $n--;
                $l1 = $l1->next;
            }
            return $l1;
        }
        return null;
    }

    private function bothLoop($head1, $loop1, $head2, $loop2)
    {
        if ($loop1 === $loop2) {
            $l1 = $head1;
            $l2 = $head2;
            $n = 0;
            while ($l1 !== $loop1) {
                $n++;
                $l1 = $l1->next;
            }
            while ($l2 !== $loop2) {
                $n--;
                $l2 = $l2->next;
            }
            $l1 = $n > 0 ? $head1 : $head2;
            $l2 = $l1 === $head1 ? $head2 : $head1;
            $n = abs($n);
            while ($l1 !== $l2) {
                if ($n <= 0) {
                    $l2 = $l2->next;
                }
                $n--;
                $l1 = $l1->next;
            }
            return $l1;
        }
        $l1 = $loop1->next;
        while ($l1 !== $loop1) {
            if ($l1 === $loop2) {
                return $l1;
            }
            $l1 = $l1->next;
        }
        return null;
    }
}

class Node
{
    public $data;
    public $next = null;
    public function __construct($data)
    {
        $this->data = $data;
    }
}

$n1 = new Node(1);
$n2 = new Node(2);
$n3 = new Node(3);
$n4 = new Node(4);
$n5 = new Node(5);
$n6 = new Node(6);
$n7 = new Node(7);
$n8 = new Node(8);
$n9 = new Node(9);
$n10 = new Node(10);


$n1->next = $n2;
$n2->next = $n3;
$n3->next = $n4;
$n4->next = $n5;
$n5->next = $n10;
$n10->next = $n2;

$head1= $n1;

$head2 = $n6;
$n6->next = $n7;
$n7->next = $n8;
$n8->next = $n5;
//$n9->next = $n3;

$obj = new FindFirstIntersectNode();
$res = $obj->get($head1, $head2);
var_dump($res);