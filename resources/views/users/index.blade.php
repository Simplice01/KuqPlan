@extends('layouts.app')

@section('content')
@if (session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Succès!',
        text: '{{ session('success') }}',
        confirmButtonText: 'Ok',
        customClass: {
            confirmButton: 'swal2-confirm' // Applique la classe au bouton "Ok"
        }
    });
</script>
@endif

@if (session('error'))
<script>
    Swal.fire({
        icon: 'error',
        title: 'Erreur!',
        text: '{{ session('error') }}',
        confirmButtonText: 'Ok',
        customClass: {
            confirmButton: 'swal2-confirm' // Applique la classe au bouton "Ok"
        }
    });
</script>
@endif

@if ($errors->any())
<script>
    Swal.fire({
        icon: 'error',
        title: 'Erreur de validation!',
        html: '<ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>',
        confirmButtonText: 'Ok',
        customClass: {
            confirmButton: 'swal2-confirm' // Applique la classe au bouton "Ok"
        }
    });
</script>
@endif

    <style>
        /* Style général de la barre de filtres */
        .filter-bar {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            background-color: #f1f1f1;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
            gap: 15px;
            max-width: 100%;
        }

        /* Style des inputs et selects */
        .filter-bar input[type="text"],
        .filter-bar select {
            padding: 12px 15px;
            border: none;
            border-radius: 25px;
            font-size: 14px;
            color: #333;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 200px;
            transition: all 0.3s ease;
        }

        /* Amélioration de l'apparence au focus */
        .filter-bar input[type="text"]:focus,
        .filter-bar select:focus {
            outline: none;
            transform: scale(1.05);
            box-shadow: 0 4px 12px rgba(232, 16, 117, 0.3);
        }

        /* Placeholder et survol */
        .filter-bar input[type="text"]::placeholder {
            color: #E81075;
        }

        /* Filtres cachés par défaut */
        .filter-bar .advanced-filters {
            display: none;
            flex-direction: column;
            gap: 10px;
            width: 100%;
            max-width: 280px;
        }

        /* Bouton pour afficher les filtres avancés */
        .filter-bar .toggle-filters {
            padding: 10px 20px;
            background-color: none;
            color: #fff;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        .filter-bar .toggle-filters:hover {
            background-color: none;
            border:none;
        }

        /* Style responsive pour les petits écrans */
        @media (max-width: 768px) {
            .filter-bar {
                display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center
            }

            .filter-bar input[type="text"],
            .filter-bar select {
                max-width: 60%;
            }
        }
    </style>

    <div class="filter-bar">
        <input type="text" id="searchName" placeholder="Rechercher un nom..." onkeyup="filterData()">

        <div class="advanced-filters">
            <select id="cityFilter" onchange="filterData()">
                <option value="">Toutes les villes</option>
                <option value="Abomey-calavi">Abomey-calavi</option>
                <option value="Abidjan">Abidjan</option>
                <option value="Cotonou">Cotonou</option>
                <option value="Lomé">Lomé</option>
            </select>

            <select id="formFilter" onchange="filterData()">
                <option value="">Toutes les formes</option>
                <option value="skiny">Skiny</option>
                <option value="normale">Normale</option>
                <option value="apouchou">Apouchou</option>
            </select>
        </div>

        <button class="toggle-filters" onclick="toggleFilters()"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: #d10e67;transform: ;msFilter:;"><path d="M7 11h10v2H7zM4 7h16v2H4zm6 8h4v2h-4z"></path></svg></button>
    </div>

    <!-- Carrousel d'utilisateurs -->
<div class="carousel" style="margin-bottom: 52px;">
    @foreach ($usersc as $user)
    <div data-name="{{ $user->name }}" data-city="{{ $user->city }}" data-form="{{ $user->form }}" class="user-item">
       <a href="{{ route('users.show', $user->id) }}">
        <div class="user-image">
            <img src="{{ asset('storage/' . $user->imgprofil) }}" alt="User">
            <span class="online-indicator"></span>
        </div>
        <div style="color:#E81075;font-weight:bold;" class="user-name">{{ $user->name }}</div>
      </a>
    </div>

        @endforeach
    </div>
    <!-- Ajoutez d'autres utilisateurs ici -->
</div>
 <style>
    .user-list {
    display: flex;
    overflow: hidden; /* Cache le contenu qui déborde */
    padding: 10px; /* Ajoute du padding */
}

