<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DemandeCreateRequest extends FormRequest
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

        $collection = collect($this->request->all());

        $filtered = $collection->filter(function ($value, $key) {
            return ($key != "_token" AND $key != "operation" AND $key != "demande");
        });

        foreach ($filtered as $key => $value) {
            if (preg_match('/date/', $key)) {

                $filtered = $filtered->merge([$key => 'date_format:d/m/Y']);
            }else{
                $filtered = $filtered->merge([$key => 'required']);
            }
            
        }

        //dd($filtered->all());

        return $filtered->all();
    }
}
