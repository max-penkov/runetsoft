<?php

declare(strict_types=1);

namespace App\UseCases\Product;

use Generator;
use SplFileObject;

/**
 * Class ProductReader
 * @package App\UseCases\Product
 */
class ProductReader
{
    /**
     * @param        $path
     * @param string $mode
     *
     * @return Generator|int
     */
    public function iterate($path, $mode = 'r')
    {
        $file  = new SplFileObject(storage_path('app/public/' . $path), $mode);
        $count = 0;
        while (!$file->eof()) {
            yield $file->fgets();
            $count++;
        }
        return $count;
    }
}
