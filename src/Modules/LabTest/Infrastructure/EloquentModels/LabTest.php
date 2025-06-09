<?php

declare(strict_types=1);

namespace Modules\LabTest\Infrastructure\EloquentModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Common\Infrastructure\EloquentModels\LangSet;
use Modules\Common\Infrastructure\Traits\HasUuid;
use Modules\LabTest\Infrastructure\EloquentModels\LabTestSynonym;
use Modules\LabTest\Infrastructure\EloquentModels\LabTestCategory;
use Modules\LabTest\Infrastructure\Factories\LabTestFactoryEloquent;

class LabTest extends Model
{
    use HasUuid, HasFactory;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $table = 'lab_tests';

    protected $fillable = [
        'id',
        'code',
        'code_icd',
        'name_lang_set_id',
        'description_lang_set_id',
        'public',
        'deleted',
        'ord'
    ];

    protected $casts = [
        'id' => 'string',
        'code' => 'integer',
        'code_icd' => 'string',
        'name_lang_set_id' => 'string',
        'description_lang_set_id' => 'string',
        'public' => 'boolean',
        'deleted' => 'boolean',
        'ord' => 'integer'
    ];

    public function name()
    {
        return $this->belongsTo(LangSet::class, 'name_lang_set_id');
    }
    public function description()
    {
        return $this->belongsTo(LangSet::class, 'description_lang_set_id');
    }
    public function categories()
    {
        return $this->belongsToMany(LabTestCategory::class, 'lab_test_category_pivot', 'lab_test_id', 'lab_test_category_id');
    }
    public function synonyms()
    {
        return $this->hasMany(LabTestSynonym::class, 'lab_test_id');
    }

    protected static function newFactory()
    {
        return LabTestFactoryEloquent::new();
    }
}
