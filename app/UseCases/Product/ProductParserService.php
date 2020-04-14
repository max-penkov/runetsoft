<?php

declare(strict_types=1);

namespace App\UseCases\Product;

use App\UseCases\Product\DTO\ParseResult;
use App\UseCases\Product\Exception\CollectionNotMatchedException;

/**
 * Class ProductParserService
 * @package App\Services
 */
class ProductParserService
{
    /**
     * @var ParserCollection
     */
    private $collection;

    public function __construct(ParserCollection $collection)
    {
        $this->collection = $collection;
    }

    /**
     * @param $product
     *
     * @return ParseResult
     */
    public function parse($product)
    {
        $pattern = '';
        foreach ($this->collection->getCollections() as $collection) {
            $pattern .= preg_replace_callback('~\{([^\}]+)\}~', function ($matches) use ($collection) {
                $argument = $matches[1];
                $replace  = $collection->tokens[$argument] ?? '[^}]+';
                return '(?P<' . $argument . '>' . $replace . ')';
            }, $collection->pattern);
        }

        if (preg_match('~' . $pattern . '~i', $product, $matches)) {
            return new ParseResult(
                array_filter($matches, '\is_string', ARRAY_FILTER_USE_KEY)
            );
        }

        throw new CollectionNotMatchedException(CollectionNotMatchedException::MESSAGE_NOT_FOUND_TYPE);
    }
}
