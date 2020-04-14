<?php

declare(strict_types=1);

namespace App\UseCases\Product\Exception;

/**
 * Class CollectionNotMatchedException
 * @package App\UseCases\Product\Exception
 */
class CollectionNotMatchedException extends \LogicException
{
    public const MESSAGE_NOT_FOUND_TYPE = 'Not found collection pattern';
}
