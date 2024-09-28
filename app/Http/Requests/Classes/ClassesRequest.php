<?php

namespace App\Http\Requests\Classes;

use App\Models\Classroom;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ClassesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function prepareForValidation()
    {
        $this->merge([
            'name' => $this->classroom . $this->type,
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'classroom' => ['required', 'in:7,8,9'], // Validasi kelas
            'type' => ['required', 'in:A,B,C,D,E,F,G,H,I'], // Validasi tipe kelas
            'name' => ['required', 'string'],
            'teacher_id' => ['nullable', 'integer'],
            // 'role' => ['required', 'string', 'in:sales,purchase,manager'],
        ];
    }

    public function messages()
    {
        return [
            'name.unique' => 'Kombinasi kelas dan tipe kelas ini sudah ada. Silakan pilih kombinasi yang lain.',
        ];
    }
}
