<?php

declare(strict_types=1);

namespace Modules\LabTest\Presentation\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LabTestIndexRequest extends FormRequest
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
            'name' => 'nullable|string|max:255',
            'synonym' => 'nullable|string|max:255',
            'category_id' => 'nullable|string|exists:lab_test_categories,id',
            'code' => 'nullable|integer',
            'code_icd' => 'nullable|string|max:255',
        ];
    }
}
