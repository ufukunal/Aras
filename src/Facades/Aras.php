<?php

namespace KS\Aras\Facades;

use Illuminate\Support\Facades\Facade;


class Aras extends Facade
{

  protected static function getFacadeAccessor() { return 'aras'; }
}
