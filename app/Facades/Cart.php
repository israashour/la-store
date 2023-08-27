<?php

namespace App\Facades;

use App\Repositories\Cart\CartRepository;
use Illuminate\Support\Facades\Facade as FacadesFacade;

class Cart extends FacadesFacade
{
    protected static function getFacadeAccessor()
    {
        return CartRepository::class;
    }
}
