<?php

declare(strict_types=1);

namespace Modules\Common\Infrastructure\EloquentModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Common\Infrastructure\Factories\LangFactory;
use Modules\Common\Infrastructure\Traits\HasUuid;

class Lang extends Model
{
    use HasUuid, HasFactory;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $table = 'langs';

    protected $fillable = [
        'id',
        'lang_set_id',
        'code',
        'value'
    ];

    protected $casts = [
        'id' => 'string',
        'lang_set_id' => 'string',
    ];

    protected static function newFactory()
    {
        return LangFactory::new();
    }
}
