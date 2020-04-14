<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $guarded = [];
    public const IMPORT_SUCCESS = 1;
    public const IMPORT_FAILURE = 0;

    /**
     * @return HasMany
     */
    public function attributes()
    {
        return $this->hasMany(Attribute::class);
    }
}
