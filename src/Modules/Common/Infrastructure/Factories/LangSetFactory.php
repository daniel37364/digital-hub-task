<?php

declare(strict_types=1);

namespace Modules\Common\Infrastructure\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Common\Infrastructure\EloquentModels\Lang;
use Modules\Common\Infrastructure\EloquentModels\LangSet;

class LangSetFactory extends Factory
{
    protected $model = LangSet::class;

    public function definition(): array
    {
        return [
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    public function withLangs(int $count = 3)
    {
        return $this->has(Lang::factory()->count($count), 'langs');
    }
}