.user-item {
    display: flex;
    flex-direction: column; /* Aligne les éléments verticalement */
    align-items: center; /* Centre les éléments horizontalement */
    margin: 0 10px; /* Espace entre les éléments */
    text-align: center; /* Centre le texte du nom */
}

.user-image {
    position: relative;
}

.user-image img {
    width: 70px; /* Taille de l'image */
    height: 70px; /* Taille de l'image */
    border-radius: 50%; /* Pour rendre l'image circulaire */
    border: 2px solid #f0f0f0; /* Bordure autour de l'image */
}

.online-indicator {
    position: absolute;
    bottom: 5px; /* Position de l'indicateur */
    right: 5px; /* Position de l'indicateur */
    width: 15px; /* Taille de l'indicateur */
    height: 15px; /* Taille de l'indicateur */
    background-color: green; /* Couleur de l'indicateur */
    border-radius: 50%; /* Rendre l'indicateur circulaire */
    border: 2px solid white; /* Bordure blanche pour l'indicateur */
}

.user-name {
    font-size: 12px; /* Réduit la taille du texte du nom */
    color: #333; /* Couleur du texte */
    margin-top: 5px; /* Espace entre l'image et le nom */
}

 </style>

    <div class="lesfilledispo" id="filteredResults">
        <!-- Les résultats filtrés seront affichés ici -->
        <div class="lesfilledispo">
            @foreach ($users as $user)
            <div class="detailsfille" data-name="{{ $user->name }}" data-city="{{ $user->city }}" data-form="{{ $user->form }}">
                @if ($user->imgprofil)
                <a href="{{ route('users.show', $user->id) }}">
                    <img class="imagefille" src="{{ asset('storage/' . $user->imgprofil) }}" alt="{{ $user->name }}">
                    {{-- src="{{ asset('storage/images/' . $user->imgprofil) }}" --}}

                </a>
                @else
                <img class="imagefille" src="https://via.placeholder.com/600x300" alt="No image">
                @endif
                <div class="infosfille">
                    <div class="dispositioninfos">
                        <h5 class="espaceinfosint">{{ $user->name }}</h5>
                        
                        <h6>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: #E81075;transform: ;msFilter:;"><path d="M12 2C8.691 2 6 4.691 6 8c0 2.967 2.167 5.432 5 5.91V17H8v2h3v2.988h2V19h3v-2h-3v-3.09c2.833-.479 5-2.943 5-5.91 0-3.309-2.691-6-6-6zm0 10c-2.206 0-4-1.794-4-4s1.794-4 4-4 4 1.794 4 4-1.794 4-4 4z"></path></svg>
                        </h6>
                        
                    </div>

                    <div class="dispositioninfos">
                        <h6>{{ $user->city }} <svg fill="#E81075" version="1.1" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 395.71 395.71"><path d="M197.849,0C122.131,0,60.531,61.609,60.531,137.329c0,72.887,124.591,243.177,129.896,250.388l4.951,6.738 c0.579,0.792,1.501,1.255,2.471,1.255c0.985,0,1.901-0.463,2.486-1.255l4.948-6.738c5.308-7.211,129.896-177.501,129.896-250.388 C335.179,61.609,273.569,0,197.849,0z M197.849,88.138c27.13,0,49.191,22.062,49.191,49.191c0,27.115-22.062,49.191-49.191,49.191 c-27.114,0-49.191-22.076-49.191-49.191C148.658,110.2,170.734,88.138,197.849,88.138z"/></svg></h6>
                    </div>

                    <div class="dispositioninfos">
                        <h6 class="espaceinfosint">{{ $user->age }} ans</h6>
                        <div>
                            <a class="btnvoirplusdetails" href="{{ route('users.show', $user->id) }}">Voir plus</a>
                        </div>
                    </div>

                    <div class="btncontactez">
                        <!-- <button class="btninscription" type="submit" name="inscription">Contacter</button> -->
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
    </div>
    
        <div class="pagination-wrapper" style="margin: 10px auto;">
            {{ $users->links() }}
        </div>
            

    <style>
        .filter-bar {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }

        .filter-bar input,
        .filter-bar select {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
    </style>
</form>
      <div class=" titrepage">
             <h3>Avis des utilisateurs</h3>
           </div>
            <div class="carousel">
                @foreach ($feedbacks as $feedback)
                       <div class="carousel__item">
                       <h1 style="text-align:center;"><svg xmlns="http://www.w3.org/2000/svg" width="44" height="44" viewBox="0 0 24 24" style="fill: black;transform: ;msFilter:;"><path d="M12 2C6.579 2 2 6.579 2 12s4.579 10 10 10 10-4.579 10-10S17.421 2 12 2zm0 5c1.727 0 3 1.272 3 3s-1.273 3-3 3c-1.726 0-3-1.272-3-3s1.274-3 3-3zm-5.106 9.772c.897-1.32 2.393-2.2 4.106-2.2h2c1.714 0 3.209.88 4.106 2.2C15.828 18.14 14.015 19 12 19s-3.828-.86-5.106-2.228z"></path></svg></h1>
                       <p>
                         <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" style="fill: rgb(232, 16, 117);transform: ;msFilter:;"><path d="M6.5 10c-.223 0-.437.034-.65.065.069-.232.14-.468.254-.68.114-.308.292-.575.469-.844.148-.291.409-.488.601-.737.201-.242.475-.403.692-.604.213-.21.492-.315.714-.463.232-.133.434-.28.65-.35l.539-.222.474-.197-.485-1.938-.597.144c-.191.048-.424.104-.689.171-.271.05-.56.187-.882.312-.318.142-.686.238-1.028.466-.344.218-.741.4-1.091.692-.339.301-.748.562-1.05.945-.33.358-.656.734-.909 1.162-.293.408-.492.856-.702 1.299-.19.443-.343.896-.468 1.336-.237.882-.343 1.72-.384 2.437-.034.718-.014 1.315.028 1.747.015.204.043.402.063.539l.025.168.026-.006A4.5 4.5 0 1 0 6.5 10zm11 0c-.223 0-.437.034-.65.065.069-.232.14-.468.254-.68.114-.308.292-.575.469-.844.148-.291.409-.488.601-.737.201-.242.475-.403.692-.604.213-.21.492-.315.714-.463.232-.133.434-.28.65-.35l.539-.222.474-.197-.485-1.938-.597.144c-.191.048-.424.104-.689.171-.271.05-.56.187-.882.312-.317.143-.686.238-1.028.467-.344.218-.741.4-1.091.692-.339.301-.748.562-1.05.944-.33.358-.656.734-.909 1.162-.293.408-.492.856-.702 1.299-.19.443-.343.896-.468 1.336-.237.882-.343 1.72-.384 2.437-.034.718-.014 1.315.028 1.747.015.204.043.402.063.539l.025.168.026-.006A4.5 4.5 0 1 0 17.5 10z"></path></svg>
                         {{ $feedback->content }}
                         <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" style="fill:rgb(232, 16, 117);transform: ;msFilter:;"><path d="m21.95 8.721-.025-.168-.026.006A4.5 4.5 0 1 0 17.5 14c.223 0 .437-.034.65-.065-.069.232-.14.468-.254.68-.114.308-.292.575-.469.844-.148.291-.409.488-.601.737-.201.242-.475.403-.692.604-.213.21-.492.315-.714.463-.232.133-.434.28-.65.35l-.539.222-.474.197.484 1.939.597-.144c.191-.048.424-.104.689-.171.271-.05.56-.187.882-.312.317-.143.686-.238 1.028-.467.344-.218.741-.4 1.091-.692.339-.301.748-.562 1.05-.944.33-.358.656-.734.909-1.162.293-.408.492-.856.702-1.299.19-.443.343-.896.468-1.336.237-.882.343-1.72.384-2.437.034-.718.014-1.315-.028-1.747a7.028 7.028 0 0 0-.063-.539zm-11 0-.025-.168-.026.006A4.5 4.5 0 1 0 6.5 14c.223 0 .437-.034.65-.065-.069.232-.14.468-.254.68-.114.308-.292.575-.469.844-.148.291-.409.488-.601.737-.201.242-.475.403-.692.604-.213.21-.492.315-.714.463-.232.133-.434.28-.65.35l-.539.222c-.301.123-.473.195-.473.195l.484 1.939.597-.144c.191-.048.424-.104.689-.171.271-.05.56-.187.882-.312.317-.143.686-.238 1.028-.467.344-.218.741-.4 1.091-.692.339-.301.748-.562 1.05-.944.33-.358.656-.734.909-1.162.293-.408.492-.856.702-1.299.19-.443.343-.896.468-1.336.237-.882.343-1.72.384-2.437.034-.718.014-1.315-.028-1.747a7.571 7.571 0 0 0-.064-.537z"></path></svg>
                       </p>
                       <h6 class="nameavis">{{ $feedback->user->name }}</h6>
                     </div>
              @endforeach

       </div>
      {{-- <form action="" method="post" class="formulairedetailscpt">
           <div class="form-group">
               <h2>Donner un avis</h2>
               <label class="labelcache" for="motpass">Description</label>
               <textarea placeholder="Mon avis.." class="descripfille" name="avisnew" id="" cols="35" rows="10" ></textarea>
           </div>
           <div class="btninscriprive">
               <button class="btninscription" type="submit" name="envoyenotif">Envoyé</button>
           </div>
       </form> --}}

   <script>

    document.addEventListener("DOMContentLoaded", function() {
     const mainButton = document.getElementById("mainButton");
     const buttonContainer = document.getElementById("buttonContainer");
     const buttons = buttonContainer.getElementsByClassName("styled-button");

     mainButton.addEventListener("click", function() {
         // Toggle visibility of the button container
         buttonContainer.classList.toggle("hidden");
     });

     for (let button of buttons) {
         button.addEventListener("click", function() {
             // Hide the button container when any button is clicked
             buttonContainer.classList.add("hidden");
         });
     }
   });


function filterData() {
    const name = document.getElementById('searchName').value;
    const city = document.getElementById('cityFilter').value;
    const skin_tone = document.getElementById('formFilter').value;

    fetch('/filter-users', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ name, city, skin_tone })
    })
    .then(response => response.json())
    .then(users => {
        const filteredResults = document.getElementById('filteredResults');
        filteredResults.innerHTML = ''; // Vider le conteneur

        if (users.length > 0) {
            users.forEach(user => {
                let userDiv = `
    <div class="detailsfille" data-name="${user.name}" data-city="${user.city}" data-form="${user.skin_tone}">
        <a href="/users/${user.id}">
            <img class="imagefille" src="${user.imgprofil ? '/storage/' + user.imgprofil : 'https://via.placeholder.com/600x300'}" alt="${user.name}">
        </a>
        <div class="infosfille">
            <div class="dispositioninfos">
                <h5 class="espaceinfosint">${user.name}</h5>
                <h6>
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" style="fill: rgb(245, 0, 0);">
                        <path d="M12 2C8.691 2 6 4.691 6 8c0 2.967 2.167 5.432 5 5.91V17H8v2h3v2.988h2V19h3v-2h-3v-3.09c2.833-.479 5-2.943 5-5.91 0-3.309-2.691-6-6-6zm0 10c-2.206 0-4-1.794-4-4s1.794-4 4-4 4 1.794 4 4-1.794 4-4 4z"></path>
                    </svg>
                </h6>
            </div>
            <div class="dispositioninfos">
                <h6>${user.city}
                    <svg fill="#E81075" version="1.1" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 395.71 395.71">
                        <path d="M197.849,0C122.131,0,60.531,61.609,60.531,137.329c0,72.887,124.591,243.177,129.896,250.388l4.951,6.738 c0.579,0.792,1.501,1.255,2.471,1.255c0.985,0,1.901-0.463,2.486-1.255l4.948-6.738c5.308-7.211,129.896-177.501,129.896-250.388 C335.179,61.609,273.569,0,197.849,0z M197.849,88.138c27.13,0,49.191,22.062,49.191,49.191c0,27.115-22.062,49.191-49.191,49.191 c-27.114,0-49.191-22.076-49.191-49.191C148.658,110.2,170.734,88.138,197.849,88.138z"/>
                    </svg>
                </h6>
            </div>
            <div class="dispositioninfos">
                <h6 class="espaceinfosint">${user.age} ans</h6>
                <div>
                    <a class="btnvoirplusdetails" href="/users/${user.id}">Voir plus</a>
                </div>
            </div>
        </div>
    </div>`;

                filteredResults.innerHTML += userDiv;
            });
        } else {
            filteredResults.innerHTML = '<p style="color:red;font-weight:bold;margin:auto;">Aucun utilisateur trouvé.</p>';
        }
    })
    .catch(error => console.error('Erreur:', error));
}

           function toggleFilters() {
            var filters = document.querySelector('.advanced-filters');
            if (filters.style.display === "none" || filters.style.display === "") {
                filters.style.display = "flex";
            } else {
                filters.style.display = "none";
            }
        }

</script>

       @endsection
