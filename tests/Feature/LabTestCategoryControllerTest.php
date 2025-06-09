<?php

declare(strict_types=1);

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\LabTest\Infrastructure\EloquentModels\LabTest;
use Modules\LabTest\Infrastructure\EloquentModels\LabTestCategory;

class LabTestCategoryControllerTest extends TestCase
{
    use RefreshDatabase;

    private $labTestCategoryStructure = [
        'id',
        'name',
        'ord',
        'lab_tests' => [
            '*' => [
                'id',
                'code',
                'code_icd',
                'name',
                'description',
                'ord',
            ],
        ],
    ];

    public function testIndex(): void
    {
        $labTestCategory = LabTestCategory::factory()->create();
        $labTest = LabTest::factory()->create();
        $labTestCategory->labTests()->attach($labTest->id);

        $response = $this->getJson('/api/lab-test-categories');

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                '*' => $this->labTestCategoryStructure
            ]
        ]);
    }

    public function testShow(): void
    {
        $labTestCategory = LabTestCategory::factory()->create();
        $labTest = LabTest::factory()->create();
        $labTestCategory->labTests()->attach($labTest->id);

        $response = $this->getJson("/api/lab-test-categories/{$labTestCategory->id}");

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => $this->labTestCategoryStructure
        ]);
    }

    public function testStore(): void
    {
        $data = [
            'name' => ['en' => 'Test Category Name'],
            'description' => ['en' => 'Test Category Description'],
            'public' => true,
            'ord' => 1
        ];

        $response = $this->postJson('/api/lab-test-categories', $data);

        $response->assertStatus(201);
        $response->assertJsonStructure([
            'data' => $this->labTestCategoryStructure
        ]);
    }

    public function testUpdate(): void
    {
        $labTestCategory = LabTestCategory::factory()->create();
        $labTest = LabTest::factory()->create();
        $labTestCategory->labTests()->attach($labTest->id);

        $data = [
            'name' => ['en' => 'Updated Category Name'],
            'ord' => 44
        ];

        $response = $this->putJson("/api/lab-test-categories/{$labTestCategory->id}", $data);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => $this->labTestCategoryStructure
        ]);

        $response->assertJsonPath('data.ord', 44);
        $response->assertJsonPath('data.name.en', 'Updated Category Name');
    }

    // public function testDestroy(): void
    // {
    //     $labTestCategory = LabTestCategory::factory()->create();

    //     $response = $this->deleteJson("/lab-test-categories/{$labTestCategory->id}");

    //     $response->assertStatus(200);
    //     $response->assertJson([
    //         'message' => 'Lab Test Category deleted successfully'
    //     ]);
    // }
}
