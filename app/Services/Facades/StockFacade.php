<?php
namespace App\Services\Facades;

use Illuminate\Support\Facades\Facade;

class StockFacade extends Facade {
    protected static function getFacadeAccessor()
    {
        return 'StockService';
    }

}
