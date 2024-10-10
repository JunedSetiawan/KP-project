<?php

namespace App\Http\Requests\InformationService;

use Illuminate\Foundation\Http\FormRequest;

class InformationServiceRequest extends FormRequest
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
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
{
    return [
        'teacher' => ['required', 'exists:teachers,id'],
            'classroom' => ['required', 'exists:classrooms,id'],
            'student' => ['required', 'exists:students,id'],
            'keterangan' => ['required', 'string'],
            'date' => ['required', 'date'],
    ];
}

}
