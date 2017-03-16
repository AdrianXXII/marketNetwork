<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMarketPost extends FormRequest
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
            'start_date.required' => 'Sie müssen einen Beginn angeben!',
            'end_date.required' => 'Sie müssen ein Ende angeben!',
            'start_date.date' => 'Der Beginn muss ein Datum sein!',
            'end_date.date' => 'Das Ende muss ein Datum sein!'
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
            'start_date' => 'required|date',
            'end_date' => 'required|date'
        ];
    }
}
