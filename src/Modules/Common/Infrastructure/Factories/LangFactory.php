<?php

declare(strict_types=1);

namespace Modules\Common\Infrastructure\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Common\Infrastructure\EloquentModels\Lang;
use Modules\Common\Infrastructure\EloquentModels\LangSet;

class LangFactory extends Factory
{
    protected $model = Lang::class;

    public function definition(): array
    {
        return [
            'value' => $this->faker->word,
            'code' =>  $this->faker->unique()->lexify('??'),
            'lang_set_id' => LangSet::factory(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
