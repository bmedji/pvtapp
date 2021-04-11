@extends('layouts/master')
@section('custom_styles')
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="{{asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{asset('plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
    
@endsection
@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="POST" action="{{route("generatedevis")}}" id="frm_devis" onsubmit="showLoader()">
        @csrf
        <div class="container">
            <h5><i class="fa fa-user"></i>&nbsp;Infos propriétaire</h5>
            <hr />
            <div class="row mb-4">
                <div class="col-12 col-sm form-group">
                    <label for="nom" class="form-label">Nom</label>
                    <input type="text" class="form-control" placeholder="Nom" name="nom" required>
                </div>
                <div class="col-12 col-sm form-group">
                    <label for="nom" class="form-label">Prénom(s)</label>
                    <input type="text" class="form-control" placeholder="Prénom(s)" name="prenom" required>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-12 col-sm form-group">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="text" class="form-control" placeholder="E-mail" name="email" required>
                </div>
                <div class="col-12 col-sm form-group">
                    <label for="phone_number" class="form-label">Numéro de téléphone</label>
                    <input type="number" class="form-control" placeholder="Numéro de téléphone" name="phone_number" required>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-12 col-sm form-group">
                    <label for="countries_list" class="form-label">Pays</label>
                    <select id="countries_list" class="form-control select2bs4" style="width: 100%;" name="country">
                        
                    </select>
                </div>
                <div class="col-12 col-sm form-group">
                    <label for="adress" class="form-label">Ville et lieu d'habitation</label>
                    <input type="text" class="form-control" placeholder="Ville et lieu d'habitation" name="adress" required>
                </div>
            </div>
            <h5><i class="fa fa-car"></i>&nbsp;Infos véhicule</h5>
            <hr />
            <div class="row mb-4">
                <div class="col-12 col-sm form-group">
                    <label for="immatriculation" class="form-label">Immatriculation</label>
                    <input type="text" class="form-control" placeholder="Immatriculation" name="immatriculation" required>
                </div>
                <div class="col-12 col-sm form-group">
                    <label for="date_effet" class="form-label">Date effet</label>
                    <input type="date" class="form-control" placeholder="Date effet" name="date_effet" required>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-12 col-sm form-group">
                    <label for="marque" class="form-label">Marque</label>
                    <select name="marque" id="marques_list" class="form-control select2bs4" style="width: 100%;" required placeholder="Pays" onchange="loadModelesByMarqueId(this.value)">
                        <option value="" disabled selected>Choisissez la marque...</option>
                    </select>
                </div>
                <div class="col-12 col-sm form-group">
                    <label for="modele_id" class="form-label">Modèle</label>
                    <select name="modele" id="modeles_list" required placeholder="Modèle" class="form-control select2bs4" style="width: 100%;">
                        <option value="" disabled selected>Choisissez le modèle...</option>
                    </select>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-12 col-sm form-group">
                    <label for="date_mise_en_circulation" class="form-label">Date de mise en circulation</label>
                    <input type="date" class="form-control" placeholder="Date de mise en circulation" name="date_mise_en_circulation" required>
                </div>
                <div class="col-12 col-sm form-group">
                    <label for="date_use_vehic" class="form-label">1ère date d'utilisation</label>
                    <input type="date" class="form-control" placeholder="1ère date d'utilisation" name="date_use_vehic" required>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-12 col-sm form-group">
                    <label for="valeur_résiduelle" class="form-label">Valeur résiduelle</label>
                    <input type="number" class="form-control" placeholder="Valeur résiduelle" name="valeur_residuelle" required>
                </div>
                <div class="col-12 col-sm form-group">
                    <label for="valeur_venale" class="form-label">Valeur vénale</label>
                    <input type="number" class="form-control" placeholder="Valeur vénale" name="valeur_venale" required>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-12 col-sm form-group">
                    <label for="zone_c_vehicul" class="form-label">Zone de circulation</label>
                    <input type="text" class="form-control" placeholder="Zone de circulation" name="zone_c_vehicul" required>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-12 col-sm form-group ml-4">
                    <input type="checkbox" class="form-check-input" id="accept_conditions" onclick="this.checked=!this.checked;" required name="condition_checked">
                    <label class="form-check-label" for="accept_conditions">J'accepte les <a href="#" data-bs-toggle="modal" data-bs-target="#staticBackdrop">conditions générales d'utilisation</a></label>
                </div>
            </div>
            <div class="row mb-4" style="margin-bottom: 20px">
                <div class="col form-group d-flex justify-content-center">
                    <button type="submit" id="btn_loader" class="btn btn-primary">Obtenir mon dévis</button>
                </div>
            </div>
        </div>
    </form>
  
    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Conditions générales</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                What follows is just some placeholder text for this modal dialog. Sipping on Rosé, Silver Lake sun, coming up all lazy. It’s in the palm of your hand now baby. So we hit the boulevard. So make a wish, I'll make it like your birthday everyday. Do you ever feel already buried deep six feet under? It's time to bring out the big balloons. You could've been the greatest. Passport stamps, she's cosmopolitan. Your kiss is cosmic, every move is magic.

                We're living the life. We're doing it right. Open up your heart. I was tryna hit it and quit it. Her love is like a drug. Always leaves a trail of stardust. The girl's a freak, she drive a jeep in Laguna Beach. Fine, fresh, fierce, we got it on lock. All my girls vintage Chanel baby.

                Before you met me I was alright but things were kinda heavy. Peach-pink lips, yeah, everybody stares. This is no big deal. Calling out my name. I could have rewrite your addiction. She's got that, je ne sais quoi, you know it. Heavy is the head that wears the crown. 'Cause, baby, you're a firework. Like thunder gonna shake the ground.

                Just own the night like the 4th of July! I’m gon’ put her in a coma. What you're waiting for, it's time for you to show it off. Can't replace you with a million rings. You open my eyes and I'm ready to go, lead me into the light. And here you are. I’m gon’ put her in a coma. Come on, let your colours burst. So cover your eyes, I have a surprise. As I march alone to a different beat. Glitter all over the room pink flamingos in the pool.

                You just gotta ignite the light and let it shine! Come just as you are to me. Just own the night like the 4th of July. Infect me with your love and fill me with your poison. Come just as you are to me. End of the rainbow looking treasure.

                I can't sleep let's run away and don't ever look back, don't ever look back. I can't sleep let's run away and don't ever look back, don't ever look back. Yes, we make angels cry, raining down on earth from up above. I'm walking on air (tonight). Let you put your hands on me in my skin-tight jeans. Stinging like a bee I earned my stripes. I went from zero, to my own hero. Even brighter than the moon, moon, moon. Make 'em go, 'Aah, aah, aah' as you shoot across the sky-y-y! Why don't you let me stop by?

                Boom, boom, boom. Never made me blink one time. Yeah, you're lucky if you're on her plane. Talk about our future like we had a clue. Oh my God no exaggeration. You're original, cannot be replaced. The girl's a freak, she drive a jeep in Laguna Beach. It's no big deal, it's no big deal, it's no big deal. In another life I would make you stay. I'm ma get your heart racing in my skin-tight jeans. I wanna walk on your wave length and be there when you vibrate Never made me blink one time.

                We'd keep all our promises be us against the world. If you get the chance you better keep her. It's time to bring out the big, big, big, big, big, big balloons. I hope you got a healthy appetite. Don't let the greatness get you down, oh, oh yeah. Yeah, she's footloose and so fancy free. I want the jaw droppin', eye poppin', head turnin', body shockin'. End of the rainbow looking treasure.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick="check_checkbox(this)">J'ai compris</button>
            </div>
        </div>
        </div>
    </div>

    
    
    
@endsection

@section('custom_scripts')
    <script>
        function check_checkbox(e) {
            $("#accept_conditions").prop("checked",true);
        }
    </script>
    <!-- script pour la page devis -->
    <script src="{{asset("js/welcome.js")}}"></script>
    <!-- Select2 -->
    <script src="{{asset('plugins/select2/js/select2.full.min.js')}}"></script>
    <script>
        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2()

            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })
        });
    </script>
    @if (session("success"))
        <script>
            $(function() {
                Swal.fire(
                'Felicitation !',
                '{!! session("success") !!}',
                'success'
                )
            });
        </script>
    @endif

    @if (session("error"))
        <script>
            $(function() {
                Swal.fire(
                'Attention !',
                '{!! session("error") !!}',
                'error'
                )
            });
        </script>
    @endif
    <script>
        function showLoader() {
            frm_devis = document.getElementById("frm_devis");
            btn_loader = document.getElementById("btn_loader");
            btn_loader.disabled = "disabled";
            btn_loader.innerHTML = '<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>Loading...';
        }
    </script>

@endsection