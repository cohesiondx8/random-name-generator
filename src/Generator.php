<?php

namespace CohRNG;

class Generator
{
    const DEFAULT_DELIMITER = '-';

    protected $adjectivesTypes = [];
    protected $noun;
    protected $delimiter;

    /**
     * @param array of $settings with:
     * - `adjectives` with `opinion`, `size`, `color`
     * - `delimiter` as an adjective separator
     * - `noun` only animals for now
     */
    public function __construct(array $settings = [])
    {
        $adjectives = $settings['adjectives'] ?? [];
        if (empty($adjectives) || in_array('opinion', $adjectives)) {
            $this->adjectivesTypes[] = new OpinionAdjective();
        }
        if (empty($adjectives) || in_array('size', $adjectives)) {
            $this->adjectivesTypes[] = new SizeAdjective();
        }
        if (empty($adjectives) || in_array('color', $adjectives)) {
            $this->adjectivesTypes[] = new ColorAdjective();
        }

        if (empty($settings['noun']) || (isset($settings['noun']) && 'animal' === $settings['noun']) ) {
            $this->noun = new AnimalNoun();
        }

        $this->delimiter = $settings['delimiter'] ?? static::DEFAULT_DELIMITER;
    }

    /**
     * @param AbstractList $List
     * @return $this
     */
    public function addAdjectiveType(AbstractList $list)
    {
        $this->adjectivesTypes[] = $list;
        return $this;
    }

    /**
     * @return string
     */
    public function generate()
    {
        $rng = '';
        $delimiter = $this->delimiter;
        foreach ($this->adjectivesTypes as $generator)
        {
            if (!empty($rng)) {
                $rng .= $delimiter;
            }
            $rng .= $generator->getRandomWord();
        }

        if ($this->noun) {
            if (!empty($rng)) {
                $rng .= $delimiter;
            }
            $rng .= $this->noun->getRandomWord();
        }

        return $rng;
    }
}