<?php

namespace App\Http\Requests\DetailMaterial;

use Illuminate\Foundation\Http\FormRequest;

class DetailMaterialRequest extends FormRequest
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
            'material_id' => ['required', 'integer'],
            'content' => ['required', 'string'],
            'url_video' => ['required', 'string'],
            'file' => ['required', 'string'],
        ];
    }
}
