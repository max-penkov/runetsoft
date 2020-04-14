<?php

declare(strict_types=1);

namespace App\UseCases\Product;

/**
 * Class Parser
 * @package App\UseCases\Product
 */
class Parser
{
    /**
     * @var string
     */
    public $name;
    /**
     * @var string
     */
    public $pattern;
    /**
     * @var array
     */
    public $tokens;

    public function __construct(string $name, string $pattern, array $tokens = [])
    {
        $this->name    = $name;
        $this->pattern = $pattern;
        $this->tokens  = $tokens;
    }
}
