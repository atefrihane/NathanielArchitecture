<?php

namespace App\Http\Requests\Project;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
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
            'name' => 'required|max:255',
            'architect' => 'required|max:255',
            'location' => 'required|max:255',
            'date' => 'required|date',
            'tags' => 'required',
            'thumb' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'tags.required' => 'You have not selected a tag for this project. Please select at least one.'
        ];
    }
}
