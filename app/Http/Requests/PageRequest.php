<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title_def' => 'required|string',
            'slug' => 'required|string|max:50',
        ];
    }

    public function messages()
    {
        return [
            'title_def.required' => 'Title is required',
            'title_def.string' => 'Title must be string',
            'slug.required' => 'Slug is required',
            'slug.string' => 'Slug must be string',
            'slug.max' => 'Slug maximal 50 character',
        ];
    }
}
