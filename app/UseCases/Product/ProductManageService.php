<?php

declare(strict_types=1);

namespace App\UseCases\Product;

use App\Product;
use App\Repository\Interfaces\ProductRepositoryInterface;
use App\UseCases\Product\DTO\ParseResult;

/**
 * Class ProductManageService
 * @package App\UseCases\Product
 */
class ProductManageService
{
    /**
     * @var ProductRepositoryInterface
     */
    private $productRepository;

    /**
     * ProductManageService constructor.
     *
     * @param ProductRepositoryInterface $productRepository
     */
    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * @param string      $product
     * @param ParseResult $data
     */
    public function saveParsedProducts(string $product, ParseResult $data = null)
    {
        if (isset($data) && $data->validate()) {
            $product = $this->productRepository->firstOrCreate([
                'name'   => $product,
                'status' => Product::IMPORT_SUCCESS,
            ]);
            $product->attributes()->firstOrCreate($data->getAttributes());
        } else {
            $this->productRepository->firstOrCreate(['name' => $product, 'status' => Product::IMPORT_FAILURE]);
        }
    }
}
