<?php

declare(strict_types=1);

namespace Modules\LabTest\Presentation\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LabTestCategoryUpdateRequest extends FormRequest
{
    protected function prepareForValidation(): void
    {
        $this->merge([
            'id' => $this->route('id'),
        ]);
    }
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id' => 'required|uuid|exists:lab_test_categories,id',
            'name' => 'nullable|array',
            'name.*' => 'nullable|string',
            'public' => 'nullable|boolean',
            'ord' => 'nullable|integer',
        ];
    }
}
