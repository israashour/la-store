<?php

namespace App\Models;

use App\Traits\Funcs;
use App\Traits\Scopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory, Funcs, Scopes;

    public function products()
    {
        return $this->hasMany(Product::class, 'store_id', 'id');
    }
}
