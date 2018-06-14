<?php

namespace CohRNG;

class Generator
{
    const DEFAULT_DELIMITER = '-';

    protected $adjectivesTypes = [];
    protected $noun;
    protected $delimiter;

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