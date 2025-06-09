<?php

declare(strict_types=1);

namespace Modules\LabTest\Infrastructure\EloquentModels;

use Illuminate\Database\Eloquent\Model;
use Modules\Common\Infrastructure\EloquentModels\Synonym;

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

    public function labTest()
    {
        return $this->belongsToMany(LabTest::class, 'lab_test_id');
    }

    public function synonym()
    {
        return $this->belongsTo(Synonym::class, 'synonym_id');
    }
}
