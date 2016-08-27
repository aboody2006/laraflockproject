<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ImportRequest extends Request
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
            "file" => "required|file|mimes:xls,xlsx"
        ];
    }

    public function messages()
    {
        return [
            'file.required' => trans("characteristics.upload.validation.error"),
            'file.file'     => trans("characteristics.upload.validation.errorexcel"),
        ];
    }
}
