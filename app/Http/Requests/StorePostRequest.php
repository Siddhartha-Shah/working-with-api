<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public static function rules():array
    {
        return [
            "id" => "required|min:2|max:4|unique:employees,id",
            "name" => "required|min:4|max:20|unique:employees,name"
        ];
    }
}
