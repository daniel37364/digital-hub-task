<?php

declare(strict_types=1);

namespace Modules\LabTest\Infrastructure\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Common\Infrastructure\EloquentModels\LangSet;
use Modules\LabTest\Infrastructure\EloquentModels\LabTest;
use Modules\Common\Infrastructure\Factories\LangSetFactory;
use Modules\LabTest\Infrastructure\EloquentModels\LabTestCategory;
use Modules\LabTest\Infrastructure\Factories\LabTestCategoryFactory;

class LabTestFactoryEloquent extends Factory
{
    protected $model = LabTest::class;

    public function definition(): array
    {
        return [
            'code' => $this->faker->unique()->randomNumber(),
            'code_icd' => $this->faker->unique()->bothify(),
            'name_lang_set_id' => LangSet::factory()->withLangs(),
            'description_lang_set_id' => LangSet::factory()->withLangs(),
            'public' => true,
            'deleted' => false,
            'ord' => $this->faker->numberBetween(1, 100),
        ];
    }
}
