<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminCreateRequest extends FormRequest
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
        return ($this->operation) ? $this->createStatement() : $this->updateStatement();
    }

    public function createStatement()
    {
        return [
            'nom' => 'required',
            'login' => 'required|unique:utilisateur',
            'password' => 'required|min:6',
        ];
    }

    public function updateStatement()
    {
        $id = $this->utilisateur;
        return [
            'nom' => 'required',
        ];
    }
}
