@extends('layouts/master')
@section('content')
<div class="container-fluid">
    <h2 class="text-center display-4">Recherche</h2>
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <form action="{{route('searchdevis')}}" method="POST">
                @csrf
                <div class="input-group">
                    <input type="search" class="form-control form-control-lg" placeholder="Saisir le dévis" name="devis" required>
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-lg btn-default">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@if(session('pvt'))
    <div class="row">
        <div class="card mt-sm-5 col-12 col-sm m-2 mt-4">
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><label>Nom: </label><i> {{session('pvt')->nom}}</i></li>
                    <li class="list-group-item"><label>Prénom(s): </label><i> {{session('pvt')->prenom}}</i></li>
                    <li class="list-group-item"><label>E-mail: </label><i> {{session('pvt')->email}}</i></li>
                    <li class="list-group-item"><label>Numéro: </label><i> {{session('pvt')->phone_number}}</i></li>
                    <li class="list-group-item"><label>Pays: </label><i> {{session('pvt')->country}}</i></li>
                    <li class="list-group-item"><label>Ville et lieu d'habitation: </label><i> {{session('pvt')->adress}}</i></li>
                </ul>
            </div>
        </div>
        <div class="card mt-sm-5 col-12 col-sm m-2">
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><label>Immatriculation: </label><i> {{session('pvt')->immatriculation}}</i></li>
                    <li class="list-group-item"><label>Code unique: </label><i> {{session('pvt')->code_unique}}</i></li>
                    <li class="list-group-item"><label>Date effet: </label><i> {{date("d-m-Y",strtotime(session('pvt')->date_effet))}}</i></li>
                    <li class="list-group-item"><label>Date expiration: </label><i> {{date("d-m-Y",strtotime(session('pvt')->date_exp))}}</i></li>
                    <li class="list-group-item"><label>Date utilisation: </label><i> {{date("d-m-Y",strtotime(session('pvt')->date_use_vehic))}}</i></li>
                    <li class="list-group-item"><label>Date mise en circulation: </label><i> {{date("d-m-Y",strtotime(session('pvt')->date_mise_en_circulation))}}</i></li>
                </ul>
            </div>
        </div>
        <div class="card mt-sm-5 col-12 m-2 col-sm">
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><label>Zone de circulation: </label><i> {{session('pvt')->zone_c_vehicul}}</i></li>
                    <li class="list-group-item"><label>Valeur résiduelle: </label><i> {{session('pvt')->valeur_residuelle}}</i></li>
                    <li class="list-group-item"><label>Valeur vénale: </label><i> {{session('pvt')->valeur_venale}}</i></li>
                    <li class="list-group-item"><label>Marque: </label><i> {{session('pvt')->marque}}</i></li>
                    <li class="list-group-item"><label>Modèle: </label><i> {{session('pvt')->modele}}</i></li>
                    {{-- <li class="list-group-item">{{session('pvt')->adress}}</li> --}}
                </ul>
            </div>
        </div>
    </div>
@endif
@endsection