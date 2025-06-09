<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Modules\LabTest\Infrastructure\EloquentModels\LabTest;
use Modules\LabTest\Infrastructure\EloquentModels\LabTestCategory;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        LabTestCategory::factory()
            ->count(5)
            ->has(LabTest::factory()->count(10), 'labTests')
            ->create();
    }
}
