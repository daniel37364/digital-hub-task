<?php

declare(strict_types=1);

namespace Modules\LabTest\Infrastructure\EloquentModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Common\Infrastructure\EloquentModels\LangSet;
use Modules\Common\Infrastructure\Traits\HasUuid;
use Modules\LabTest\Infrastructure\Factories\LabTestCategoryFactory;

class LabTestCategory extends Model
{
    use HasUuid, HasFactory;
    public $incrementing = false;
    protected $keyType = 'string';

    protected $table = 'lab_test_categories';

    protected $fillable = [
        'id',
        'name_lang_set_id',
        'public',
        'deleted',
        'ord'
    ];

    protected $casts = [
        'id' => 'string',
        'name_lang_set_id' => 'string',
        'public' => 'boolean',
        'deleted' => 'boolean',
        'ord' => 'integer'
    ];

    public function name()
    {
        return $this->belongsTo(LangSet::class, 'name_lang_set_id');
    }

    public function labTests()
    {
        return $this->belongsToMany(LabTest::class, 'lab_test_category_pivot', 'lab_test_category_id', 'lab_test_id');
    }

    protected static function newFactory()
    {
        return LabTestCategoryFactory::new();
    }
}
