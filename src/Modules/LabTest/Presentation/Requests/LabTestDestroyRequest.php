<?php

declare(strict_types=1);

namespace Modules\LabTest\Presentation\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LabTestDestroyRequest extends FormRequest
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
            'id' => 'required|uuid|exists:lab_tests,id',
        ];
    }
}
