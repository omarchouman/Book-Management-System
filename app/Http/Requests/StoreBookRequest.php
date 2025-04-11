<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'description' => 'nullable|string',
            'tags' => 'nullable|string',
        ];
    }

    public function validated($key = null, $default = null)
    {
        $data = parent::validated();

        if (!empty($data['tags']) && is_string($data['tags'])) {
            $data['tags'] = array_map('trim', explode(',', strtolower($data['tags'])));
        }

        return $data;
    }
}
