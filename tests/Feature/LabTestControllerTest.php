<?php

declare(strict_types=1);

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Common\Infrastructure\EloquentModels\LangSet;
use Modules\LabTest\Infrastructure\EloquentModels\LabTest;
use Modules\LabTest\Infrastructure\EloquentModels\LabTestCategory;
use Modules\LabTest\Infrastructure\Repositories\LabTestRepository;

class LabTestControllerTest extends TestCase
{
    use RefreshDatabase;

    private $labTestStructure = [
        'id',
        'code',
        'code_icd',
        'name',
        'description',
        'ord',
        'categories' => [
            '*' => [
                'id',
                'name',
                'ord',
            ],
        ],
    ];

    public function testIndex(): void
    {
        $labTest = LabTest::factory()->create();
        $category = LabTestCategory::factory()->create();
        $labTest->categories()->attach($category->id);


        $response = $this->getJson('/api/lab-tests');
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'status',
            'message',
            'data' => [
                '*' => $this->labTestStructure
            ]
        ]);
        $this->assertNotEmpty($response['data'][0]['name']);
        $this->assertNotEmpty($response['data'][0]['description']);
    }

    public function testShow(): void
    {
        $labTest = LabTest::factory()->create();
        $category = LabTestCategory::factory()->create();
        $labTest->categories()->attach($category->id);

        $response = $this->getJson("/api/lab-tests/{$labTest->id}");

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'status',
            'message',
            'data' => $this->labTestStructure
        ]);
        $this->assertNotEmpty($response['data']['name']);
        $this->assertNotEmpty($response['data']['description']);
    }

    public function testStore(): void
    {
        $data = [
            'code' => 123,
            'code_icd' => 'ICD123',
            'name' => ['en' => 'Test Name'],
            'description' => ['en' => 'Test Description'],
            'public' => true,
            'ord' => 1,
            'categories' => [
                LabTestCategory::factory()->create()->id,
            ],
        ];

        $response = $this->postJson('/api/lab-tests', $data);

        $response->assertStatus(201);

        $response->assertJsonStructure([
            'status',
            'message',
            'data' => $this->labTestStructure
        ]);
    }

    public function testUpdate(): void
    {
        $labTest = LabTest::factory()->create();
        $category = LabTestCategory::factory()->create();
        $labTest->categories()->attach($category->id);

        $data = [
            'code' => 1234,
            'name' => ['en' => 'Updated Test Name'],
        ];

        $response = $this->putJson("/api/lab-tests/{$labTest->id}", $data);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => $this->labTestStructure
        ]);
        $response->assertJsonPath('data.code', 1234);
        $response->assertJsonPath('data.name.en', 'Updated Test Name');
    }

    public function testDestroy(): void
    {
        $labTest = LabTest::factory()->create();

        $response = $this->deleteJson("/api/lab-tests/{$labTest->id}");

        $response->assertStatus(200);
        $response->assertJson([
            'message' => 'Lab test deleted successfully'
        ]);

        $response = $this->getJson("/api/lab-tests/{$labTest->id}");
        $response->assertStatus(404);
    }
}
