<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class PageSite extends Facade
{
    protected static function getFacadeAccessor() {
        return 'mainPage';
    }

}