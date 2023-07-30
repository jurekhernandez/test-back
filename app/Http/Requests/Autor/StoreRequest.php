<?php

namespace App\Http\Requests\Autor;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'nombre' => ['required'],
            'biografia' => ['required'],
            'fecha_nacimiento' => ['required','Date'],
        ];
    }

    public function messages():array
    {
        return [
            'required'=>'El campo :attribute es requerido',
            'Date'=>'El campo :attribute debe ser una fecha valida'
        ];
    }
}
