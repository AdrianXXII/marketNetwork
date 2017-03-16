<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLocationPost extends FormRequest
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
     * Gibt die Fehlermeldungen zurück
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Sie müssen einen Namen angeben!',
            'name.max' => 'Der Name darf nicht länger sein als 30 Zeichen!',
            'name.min' => 'Der Name darf nicht kürzer sein als 2 Zeichen!',
            'city.required' => 'Sie müssen einen Ort angeben!',
            'city.max' => 'Der Ort darf nicht länger sein als 30 Zeichen!',
            'city.min' => 'Der Ort darf nicht kürzer sein als 2 Zeichen!',
            'zip.required' => 'Sie müssen einen PLZ angeben!',
            'zip.max' => 'Die PLZ darf nicht länger sein als 10 Zeichen!',
            'zip.min' => 'Die PLZ darf nicht kürzer sein als 2 Zeichen!',
            'member_max.required' => 'Sie müssen die Anzahl Plätze angeben.',
            'member_max.digits_between' => 'Die Anzahl Plätze muss zwischen 1 und 500 liegen'
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:30|min:2',
            'zip' => 'required|max:10|min:2',
            'city' => 'required|max:30|min:2',
            'member_max' => 'required|digits_between:1,500'
        ];
    }
}
