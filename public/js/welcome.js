//Charger la liste des paysf
function loadCountries() {
    $.get( "https://restcountries.eu/rest/v2/region/africa", function() {
        console.log( "coutries ressources accessible" );
    })
    .done(function(data) {
        var countries = document.getElementById("countries_list");
        var option;
        data.forEach(element => {
            option = document.createElement("option");
            option.value = element.callingCodes[0] + "|" + element.name;
            option.innerHTML = element.name;
            countries.appendChild(option);
        });
    })
    .fail(function() {
        console.log( "coutries ressources loading failed" );
    })
    .always(function() {
        console.log( "coutries ressources loading finished" );
    });
}

//Charger la liste des marques
function loadMarques() {
    $.get( "https://vpic.nhtsa.dot.gov/api/vehicles/getallmakes?format=json", function() {
        console.log( "Marques ressources accessible" );
    })
    .done(function(data) {
        var marques = document.getElementById("marques_list");
        
        var option;
        data.Results.forEach(element => {
            option = document.createElement("option");
            option.value = element.Make_ID;
            option.innerHTML = element.Make_Name;
            marques.appendChild(option);
        });
    })
    .fail(function() {
        console.log( "marques ressources loading failed" );
    })
    .always(function() {
        console.log( "marques ressources loading finished" );
    });
}

//Charger la liste des modèle selon la marque choisie
function loadModelesByMarqueId(marqueId) {
    $.get( "https://vpic.nhtsa.dot.gov/api/vehicles/GetModelsForMakeId/"+marqueId+"?format=json", function() {
        console.log( "Modeles ressources accessible" );
    })
    .done(function(data) {
        var marques = document.getElementById("modeles_list");
        marques.innerHTML = "";
        var option;
        data.Results.forEach(element => {
            option = document.createElement("option");
            option.value = element.Make_Name+"|"+element.Model_Name;
            option.innerHTML = element.Model_Name;
            marques.appendChild(option);
        });
    })
    .fail(function() {
        console.log( "Modeles ressources loading failed" );
    })
    .always(function() {
        console.log( "Modeles ressources loading finished" );
    });
}

$(document).ready( function() {
    loadCountries();
    loadMarques();
});

