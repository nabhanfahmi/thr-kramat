<?php

namespace App\Helpers;

use Midtrans\Config;

class MidtransHelper
{
    public static function configure()
    {
        Config::$serverKey = config('services.midtrans.serverKey');
        Config::$clientKey = config('services.midtrans.clientKey');
        Config::$isProduction = config('services.midtrans.isProduction'); // false untuk sandbox
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }
}
