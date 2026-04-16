<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProjectRequest extends FormRequest
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
        "title"           => ['required', 'string', 'max:255'],
        "description"     => ['required', 'string', 'max:255'],
        'image_carousel'  => ['nullable', 'image', 'max:5120'],
        'grid_image'      => ['nullable', 'image', 'max:5120'],
        "grid_image_size" => ['integer'],
        "is_active"       => ['boolean'],
        "service_ids"     => ['nullable', 'array'],
        'service_ids.*'   => ['integer', 'exists:services,id'],
    ];
    }
}
