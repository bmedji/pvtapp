<?php

namespace App\Http\Controllers;

use App\Models\Pvt;
use Illuminate\Http\Request;

class SouscriptionController extends Controller
{
    public function index() {
        return view("souscription");
    }

    public function searchDevis(Request $request) {
        $pvt = Pvt::where("code_unique",$request->devis)
        ->join('proprietaires', 'pvts.proprietaire_id', '=', 'proprietaires.id')
        ->select('proprietaires.nom as nom','proprietaires.prenom as prenom','proprietaires.email as email','proprietaires.phone_number as phone_number', 'proprietaires.country as country', 'proprietaires.adress as adress', 'pvts.*')->first();
        
        request()->session()->flash('pvt', $pvt);
        return redirect()->back();
    }
}   
