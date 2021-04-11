<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SavePvtRequest extends FormRequest
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
        return [
            "nom" => "required|string|max:255",
            "prenom" => "required|string|max:255",
            "email" => "required|email|max:255",
            "country" => "required|string|max:255",
            "adress" => "required|string|max:255",
            "phone_number" => "required|numeric",
            "immatriculation" => "required|string|unique:pvts|max:255",
            "date_effet" => "required|date",
            "date_use_vehic" => "required|date",
            "zone_c_vehicul" => "required|string|max:255",
            "date_mise_en_circulation" => "required|date",
            "valeur_residuelle" => "required|numeric",
            "valeur_venale" => "required|numeric",
            "marque" => "required|string|max:255",
            "modele" => "required|string|max:255"
        ];
    }
}
