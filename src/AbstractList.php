<?php

namespace CohRNG;

abstract class AbstractList
{
    abstract protected function getList();

    public function getRandomWord()
    {
        $list = $this->getList();
        return $list[array_rand($list)];
    }
}