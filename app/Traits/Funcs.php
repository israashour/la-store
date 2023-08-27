<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait Funcs
{
    public function getImageUrlAttribute()
    {
        if (!$this->image) {
            return 'https://www.ehabra.com/storage/images/documents/_res/wrh/def_product.png';
        }
        if (Str::startsWith($this->image, ['http://', 'https://'])) {
            return $this->image;
        }
        return asset('storage/' . $this->image);
    }
}
