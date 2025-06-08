<?php

declare(strict_types=1);

namespace Modules\Common\Infrastructure\Traits;

use Illuminate\Support\Str;

trait HasUuid
{
    protected static function bootHasUuid(): void
    {
        static::creating(function ($model): void {
            if (empty($model->id)) {
                $model->id = (string) Str::uuid();
            }
        });
    }
}
