<?php

namespace App\Http\Requests\Student;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStudentRequest extends FormRequest
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
           'nipd' => [ 'integer'],
            'nisn' => ['integer'],
            'name' => ['required', 'string'],
            'gender' => ['required', 'string'],
            'phone_number' => ['string'],
            'classroom_id' => ['nullable', 'string'],
            'name_parent' => ['string'],
            'phone_number_parent' => ['string'],
            'phone_number_parent_opt' => ['string','nullable'],
        ];
    }
}
