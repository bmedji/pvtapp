<div class="sticky-top">
<nav class="navbar navbar-expand-lg navbar-dark bg-danger ">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">PVT</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
                <a class="nav-link" aria-current="page" href="{{route('devis')}}">Dévis</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" aria-current="page" href="{{route('souscription')}}">Souscription</a>
            </li>
        </ul>
        {{-- <form class="d-flex">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
        </form> --}}
        </div>
    </div>
</nav>
<nav class="navbar navbar-light bg-light shadow-sm p-3 mb-5 bg-white rounded">
    <div class="container-fluid d-flex justify-content-center">
        <img src="{{asset('img/logoamgs.jpg')}}" style="width: 9rem"/>
        <div class="col-12 d-flex justify-content-center">
            <h5>African Mutual Global Services</h5>
        </div>
    </div>
</nav>
</div>