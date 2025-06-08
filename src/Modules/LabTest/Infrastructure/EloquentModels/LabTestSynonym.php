<?php

declare(strict_types=1);

namespace Modules\LabTest\Infrastructure\EloquentModels;

use Illuminate\Database\Eloquent\Model;

class LabTestSynonym extends Model
{
    public $incrementing = false;
    protected $keyType = 'string';

    protected $table = 'lab_test_synonyms';

    protected $fillable = [
        'id',
        'lab_test_id',
        'synonym_id'
    ];

    protected $casts = [
        'id' => 'string',
        'lab_test_id' => 'string',
        'synonym_id' => 'string',
    ];
}
