<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $id = $this->id ?? '';
        
        $rules = [
            'name' => [
                'string', 
                'max:255'
            ],
            'email' => [
                'email', 
                'max:255',
                "unique:users,email,{$id},id",
            ],
            'image' => [
                'nullable',
                'file',
                'mimes:jpeg,jpg,png,svg',
            ],
            'phone'=>[
                'nullable',
                
            ],
            'password' => [
                'required',
                'min:4',
                'max:12'
            ],
        ];

        if($this->method()== 'PUT')
        {
            $rules['password'] =[
                'nullable',
                'min:4',
                'max:12'
            ];
        }

        return $rules;
    }
}
