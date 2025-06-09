<?php

namespace Modules\Common\Infrastructure\EloquentModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Common\Infrastructure\Factories\LangSetFactory;
use Modules\Common\Infrastructure\Traits\HasUuid;

class LangSet extends Model
{
    use HasUuid, HasFactory;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $table = 'lang_sets';

    protected $fillable = [
        'id'
    ];

    public function langs()
    {
        return $this->hasMany(Lang::class, 'lang_set_id', 'id');
    }

    protected static function newFactory()
    {
        return LangSetFactory::new();
    }
}
