<?php

namespace Modules\LabTest\Presentation\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LabTestShowRequest extends FormRequest
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
            'id' => 'required|uuid|exists:lab_tests,id',
        ];
    }
}
