<?php

declare(strict_types=1);

namespace Modules\Common\Infrastructure\EloquentModels;

use Illuminate\Database\Eloquent\Model;
use Modules\Common\Infrastructure\EloquentModels\LangSet;

class Synonym extends Model
{
    public $incrementing = false;
    protected $keyType = 'string';

    protected $table = 'synonyms';

    protected $fillable = [
        'id',
        'name_lang_set_id'
    ];

    protected $casts = [
        'id' => 'string',
        'name_lang_set_id' => 'string',
    ];

    public function name()
    {
        return $this->belongsTo(LangSet::class, 'name_lang_set_id');
    }
}
