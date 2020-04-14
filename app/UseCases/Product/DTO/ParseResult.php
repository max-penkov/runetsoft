<?php

declare(strict_types=1);

namespace App\UseCases\Product\DTO;

use Illuminate\Support\Facades\Validator;

/**
 * Class ParseResult
 * @package App\UseCases\Product\DTO
 */
class ParseResult
{
    /**
     * @var array
     */
    private $attributes;

    public function __construct(array $attributes = [])
    {
        $this->attributes = $attributes;
    }

    /**
     * @return array
     */
    public function getAttributes(): array
    {
        return $this->attributes;
    }

    /**
     * @return bool|\Illuminate\Contracts\Validation\Validator
     */
    public function validate()
    {
        $validator = Validator::make($this->attributes, [
            'brand'     => 'required|string|max:50',
            'model'     => 'required|string|max:255',
            'width'     => 'required|integer',
            'height'    => 'required|integer',
            'construct' => 'required|string|max:1, 10',
            'diameter'  => 'required|integer',
            'loadIdx'   => 'required|integer',
            'speedIdx'  => 'required|string|max:1,10',
        ]);

        if ($validator->fails()) {
            return $validator;
        }

        return true;
    }
}
