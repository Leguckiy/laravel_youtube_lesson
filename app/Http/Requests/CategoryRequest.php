<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules =  [
            'code' => ['required', 'min:3', 'max:255', 'unique:categories,code'],
            'name' => ['required', 'min:3', 'max:255',],
            'description' => ['required', 'min:5'],
        ];

        // добавляем возможность сохранения при изменении товара не заводя новый код
        // добавляем числовой идентификатор к правилу 'unique:categories,code'
        // исключая таким образом проверку уникальности для текущего id
        if ($this->route()->named('categories.update')) {
            $rules['code'][array_search('unique:categories,code', $rules['code'])] .=
                ',' . $this->route()->parameter('category')->id;
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'required' => 'Поле :attribute обязательно для ввода',
            'min' => 'Поле :attribute должно иметь минимум :min символов',
            'code.min' => 'Поле код должно содержать не менее :min символов',
        ];
    }
}
