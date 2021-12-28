<?php

class Node
{
    public $pass = 0;
    public $end = 0;
    public $next = [];

    public function __construct($pass = 0, $end = 0)
    {
        $this->pass = $pass;
        $this->end = $end;
        $this->next = null;
    }
}

class Trie
{
    public $rootNode;

    public function __construct()
    {
        $this->rootNode = new Node();
    }

    public function insert($str)
    {
        if (empty($str)) {
            return ;
        }

        $prevNode = $this->rootNode;
        $prevNode->pass++;
        for ($i=0; $i<strlen($str); $i++) {
            $chrInt = ord($str[$i]) - ord('a');
            if (!isset($prevNode->next[$chrInt])) {
                $node = new Node();
                $prevNode->next[$chrInt] = $node;
            }
            // 往下沉一层
            $prevNode = $prevNode->next[$chrInt];
            $prevNode->pass++;
        }
        $prevNode->end++;
    }

    public function search($str): bool
    {
        if (empty($str)) {
            return false;
        }


        $prevNode = $this->rootNode;
        for ($i=0; $i<strlen($str); $i++) {
            $chrInt = ord($str[$i]) - ord('a');
            if (!isset($prevNode->next[$chrInt])) {
                return false;
            }
            $prevNode = $prevNode->next[$chrInt];
        }
        return true;
    }

    public function delete($str)
    {
        if (empty($str)) {
            return ;
        }

        if ($this->search($str)) {

        }
    }
}

$t = new Trie();
$t->insert('hello');
$t->insert('heaa');
$t->insert('abc');
var_dump($t->search('ac'));
var_dump($t->search('abc'));
var_dump($t->search('hella'));
var_dump($t->search('hello'));
var_dump($t->search('hellocc'));
