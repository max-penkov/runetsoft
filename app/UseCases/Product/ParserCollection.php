<?php

declare(strict_types=1);

namespace App\UseCases\Product;

/**
 * Class ParserCollection
 * @package App\UseCases\Product
 */
class ParserCollection
{
    private $collections = [];

    /**
     * ParserCollection constructor.
     *
     * @param string $name
     * @param string $pattern
     * @param array  $tokens
     */
    public function add(string $name, string $pattern, array $tokens = [])
    {
        $this->collections[] = new Parser($name, $pattern, $tokens);
    }

    /**
     * @return array
     */
    public function getCollections(): array
    {
        return $this->collections;
    }
}
