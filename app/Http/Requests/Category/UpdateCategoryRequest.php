<?php

namespace App\Http\Requests\category;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255', 'unique:categories,name,'.$this->category->id],
            'image' => ['nullable','image','mimes:jpeg,png,jpg,gif,svg','max:2048'],
        ];
    }
    // public function rules(): array
    // {
    //     return [
    //         'name' => [
    //             'required',
    //             'string',
    //             'max:255',
    //             Rule::unique('categories', 'name')   ->ignore($this->category->id),
    //         ],
    //         'image' => ['nullable','image','mimes:jpeg,png,jpg,gif,svg','max:2048'],
    //     ];
    // }
}
