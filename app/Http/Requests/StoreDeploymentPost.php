<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDeploymentPost extends FormRequest
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
            'title.required' => 'Sie müssen einen Title angeben!',
            'title.max' => 'Der Title darf nicht länger sein als 30 Zeichen!',
            'title.min' => 'Der Title darf nicht kürzer sein als 2 Zeichen!',
            'employee.max' => 'Der Mitarbeitername darf nicht länger sein als 50 Zeichen!',
            'employee.min' => 'Die Mitarbeitername darf nicht kürzer sein als 2 Zeichen!',
            'deployment_date.date' => 'Das Datum ist nicht valid',
            'duration.numeric' => 'Die Dauer muss ',
            'cost.numeric' => 'Die Kosten müssen als Zahl angegeben werden'
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
            'title' => 'required|max:30|min:2',
            'employee' => 'max:50|min:2',
            'description' => 'min:2',
            'deployment_date' => 'date',
            'duration' => 'numeric',
            'cost' => 'numeric'
        ];
    }
}
