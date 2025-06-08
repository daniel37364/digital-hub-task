<?php

declare(strict_types=1);

namespace Modules\LabTest\Presentation\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LabTestStoreRequest extends FormRequest
{
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
            'code' => 'required|integer|unique:lab_tests,code',
            'code_icd' => 'required|string|max:200|unique:lab_tests,code_icd',
            'name' => 'required|array',
            'name.*' => 'required|string|max:255',
            'description' => 'required|array',
            'description.*' => 'required|string|max:2048',
            'public' => 'required|boolean',
            'category_id' => 'nullable|string|exists:lab_test_categories,id',
        ];
    }
}
