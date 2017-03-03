<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMemberPost extends FormRequest
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
            'street.required' => 'Sie müssen einen Namen angeben!',
            'street.max' => 'Die Strasse darf nicht länger sein als 50 Zeichen!',
            'street.min' => 'Die Strasse darf nicht kürzer sein als 2 Zeichen!',
            'email.email' => 'Die angegebene E-Mailadresse ist nicht valid',
            'abo.required_with' => 'Bei einem Verkäufer müssen Sie ein Abo wählen'
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
            'street' => 'required|max:50|min:2',
            'email' => 'email',
            'abo' => 'required_with:vendor'
        ];
    }
}
