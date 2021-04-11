<?php

namespace App\Http\Controllers;

use App\Http\Requests\SavePvtRequest;
use App\Models\Proprietaire;
use App\Models\Pvt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class DevisController extends Controller
{

    //Afficher le formulaire du dévis
    public function index() {
        return view("welcome");
    }

    //Enregistrer le propriétaire du véhicule et les infos du véhicule et Generer le devis
    public function generateDevis(SavePvtRequest $request) {
        DB::beginTransaction();
        try {
            $propretaireWithNumberExists = Proprietaire::where("phone_number",$request->phone_number)->exists();
            $propretaireWithEmailExists = Proprietaire::where("email",$request->email)->exists();
            
            if($propretaireWithNumberExists) {
                $proprietaire = Proprietaire::where("phone_number",$request->phone_number)->first();
            } elseif($propretaireWithEmailExists) {
                $proprietaire = Proprietaire::where("email",$request->email)->first();
            } else {
                $proprietaire = new Proprietaire();
                $proprietaire->nom = $request->nom;
                $proprietaire->prenom = $request->prenom;
                $proprietaire->email = $request->email;
                $proprietaire->country = explode("|",$request->country)[1];
                $proprietaire->adress = $request->adress;
                $proprietaire->phone_number = "+".explode("|",$request->country)[0]." ".$request->phone_number;
                $proprietaire->save();
            }
            $pvt = new Pvt();
            $pvt->immatriculation = $request->immatriculation;
            $pvt->code_unique = Str::uuid();
            $pvt->date_effet = date('Y-m-d', strtotime($request->date_effet));
            $pvt->date_exp = date('Y-m-d', strtotime("+12 months", strtotime($pvt->date_effet)));
            $pvt->date_use_vehic = date('Y-m-d',strtotime($request->date_use_vehic));
            $pvt->zone_c_vehicul = $request->zone_c_vehicul;
            $pvt->date_mise_en_circulation = date('Y-m-d',strtotime($request->date_mise_en_circulation));
            $pvt->valeur_residuelle = $request->valeur_residuelle;
            $pvt->valeur_venale = $request->valeur_venale;
            $pvt->marque = explode("|",$request->modele)[0];
            $pvt->modele = explode("|",$request->modele)[1];
            $pvt->proprietaire_id = $proprietaire->id;
            $pvt->save();

            DB::commit();
            request()->session()->flash('success', "Pvt enregistré avec succès, votre dévis est : ".$pvt->code_unique);
            return redirect()->back();
        }catch(\Exception $e) {
            DB::rollBack();
            Log::error($e);
            request()->session()->flash('error', "Désolé, une erreur est survenue !");
            return redirect()->back();
        }
    } 

}
