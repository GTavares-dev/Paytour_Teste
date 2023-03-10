<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\File;

class CurriculoFormRequest extends FormRequest
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
            'name'    => 'required|min:3|max:150',
            'last_name' => 'required|min:3|max:150',
            'email'   => 'required|email|unique:curriculo',
            'phone' => 'required|min:9|max:12',
            'comment' => 'nullable|min:5|max:1500',
            'desiredjob' => 'required',
            'schooling' => 'required',
            'file' => [
                'required',
                File::types(['pdf', 'doc', 'docx'])
                    ->min(20)
                    ->max(1024),
            ],
        ];
    }
}
