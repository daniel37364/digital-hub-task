<?php

use Modules\Common\Infrastructure\Providers\CommonServiceProvider;
use Modules\LabTest\Infrastructure\Providers\LabTestServiceProvider;

return [
    App\Providers\AppServiceProvider::class,
    App\Providers\RouteServiceProvider::class,
    LabTestServiceProvider::class,
    CommonServiceProvider::class
];
