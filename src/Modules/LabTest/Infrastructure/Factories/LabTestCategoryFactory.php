<?php

declare(strict_types=1);

namespace Modules\LabTest\Infrastructure\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Common\Infrastructure\EloquentModels\LangSet;
use Modules\LabTest\Infrastructure\EloquentModels\LabTest;
use Modules\LabTest\Infrastructure\EloquentModels\LabTestCategory;

class LabTestCategoryFactory extends Factory
{
    protected $model = LabTestCategory::class;

    public function definition(): array
    {
        return [
            'name_lang_set_id' => LangSet::factory()->withLangs(),
            'public' => true,
            'deleted' => false,
            'ord' => $this->faker->numberBetween(1, 100),
        ];
    }
}
