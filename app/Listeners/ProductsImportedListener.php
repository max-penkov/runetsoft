<?php

namespace App\Listeners;

use App\UseCases\Product\Exception\CollectionNotMatchedException;
use App\UseCases\Product\ProductParserService;
use App\UseCases\Product\ProductReader;
use App\UseCases\Product\ProductManageService;

/**
 * Class ProductsImportedListener
 * @package App\Listeners
 */
class ProductsImportedListener
{
    /**
     * @var ProductParserService
     */
    private $parserService;
    /**
     * @var ProductManageService
     */
    private $productService;
    /**
     * @var ProductReader
     */
    private $reader;

    /**
     * Create the event listener.
     *
     * @param ProductParserService $parserService
     * @param ProductManageService $productService
     * @param ProductReader        $reader
     */
    public function __construct(
        ProductParserService $parserService,
        ProductManageService $productService,
        ProductReader $reader
    ) {
        $this->parserService  = $parserService;
        $this->productService = $productService;
        $this->reader         = $reader;
    }

    /**
     * Handle the event.
     *
     * @param object $event
     *
     * @return void
     */
    public function handle($event)
    {
        $results = $this->reader->iterate($event->getPath());
        foreach ($results as $item) {
            if (empty($item)) {
                continue;
            }
            try {
                $result = $this->parserService->parse($item);
                $this->productService->saveParsedProducts($item, $result);
            } catch (CollectionNotMatchedException $e) {
                $this->productService->saveParsedProducts($item);
            }
        }
    }
}
