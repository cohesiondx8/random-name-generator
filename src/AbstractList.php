<?php

namespace CohRNG;

abstract class AbstractList
{
    abstract protected function getList();

    /**
     * @return string
     */
    public function getRandomWord()
    {
        $list = $this->getList();
        return $list[array_rand($list)];
    }
}