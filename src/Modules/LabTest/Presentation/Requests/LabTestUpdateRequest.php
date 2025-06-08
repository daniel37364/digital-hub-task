<?php

declare(strict_types=1);

namespace Modules\LabTest\Presentation\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LabTestUpdateRequest extends FormRequest
{
    protected function prepareForValidation(): void
    {
        $this->merge([
            'id' => $this->route('id'),
        ]);
    }
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'id' => 'required|string|uuid|exists:lab_tests,id',
            'code' => 'sometimes|integer|unique:lab_tests,code,' . $this->id,
            'code_icd' => 'sometimes|string|max:200|unique:lab_tests,code_icd,' . $this->id,
            'name' => 'sometimes|array',
            'name.*' => 'sometimes|string|max:255',
            'description' => 'sometimes|array',
            'description.*' => 'sometimes|string|max:2048',
            'public' => 'sometimes|boolean',
            'category_id' => 'sometimes|nullable|string|exists:lab_test_categories,id',
        ];
    }
}
