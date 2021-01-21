<?php

namespace App\Http\Requests\Project;

class ProjectUpdateRequest extends ProjectRequest
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
        return parent::rules();
    }

    public function messages()
    {
        return array_merge(parent::messages(), [
            'tags.required' => 'You have tried to remove all tags from this project. Each project needs to have at least one tag.'
        ]);
    }
}
