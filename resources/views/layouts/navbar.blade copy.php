<nav class="navbar">
    <div style="margin-left:50px;" class="navbar-toggle" onclick="toggleNavbar()">
        <div class="bar"></div>
        <div class="bar"></div>
        <div class="bar"></div>
    </div>

    <!-- Ajout du nom de l'entreprise "Kuqplan" -->
    <div class="navbar-brand">
        <h1>Kuqplan</h1>
    </div>

    <ul class="navbar-linkus" id="navbarLinks">
        @auth
            <li><a href=""><a href="{{ route('users.index') }}">Acceuil</a></a></li>
        @endauth
        @guest
            <li><a href=""><a href="{{ route('home') }}">Acceuil</a></a></li>
            <li><a href=""><a href="{{ route('login') }}">Connexion</a></a></li>
            <li><a href=""><a href="{{ route('users.create') }}">Inscription</a></a></li>
        @endguest
        @auth
        @if(auth()->user()->role === 'admin')
            <li>
                <a href="{{ route('users.show', auth()->user()->id) }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgb(255, 255, 255);transform: ;msFilter:;">
                        <path d="M8 12.052c1.995 0 3.5-1.505 3.5-3.5s-1.505-3.5-3.5-3.5-3.5 1.505-3.5 3.5 1.505 3.5 3.5 3.5zM9 13H7c-2.757 0-5 2.243-5 5v1h12v-1c0-2.757-2.243-5-5-5zm11.294-4.708-4.3 4.292-1.292-1.292-1.414 1.414 2.706 2.704 5.712-5.702z"></path>
                    </svg>
                </a>
            </li>
        @elseif(auth()->user()->role === 'user')
            <li>
                <a href="{{ route('users.show', auth()->user()->id) }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgb(255, 255, 255);transform: ;msFilter:;">
                        <path d="M7.5 6.5C7.5 8.981 9.519 11 12 11s4.5-2.019 4.5-4.5S14.481 2 12 2 7.5 4.019 7.5 6.5zM20 21h1v-1c0-3.859-3.141-7-7-7h-4c-3.86 0-7 3.141-7 7v1h17z"></path>
                    </svg>
                </a>
            </li>
        @endif
        <li>
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Déconnexion</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li>
        @endauth
    </ul>
</nav>

<!-- Style pour la navigation et le nom de l'entreprise -->
<style>
.navbar-brand h1 {
    color: white;
    font-size: 24px;
    margin-left: 20px;
}

.navbar-linkus li a {
    color: white;
    text-decoration: none;
    margin-left: 20px;
}

@media only screen and (max-width: 768px) {
    .navbar-brand h1 {
        font-size: 20px;
        margin-left: 10px;
    }
}
</style>

<script>
function toggleNavbar() {
    var navbarLinks = document.getElementById("navbarLinks");
    navbarLinks.classList.toggle("active");
}

setTimeout(function() {
    document.querySelector('.navbar').classList.add('active');
}, 500);

document.addEventListener("DOMContentLoaded", function() {
    // Dynamically set the current year
    const yearElement = document.getElementById("year");
    const currentYear = new Date().getFullYear();
    yearElement.textContent = currentYear;
});

document.addEventListener("DOMContentLoaded", function() {
    // Simulate loading delay of 2 seconds
    setTimeout(function() {
        document.querySelector('.loader-wrapper').style.display = 'none';
        document.querySelector('.content').style.display = 'block';
    }, 2000);
});
</script>

@extends('layouts.app')

@section('content')
<div class="container mt-4">
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Succès!',
                text: '{{ session('success') }}',
                confirmButtonText: 'Ok',
                customClass: {
                    confirmButton: 'swal2-confirm'
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
                    confirmButton: 'swal2-confirm'
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
                    confirmButton: 'swal2-confirm'
                }
            });
        </script>
    @endif

    <div class="selected-value" id="phpValueDisplay"></div>
    <div class="titrepage">
        <h4>RECHARGEMENT</h4>
        <h5>Mes packs</h5>
    </div>
    <form id="rechargementForm">
        @csrf
        <div class="mespacks">
            @foreach ($packs as $pack)
                <div class="button-like intpack1" style="cursor: pointer;">
                    <h5>{{ $pack->number }}</h5>
                    <h5>Pièce</h5>
                    <h5 class="prixpack1">{{ $pack->price }}f</h5>
                </div>
            @endforeach
        </div>

        <select class="selectpaie" name="reseau" id="reseau">
            <option value="MOBILE">MTN MOONEY</option>
            <option value="flooz">MOOV MOONEY</option>
        </select>

        <div id="render" class="btncontactez">
            <div class="form-group">
                <label class="labelcache" for="numeroclient">Numero de téléphone</label>
                <input class="inputtextpaie" style="color:black;font-weight:400;text-align:center;" type="text" id="numeroclient" name="numeroclient" placeholder="Numero de téléphone">
                <h5 class="prixpack2" id="selectedValueDisplay">0F cfa</h5>
            </div>
            <button class="btninscription" id="payButton" type="button" onclick="initiateFeexpayPayment()">Payer</button>
        </div>
    </form>

    <script src="https://api.feexpay.me/feexpay-javascript-sdk/index.js"></script>
    <script>
        // Capture selected pack value
// Capture selected pack value
let selectedPackPrice = 0;
document.querySelectorAll(".button-like").forEach(element => {
    element.addEventListener("click", function(event) {
        event.preventDefault();
        selectedPackPrice = parseInt(element.querySelector(".prixpack1").textContent);
        document.getElementById('selectedValueDisplay').innerHTML = selectedPackPrice + "F cfa";
    });
});

// Feexpay integration
function initiateFeexpayPayment() {
    const phoneNumber = document.getElementById('numeroclient').value;
    const reseau = document.getElementById('reseau').value;

    // Vérifiez si les valeurs sont correctes
    console.log("Numéro de téléphone:", phoneNumber);
    console.log("Prix sélectionné:", selectedPackPrice);
    console.log("Réseau sélectionné:", reseau);

    if (!phoneNumber || !selectedPackPrice) {
        Swal.fire({
            icon: 'error',
            title: 'Erreur!',
            text: 'Veuillez sélectionner un pack et entrer votre numéro de téléphone.',
            confirmButtonText: 'Ok'
        });
        return;
    }

    // Initialisation de FeexPay
    FeexPayButton.init("render", {
        id: '66728a2b1d337a574aeaa0cb5',
        amount: 1000,
        token: 'fp_ND4flsh3HEuxOLLjeAVZQqyF977UvDwxWmx2pqbJmoGwQTUWtQhkS5D64nvpmn7d',
        callback: () => {
            Swal.fire({
                icon: 'success',
                title: 'Paiement Réussi!',
                text: 'Votre paiement a été effectué avec succès.',
                confirmButtonText: 'Ok'
            });
        },
        onError: (error) => {
            console.error("Erreur lors de l'initialisation du paiement:", error);
            Swal.fire({
                icon: 'error',
                title: 'Erreur!',
                text: 'Le paiement a échoué. Veuillez réessayer.',
                confirmButtonText: 'Ok'
            });
        },
        mode: 'SANDBOX',
        custom_button: true,
        id_custom_button: "payButton",
        custom_id: Math.random().toString(36).substring(2, 15),
        description: "Test",
        case: "MOBILE"
    });
}


    </script>
@endsection




@extends('layouts.app')

@section('content')
<div class="container mt-4 w-100">
    <h1 style="color:orange;" class="mb-4">Tableau de bord</h1>
    @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif








    <!-- Buttons for additional actions -->
    <div class="d-flex justify-content-center flex-wrap gap-2 m-1 "  >
        <a class="btn btn-custom-primary m-1" href="" >
            Nouvelle
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(255, 255, 255, 1);transform: ;msFilter:;"><path d="M20.56 3.34a1 1 0 0 0-1-.08l-17 8a1 1 0 0 0-.57.92 1 1 0 0 0 .6.9L8 15.45v6.72L13.84 18l4.76 2.08a.93.93 0 0 0 .4.09 1 1 0 0 0 .52-.15 1 1 0 0 0 .48-.79l1-15a1 1 0 0 0-.44-.89zM18.1 17.68l-5.27-2.31L16 9.17l-7.65 4.25-2.93-1.29 13.47-6.34z"></path></svg>
        </a>
        <a class="btn btn-custom-info m-1" href="">
            Mes Medias
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" class="btn-icon">
                <path d="M4 6h2v2H4zm0 5h2v2H4zm0 5h2v2H4zm16-8V6H8.023v2H18.8zM8 11h12v2H8zm0 5h12v2H8z"></path>
            </svg>
        </a>
        @auth
            @if(auth()->user()->role === 'admin')
            <a class="btn btn-custom-secondary m-1" href="">
                Nouveau
                 <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" class="btn-icon">
                    <path d="M19 8h-2v3h-3v2h3v3h2v-3h3v-2h-3zM4 8a3.91 3.91 0 0 0 4 4 3.91 3.91 0 0 0 4-4 3.91 3.91 0 0 0-4-4 3.91 3.91 0 0 0-4 4zm6 0a1.91 1.91 0 0 1-2 2 1.91 1.91 0 0 1-2-2 1.91 1.91 0 0 1 2-2 1.91 1.91 0 0 1 2 2zM4 18a3 3 0 0 1 3-3h2a3 3 0 0 1 3 3v1h2v-1a5 5 0 0 0-5-5H7a5 5 0 0 0-5 5v1h2z"></path>
                </svg>
            </a>
            <a class="btn btn-custom-info m-1" href="">
                Mes utilisateurs
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" class="btn-icon">
                    <path d="M15 11h7v2h-7zm1 4h6v2h-6zm-2-8h8v2h-8zM4 19h10v-1c0-2.757-2.243-5-5-5H7c-2.757 0-5 2.243-5 5v1h2zm4-7c1.995 0 3.5-1.505 3.5-3.5S9.995 5 8 5 4.5 6.505 4.5 8.5 6.005 12 8 12z"></path>
                </svg>
            </a>
            @endif
        @endauth
    </div>

    <!-- Dashboard Statistics -->
    <div class="row mb-4">
        <!-- Nombre de Medias -->
        <div class="col-md-4">
            <div class="card border-custom mb-4">
                <div class="card-body">
                    <h5 style="color:orange;font-weight:bold;" class="card-title">Mes Medias </h5>
                    <p style="font-weight: 500;" class="card-text">Nombre total: <span>{{ $MediasCount }}</span> </p>

                    {{-- <p style="font-weight: 500;" class="card-text">Non visible <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;"><path d="M12 19c.946 0 1.81-.103 2.598-.281l-1.757-1.757c-.273.021-.55.038-.841.038-5.351 0-7.424-3.846-7.926-5a8.642 8.642 0 0 1 1.508-2.297L4.184 8.305c-1.538 1.667-2.121 3.346-2.132 3.379a.994.994 0 0 0 0 .633C2.073 12.383 4.367 19 12 19zm0-14c-1.837 0-3.346.396-4.604.981L3.707 2.293 2.293 3.707l18 18 1.414-1.414-3.319-3.319c2.614-1.951 3.547-4.615 3.561-4.657a.994.994 0 0 0 0-.633C21.927 11.617 19.633 5 12 5zm4.972 10.558-2.28-2.28c.19-.39.308-.819.308-1.278 0-1.641-1.359-3-3-3-.459 0-.888.118-1.277.309L8.915 7.501A9.26 9.26 0 0 1 12 7c5.351 0 7.424 3.846 7.926 5-.302.692-1.166 2.342-2.954 3.558z"></path></svg>: <span>{{ $MediasCount2 }}</span> </p>
                    <p style="font-weight: 500;" class="card-text"> A venir <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;"><path d="M19 4h-2V2h-2v2H9V2H7v2H5c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2h14c1.103 0 2-.897 2-2V6c0-1.103-.897-2-2-2zm-1 15h-6v-6h6v6zm1-10H5V7h14v2z"></path></svg>: <span>{{ $MediasCount4 }}</span> </p> --}}
                </div>
            </div>
        </div>

        <!-- Nombre d'utilisateurs -->
        @auth
        @if(auth()->user()->role === 'admin')
        <div class="col-md-4">
            <div class="card border-custom mb-4">
                <div class="card-body">
                    <h5 style="color:orange;font-weight:bold;" class="card-title">Mes utilisateurs  </h5>
                    <p style="font-weight: 500;" class="card-text">Nombre total:{{ $usersCount }}</p>
                    <p style="font-weight: 500;" class="card-text">Admin:{{ $usersCount1 }}</p>
                </div>
            </div>
        </div>
        @endif
        @endauth

        <!-- Media la plus partagée -->
        {{-- <div class="col-md-4">
            <div class="card border-custom mb-4">
                <div class="card-body">
                    <h5 style="color:orange;font-weight:bold;" class="card-title">Media la plus likée</h5>
                    @if($mostSharedMedia)
                        <p style="font-weight: 500;" class="card-text">{{ $mostSharedMedia->titrepub }} ({{ $mostSharedMedia->share_count }} likes)</p>
                    @else
                        <p class="card-text">Aucune Media</p>
                    @endif
                </div>
            </div>
        </div> --}}

    </div>

    <!-- Courbes des J'aime et des Medias -->
    <div class="row mb-4">
        <!-- Courbe des J'aime -->

        <!-- Courbe des Medias -->
        <div class="col-md-6">
            <div class="card border-custom mb-4">
                <div class="card-body">
                    <h5 class="card-title">Courbe des Medias</h5>
                    <canvas id="MediasChart" class="chart-animation"></canvas>
                </div>
            </div>
        </div>

        <!-- Courbe des Utilisateurs -->
        <div class="col-md-6">
            <div class="card border-custom mb-4">
                <div class="card-body">
                    <h5 class="card-title">Courbe des Utilisateurs</h5>
                    <canvas id="usersChart" class="chart-animation"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Inclure l'adaptateur de date -->
<script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns@2"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Données pour les 'J'aime'

        // Données pour les Medias
        var MediasData = @json($MediasData);
        var labelsMedias = MediasData.map(function(item) { return item.date; });
        var Medias = MediasData.map(function(item) { return item.Medias_total; });

        var ctxMedias = document.getElementById('MediasChart').getContext('2d');
        var MediasChart = new Chart(ctxMedias, {
            type: 'bar',
            data: {
                labels: labelsMedias,
                datasets: [{
                    label: 'Nombre de Medias',
                    data: Medias,
                    backgroundColor: 'rgba(255, 165, 0, 0.2)',
                    borderColor: 'orange',
                    borderWidth: 2
                }]
            },
            options: {
                scales: {
                    y: { beginAtZero: true },
                    x: { grid: { color: 'rgba(255, 165, 0, 0.2)' } }
                },
                animations: {
                    y: {
                        duration: 1000,
                        easing: 'easeOutBounce'
                    }
                }
            }
        });

        // Données pour les utilisateurs
       var usersData = @json($usersData);
       console.log(usersData);
        var labelsUsers = usersData.map(function(item) { return item.date; });
        var users = usersData.map(function(item) { return item.users_total; });

        var ctxUsers = document.getElementById('usersChart').getContext('2d');
        var usersChart = new Chart(ctxUsers, {
            type: 'line',
            data: {
                labels: labelsUsers,
                datasets: [{
                    label: 'Nombre d\'Utilisateurs',
                    data: users,
                    borderColor: 'rgba(153, 102, 255, 1)',
                    backgroundColor: 'rgba(153, 102, 255, 0.2)',
                    borderWidth: 2,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                scales: {
                    x: {
                        type: 'time',
                        time: {
                            unit: 'day'
                        },
                        title: {
                            display: true,
                            text: 'Date'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Nombre d\'Utilisateurs'
                        }
                    }
                }
            }
        });
    });


    function openModal() {
    document.getElementById('abonnementModal').style.display = "block";
}

function closeModal() {
    document.getElementById('abonnementModal').style.display = "none";
}

// Close the modal when clicking outside of it
window.onclick = function(event) {
    var modal = document.getElementById('abonnementModal');
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

</script>

<style>

.abonnement-status {
    display: flex;
    align-items: center;
    justify-content: space-between;
    max-width: 400px;
    margin: 10px auto;
    padding: 5px 5px;
    border-radius: 5px;
    background: #f0f4f8;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    opacity: 0;
    transform: translateX(-10px);
    transition: opacity 0.6s ease-out, transform 0.6s ease-out;
}

.abonnement-status.animated.slideInLeft {
    opacity: 1;
    transform: translateX(0);
}

.abonnement-header h2 {
    margin: 0;
    color: #007BFF;
    font-size: 1.1rem;
}

.notification {
    /* background-color: #ffeb3b; */
    color: #ff0000;
    padding: 5px 10px;
    border-radius: 3px;
    font-size: 0.9rem;
    margin-right: 10px;
}

.notification2 {
    /* background-color: #ffeb3b; */
    color: #0bd604e1;
    padding: 5px 10px;
    border-radius: 3px;
    font-size: 0.9rem;
    margin-right: 10px;
}

.btn-details {
    padding: 5px 10px;
    background-color: #007BFF;
    color: white;
    border: none;
    border-radius: 3px;
    cursor: pointer;
    font-size: 0.9rem;
    transition: background-color 0.3s;
}

.btn-details:hover {
    background-color: #0056b3;
}

/* Modal Style (same as before) */
/* Modal Overlay */
.modal {
    display: none;
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0, 0, 0, 0.6);
    padding-top: 60px;
}

/* Modal Content */
.modal-content {
    background-color: #ffffff;
    margin: 5% auto;
    padding: 15px;
    border: 1px solid #888;
    width: 80%;
    max-width: 400px;
    border-radius: 8px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
    font-size: 0.9rem;
    animation: fadeInZoom 0.5s;
}

/* Modal Header */
.modal-content h2 {
    color: orange;
    font-size: 1.2rem;
    text-align: center;
    margin-bottom: 15px;
}

/* Close Button */
.close {
    color: #000000;
    float: right;
    font-size: 1.5rem;
    font-weight: bold;
    cursor: pointer;
    transition: color 0.3s ease;
}

.close:hover,
.close:focus {
    color: #000;
    text-decoration: none;
}

/* Paragraph Style */
.modal-content p {
    margin: 10px 0;
    color: #333;
    line-height: 1.4;
}

/* Animation for Modal */
@keyframes fadeInZoom {
    from {
        opacity: 0;
        transform: scale(0.9);
    }
    to {
        opacity: 1;
        transform: scale(1);
    }
}
        .btn-custom-primary {
            background-color: orange;
            border-color: orange;
            color: white;
            font-weight: bold;
            border-radius: 0.375rem;
            padding: 0.75rem 1.5rem;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
        }
        .btn-custom-primary:hover {
            background-color: darkorange;
            border-color: darkorange;
        }
        .btn-custom-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
            color: white;
            font-weight: bold;
            border-radius: 0.375rem;
            padding: 0.75rem 1.5rem;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
        }
        .btn-custom-secondary:hover {
            background-color: #5a6268;
            border-color: #545b62;
        }
        .btn-custom-info {
            background-color: #17a2b8;
            border-color: #17a2b8;
            color: white;
            font-weight: bold;
            border-radius: 0.375rem;
            padding: 0.75rem 1.5rem;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
        }
        .btn-custom-info:hover {
            background-color: #138496;
            border-color: #117a8b;
        }
        .btn-icon {
            margin-left: 0.5rem;
            fill: white;
        }

    .border-custom {
        border: 2px solid orange !important;
    }
    .btn-custom-primary {
        background-color: orange;
        border-color: orange;
        color: white;
    }
    .btn-custom-primary:hover {
        background-color: darkorange;
        border-color: darkorange;
    }
    .btn-custom-secondary {
        background-color: #6c757d;
        border-color: #6c757d;
        color: white;
    }
    .btn-custom-secondary:hover {
        background-color: #5a6268;
        border-color: #545b62;
    }
    .btn-custom-info {
        background-color: #17a2b8;
        border-color: #17a2b8;
        color: white;
    }
    .btn-custom-info:hover {
        background-color: #138496;
        border-color: #117a8b;
    }
    .card {
        border-radius: 0.5rem;
        transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
    }
    .card:hover {
        transform: scale(1.02);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }
    .chart-animation {
        animation: fadeIn 1s ease-in-out;
    }
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
</style>
@endsection





**********************************************************************************************

@extends('layouts.app')

@section('content')
    <div class="container mt-4">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="titrepage">
     <h4>INSCRIPTION</h4>
  </div>

  <style>
    .button-container {
        display: flex;
        justify-content: space-between;
        width: 100%; /* Le conteneur occupe 100% de la largeur de l'écran */
        max-width: 100%; /* Limite la largeur maximale pour grands écrans */
        background-color: #695959;
        color: white;
        font-weight: bold;
        border-radius: 25px;
        padding: 5px;
        position: relative;
        margin: 5px auto; /* Centrer le conteneur horizontalement */
        bottom: 5px;
        margin: 20px;
    }

    .toggle-btn {
        width: 48%; /* Chaque bouton occupe presque la moitié de la largeur */
        padding: 10px;
        font-size: 15px;
        border: none;
        color: white;
        font-weight: bold;
        background-color: transparent;
        cursor: pointer;
        transition: background-color 0.3s ease, transform 0.3s ease;
        border-radius: 25px;
        z-index: 1; /* Assure que les boutons restent au-dessus du fond */

    }

    .toggle-btn.active {
        color: white;
        border: none;
    }
    .toggle-btn.hover {
        border: none;
    }

    .content52 {
        margin-top: 30px;

        text-align: center;
        width: 100%;
        margin: auto;
    }

    .background {
        position: absolute;
        height: 80%;
        width: 48%; /* La largeur du fond rouge correspond à celle des boutons */
        background-color: #E81075;
        border-radius: 25px;
        border:none;
        top: 5px;
        left: -3px;
        transition: transform 0.3s ease;
    }

        .selectville {
        background-color: #E81075;  /* Couleur de fond */
        color: white;               /* Couleur du texte */
        border: none;               /* Suppression de la bordure par défaut */
        border-radius: 15px;        /* Bord arrondi de 15px */
        padding: 10px 15px;         /* Espacement intérieur pour plus de confort */
        font-size: 16px;            /* Taille du texte */
        cursor: pointer;            /* Curseur en mode pointer */
        outline: none;              /* Suppression du contour lors de la sélection */
    }

    .selectville option {
        color: black;               /* Couleur des options pour contraste */
        background-color: white;    /* Couleur de fond des options */
    }

    </style>

  <form  action="{{ route('users.store') }}" method="POST"  class="formulaireinscri" id="myForm2" enctype="multipart/form-data" >


    @csrf
        <div class="logoinscr">
        <svg xmlns="http://www.w3.org/2000/svg" width="54" height="54" viewBox="0 0 24 24" style="fill: #E81075;transform: ;msFilter:;"><path d="M19 8h-2v3h-3v2h3v3h2v-3h3v-2h-3zM4 8a3.91 3.91 0 0 0 4 4 3.91 3.91 0 0 0 4-4 3.91 3.91 0 0 0-4-4 3.91 3.91 0 0 0-4 4zm6 0a1.91 1.91 0 0 1-2 2 1.91 1.91 0 0 1-2-2 1.91 1.91 0 0 1 2-2 1.91 1.91 0 0 1 2 2zM4 18a3 3 0 0 1 3-3h2a3 3 0 0 1 3 3v1h2v-1a5 5 0 0 0-5-5H7a5 5 0 0 0-5 5v1h2z"></path></svg>
        </div>
        {{-- <div style="display: flex;flex-wrap: wrap;gap:5px;width:90%;"> --}}



        <div class="form-group">
            <label class="labelcache" for="email">Email</label>
            <input class="inputtext" type="email" id="email"  name="email" placeholder="Email" oninput="afficherLabel(this)">
            <span id="error-message2" class="errorcodoction" >Veuillez entrer un email.</span>
        </div>
        <div class="form-group">
            <label class="labelcache" for="pseudo">Pseudo/Prénom</label>
            <input class="inputtext" type="text" id="pseudo" name="name" placeholder="Pseudo/Prénom" oninput="afficherLabel(this)">
            <span id="error-message1" class="errorcodoction" >Veuillez créer un pseudo.</span>
        </div>

        <div class="button-container">
            <div class="background"></div> <!-- Élément de fond -->
            <button id="btn1" class="toggle-btn" onclick="showContent('content1', this)">Homme <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" style="fill: rgb(255, 255, 255);transform: ;msFilter:;"><path d="M20 11V4h-7l2.793 2.793-4.322 4.322A5.961 5.961 0 0 0 8 10c-3.309 0-6 2.691-6 6s2.691 6 6 6 6-2.691 6-6c0-1.294-.416-2.49-1.115-3.471l4.322-4.322L20 11zM8 20c-2.206 0-4-1.794-4-4s1.794-4 4-4 4 1.794 4 4-1.794 4-4 4z"></path></svg></button>
            <button id="btn2" class="toggle-btn" onclick="showContent('content2', this)">Femme <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" style="fill: rgb(255, 255, 255);transform: ;msFilter:;"><path d="M12 2C8.691 2 6 4.691 6 8c0 2.967 2.167 5.432 5 5.91V17H8v2h3v2.988h2V19h3v-2h-3v-3.09c2.833-.479 5-2.943 5-5.91 0-3.309-2.691-6-6-6zm0 10c-2.206 0-4-1.794-4-4s1.794-4 4-4 4 1.794 4 4-1.794 4-4 4z"></path></svg></button>
        </div>

        <div id="content1" class="content52"></div>
        <div id="content2" class="content52" style="display: none;">

        <div class="form-group">
            <label class="labelcache" for="pseudo">Numéro de téléphone</label>
            <input class="inputtext" id="numtel" type="tel"  name="tel" placeholder="Numéro de téléphone" oninput="afficherLabel(this)">
            <span id="error-message5" class="errorcodoction">Veuillez entré votre de numero téléphone.</span>
        </div>

        <div class="form-group">
            <label class="labelcache" for="pseudo">Age</label>
            <input class="inputtext" type="number" id="age" name="age" placeholder="Age" oninput="afficherLabel(this)">
            <span id="error-message6" class="errorcodoction" >Veuillez entrer votre age.</span>
        </div>


        <select class="selectville" name="city" id="ville">
            <option value=" ">Choisir votre ville</option>
            <option  value="Abomey-calavi">Abomey-calavi</option>
            <option value="Abidjan">Abidjan</option>
            <option value="Cotonou">Cotonou</option>
            <option value="Lome">Lome</option>
            <option value="Parakou">Parakou</option>
        </select>

        <br>
       <select class="selectville" name="skin_tone" id="form">
       <option value=" "  >Choisir votre forme</option>
            <option  value="Skiny">skiny</option>
            <option value="Apouchou">apouchou</option>
            <option value="normale">normale</option>
       </select>
       <br>

        <div class="file-input-container">
                    <label for="file" class="file-label">Choisir une photo profil</label>
                    <input type="file" id="file" class="file-input" name="imgprofil" onchange="showFileName()">
                    <span id="file-name" class="file-name">Aucun fichier choisi</span>
                    <span id="error-message7" class="errorcodoction" >Veuillez entrer une photo de profil.</span>
                </div> <br>


        </div>

        <div class="form-group">
            <label class="labelcache" for="motpass">Mot de passe</label>
            <input class="inputtext" type="text" id="motpass" name="password" placeholder="Mot de passe" oninput="afficherLabel(this)">
            <span id="error-message3" class="errorcodoction" >Veuillez entrer un mot de passe.</span>
        </div>
        <div class="form-group">
            <label class="labelcache" for="confirmmotpass">Confirmer le mot de passe</label>
            <input class="inputtext" type="text" id="confirmmotpass" placeholder="Confimer le mot de passe" name="confirmmotpass" oninput="afficherLabel(this)">
            <span id="error-message4" class="errorcodoction" >Veuillez confirmer votre mot de passe.</span>
            <div id="passwordError" class="text-danger mt-2" style="display: none;">Les mots de passe ne correspondent pas</div>
        </div>


        <div class="form-group">
            <input type="checkbox" name="condition" id="agree" >
            <label class="checkboxcondition"  for="confirmmotpass">J'accepte les conditions.</label>
            <span id="error-message" class="errorcodoction" >Veuillez accepter les conditions pour continuer.</span>
        </div>


         <div class="btninscri">
            <button class="btninscription" type="submit" name="inscription"  >inscription</button>
        </div>



        <div class="dejacompte">
            Vous avez déjà  un compte ? <br> <br>
            <a href="{{ route('login') }}" class="connectezvous">Connectez-vous </a>
        </div>
  </form>




  <script>
        function showFileName() {
        var input = document.getElementById('file');
        var fileNameDisplay = document.getElementById('file-name');
        if (input.files.length > 0) {
            fileNameDisplay.textContent = input.files[0].name;
        } else {
            fileNameDisplay.textContent = 'Aucun fichier choisi';
        }
    }

    document.querySelector('form').addEventListener('submit', function (event) {
        const password = document.getElementById('motpass').value;
        const confirmPassword = document.getElementById('confirmmotpass').value;

        if (password !== confirmPassword) {
            event.preventDefault(); // Empêche la soumission du formulaire
            document.getElementById('passwordError').style.display = 'block';
        } else {
            document.getElementById('passwordError').style.display = 'none';
        }
    });


    document.getElementById('myForm2').addEventListener('submit', function(event) {
        // event.preventDefault();
        // event.preventDefault(); // Empêcher la soumission du formulaire


    var checkbox = document.getElementById('agree');
    var errorMessage = document.getElementById('error-message');

    var email = document.getElementById("email").value;
    var motpass = document.getElementById("motpass").value;
    var confirmmotpass = document.getElementById("confirmmotpass").value;
    var pseudo = document.getElementById("pseudo").value;

    var errorMessage1 = document.getElementById('error-message1');
    var errorMessage2 = document.getElementById('error-message2');
    var errorMessage3 = document.getElementById('error-message3');
    var errorMessage4 = document.getElementById('error-message4');
    var errorMessage5 = document.getElementById('error-message5');
    var errorMessage6 = document.getElementById('error-message6');
    var errorMessage7 = document.getElementById('error-message7');
    var errorMessage8 = document.getElementById('error-message8');
    if(email === "") {
        // console.log('error');
      errorMessage2.style.display = 'block';
      event.preventDefault(); // Empêcher la soumission du formulaire
    }else if(pseudo === ""){
      errorMessage1.style.display = 'block';
      event.preventDefault(); // Empêcher la soumission du formulaire

    }else  if(motpass === ""){
      errorMessage3.style.display = 'block';
      event.preventDefault(); // Empêcher la soumission du formulaire

    } else if(confirmmotpass === ""){
      errorMessage4.style.display = 'block';
      event.preventDefault(); // Empêcher la soumission du formulaire
    }else if (!checkbox.checked) {
        event.preventDefault(); // Empêche la soumission du formulaire
        errorMessage.style.display = 'block'; // Affiche le message d'erreur
    } else {
        errorMessage.style.display = 'none'; // Cache le message d'erreur si la case est cochée
        // this.submit();
    }

   });


function showContent(contentId, btn) {
    // Masquer tout le contenu
    document.getElementById('content1').style.display = 'none';
    document.getElementById('content2').style.display = 'none';

    // Afficher le contenu sélectionné
    document.getElementById(contentId).style.display = 'block';

    // Supprimer la classe 'active' de tous les boutons
    var buttons = document.querySelectorAll('.toggle-btn');
    buttons.forEach(function(button) {
        button.classList.remove('active');
    });

    // Ajouter la classe 'active' au bouton cliqué
    btn.classList.add('active');

    // Déplacer le fond rouge sous le bouton cliqué
    var background = document.querySelector('.background');
    var offset = btn.offsetLeft;

    // Ajuster la position du fond rouge
    background.style.transform = `translateX(${offset}px)`;
}


    </script>


@endsection



    // Enregistrer un nouveau client
    public function store(Request $request)
    {
        // Validation des données
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|max:40',
            'age' => 'nullable| numeric|max:40',
            'gender' => 'nullable|string|max:40',
            'tel' => 'nullable|string|max:40',
            'skin_tone' => 'nullable|string|max:40',
            'nbrecredit' => 'nullable|numeric|max:40',
            'imgprofil' => 'nullable|image|mimes:jpeg,png,jpg,gif,wepb|max:2048',
            'city' => 'nullable|string|max:40',
            'role' => 'nullable|string|max:40',
            'statut' => 'nullable|string|max:40',
            'statutcpt' => 'nullable|string|max:40',

        ]);
        if($request->input('skin_tone')&& $request->input('city')&& $request->input('tel')){
            $gender='female';
        }else{
            $gender='male';
        }



        $imagePath = null;

        if ($request->hasFile('imgprofil')) {
            // Récupérer l'image
            $image = $request->file('imgprofil');

            // Générer un nom de fichier unique avec l'extension
            $imageName = time() . '.' . $image->getClientOriginalExtension();

            // Stocker l'image dans le répertoire 'public/images'
            $imagePath = $image->storeAs('public/images', $imageName, 'public');
        }

        // if ($request->hasFile('imgprofil')) {
        //     // Récupérer l'image
        //     $image = $request->file('imgprofil');

        //     // Générer un nom de fichier unique avec l'extension
        //     $imageName = time() . '.' . $image->getClientOriginalExtension();

        //     // Stocker l'image dans le répertoire 'public/images'
        //     $imagePath = $image->storeAs('public/images', $imageName, 'public');
        // }



        // Création d'un nouvel utilisateur avec le mot de passe haché
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Hachage du mot de passe
            'age' => $request->age,
            'gender' => $gender,
            'tel' => $request->tel,
            'nbrecredit' => 0,
            'skin_tone' => $request->skin_tone,
            'role' => 'user',
            'city' => $request->city, // Ajout de la profession
            'imgprofil' => $imagePath, // Ajout du chemin de l'image
            'statut' => 'occupé', // Valeur par défaut
            'statutcpt' => 'nonvalide', // Valeur par défaut
        ]);


        if (auth()->check() && auth()->user()->role === 'admin') {
            // Si l'utilisateur connecté est un admin, redirection vers le tableau de bord admin
            return redirect()->route('users.index')->with('success', 'Client ajouté avec succès.');
        } else {
            // Connexion automatique du nouvel utilisateur
            auth()->login($user);

            // Enregistrer l'activité de connexion dans la table user_activities
            UserActivity::create([
                'user_id' => $user->id,
                'activity_type' => 'login', // Type d'activité, par exemple 'login'
                'activity_time' => now(), // Temps de l'activité
            ]);

            // Redirection vers le tableau de bord spécifique du nouvel utilisateur
            return redirect()->route('users.index')->with('success', 'Vous êtes maintenant connecté.');
        }


*******************************************************
@extends('layouts.app')

@section('content')
    <div class="container mt-4">
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

     </div>

  <style>
    .button-container {
        display: flex;
        justify-content: center;
        width: 80%; /* Le conteneur occupe 100% de la largeur de l'écran */
        max-width: 100%; /* Limite la largeur maximale pour grands écrans */
        background-color: #695959;
        color: white;
        font-weight: bold;
        border-radius: 10px;
        padding: 5px;
        position: relative;
        margin: 5px auto; /* Centrer le conteneur horizontalement */
        bottom: 5px;
        margin: auto;
    }

    .toggle-btn {
        width: 48%; /* Chaque bouton occupe presque la moitié de la largeur */
        padding: 10px;
        font-size: 15px;
        border: none;
        color: white;
        font-weight: bold;
        background-color: transparent;
        cursor: pointer;
        transition: background-color 0.3s ease, transform 0.3s ease;
        border-radius: 10px;
        z-index: 1; /* Assure que les boutons restent au-dessus du fond */

    }

    .toggle-btn.active {
        color: white;
        border: none;
    }
    .toggle-btn.hover {
        border: none;
    }

    .content52 {
        margin-top: 30px;

        text-align: center;
        width: 100%;
        margin: auto;
    }

    .background {
        position: absolute;
        height: 80%;
        width: 48%; /* La largeur du fond rouge correspond à celle des boutons */
        background-color: #E81075;
        border-radius: 10px;
        border:none;
        top: 5px;
        left: -3px;
        transition: transform 0.3s ease;
    }

    shelect {
        background-color: #E81075;  /* Couleur de fond */
        color: white;               /* Couleur du texte */
        border: none;               /* Suppression de la bordure par défaut */
        border-radius: 15px;        /* Bord arrondi de 15px */
        padding: 10px 15px;         /* Espacement intérieur pour plus de confort */
        font-size: 16px;            /* Taille du texte */
        cursor: pointer;            /* Curseur en mode pointer */
        outline: none;              /* Suppression du contour lors de la sélection */
    }

    .selectville option {
        color: black;               /* Couleur des options pour contraste */
        background-color: white;    /* Couleur de fond des options */
    }




        .form-control {
            width: 100%;
            padding: 8px;
            font-size: 14px;
        }

        .form-group {
    margin-bottom: 15px;
}
.country-selector {
    width: 50px !important; /* Force la largeur à 100px */
    min-width: 100px !important; /* Évite que la largeur s'étende */
    max-width: 100px !important; /* Évite tout dépassement */
    border: 3px solid #E81075;
    border-radius: 4px;
    margin-right: 10px;
    height: 40px;
    font-size: 14px;
}
.inputtext {
    flex: 1;
    height: 40px;
    font-size: 14px;
}


.inputtext:focus {
    border-color: #E81075;
    box-shadow: 0 0 5px rgba(232, 16, 117, 0.5);
}

.errorcodoction {
    font-size: 12px;
    color: red;
    display: none;
}

div[style*="position: relative;"] {
    display: flex;
    align-items: center;
}


    </style>

    <div class="lesparties">

        <div class="partimg">
            <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 35rem;"
            src="{{ asset('storage/public/images/couple2.png') }}" >
           <h3 style="font-family: cursive;color:#f02882">Bienvenu sur Kuqplan</h3>
        </div>


            <form  action="{{ route('users.store') }}" method="POST"  class="formulaireinscri" id="myForm2" enctype="multipart/form-data" >


                @csrf
                <div class="logoinscr">
                    <svg xmlns="http://www.w3.org/2000/svg" width="54" height="54" viewBox="0 0 24 24" style="fill: #E81075;transform: ;msFilter:;"><path d="M19 8h-2v3h-3v2h3v3h2v-3h3v-2h-3zM4 8a3.91 3.91 0 0 0 4 4 3.91 3.91 0 0 0 4-4 3.91 3.91 0 0 0-4-4 3.91 3.91 0 0 0-4 4zm6 0a1.91 1.91 0 0 1-2 2 1.91 1.91 0 0 1-2-2 1.91 1.91 0 0 1 2-2 1.91 1.91 0 0 1 2 2zM4 18a3 3 0 0 1 3-3h2a3 3 0 0 1 3 3v1h2v-1a5 5 0 0 0-5-5H7a5 5 0 0 0-5 5v1h2z"></path></svg>
                   <h3 style="color:#741c43">S'inscrire</h3>
                </div>
                    {{-- <div style="display: flex;flex-wrap: wrap;gap:5px;width:90%;"> --}}

                    <div class="form-group">
                        <label class="labelcache" for="email">Email</label>
                        <input class="inputtext" type="email" id="email"  name="email" placeholder="Email" oninput="afficherLabel(this)">
                        <span id="error-message2" class="errorcodoction" >Veuillez entrer un email.</span>
                    </div>
                    <div class="form-group">
                        <label class="labelcache" for="pseudo">Pseudo/Prénom</label>
                        <input class="inputtext" type="text" id="pseudo" name="name" placeholder="Pseudo/Prénom" oninput="afficherLabel(this)">
                        <span id="error-message1" class="errorcodoction" >Veuillez créer un pseudo.</span>
                    </div>

                    <div class="button-container">
                        <div class="background"></div> <!-- Élément de fond -->
                        <button id="btn1" class="toggle-btn" onclick="showContent('content1', this)">Homme <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" style="fill: rgb(255, 255, 255);transform: ;msFilter:;"><path d="M20 11V4h-7l2.793 2.793-4.322 4.322A5.961 5.961 0 0 0 8 10c-3.309 0-6 2.691-6 6s2.691 6 6 6 6-2.691 6-6c0-1.294-.416-2.49-1.115-3.471l4.322-4.322L20 11zM8 20c-2.206 0-4-1.794-4-4s1.794-4 4-4 4 1.794 4 4-1.794 4-4 4z"></path></svg></button>
                        <button id="btn2" class="toggle-btn" onclick="showContent('content2', this)">Femme <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" style="fill: rgb(255, 255, 255);transform: ;msFilter:;"><path d="M12 2C8.691 2 6 4.691 6 8c0 2.967 2.167 5.432 5 5.91V17H8v2h3v2.988h2V19h3v-2h-3v-3.09c2.833-.479 5-2.943 5-5.91 0-3.309-2.691-6-6-6zm0 10c-2.206 0-4-1.794-4-4s1.794-4 4-4 4 1.794 4 4-1.794 4-4 4z"></path></svg></button>
                    </div>

                    <div id="content1" class="content52"></div>
                    <div id="content2" class="content52" style="display: none;">



                        <div class="form-group">
                            <label for="tel">Numéro de téléphone</label>
                            <div style="display: flex; align-items: center;">
                                <select id="country-code" class="country-selector" name="country_code">
                                    <option value="+229" data-flag="🇧🇯">Bénin (+229)</option>
                                    <option value="+228" data-flag="🇹🇬">Togo (+228)</option>
                                    <option value="+225" data-flag="🇨🇮">Côte d'Ivoire (+225)</option>
                                    <option value="+221" data-flag="🇸🇳">Sénégal (+221)</option>
                                    <option value="+223" data-flag="🇲🇱">Mali (+223)</option>
                                </select>
                                <input class="inputtext" id="numtel" type="tel" name="tel" placeholder="Numéro de téléphone">
                            </div>
                            <span id="error-message5" class="errorcodoction">Veuillez entrer votre numéro de téléphone.</span>
                        </div>






                    <div class="form-group">
                        <label class="labelcache" for="pseudo">Age</label>
                        <input class="inputtext" type="number" id="age" name="age" placeholder="Age" oninput="afficherLabel(this)">
                        <span id="error-message6" class="errorcodoction" >Veuillez entrer votre age.</span>
                    </div>

                    <div class="form-group" style="width: 250px;text-align:center;margin:auto;">
                    <select  class="inputtext" style="padding: 8px;"  name="city" id="ville">
                        <option value=" ">Choisir votre ville</option>
                        <option  value="Abomey-calavi">Abomey-calavi</option>
                        <option value="Abidjan">Abidjan</option>
                        <option value="Cotonou">Cotonou</option>
                        <option value="Lome">Lome</option>
                        <option value="Parakou">Parakou</option>
                    </select>
                </div>


                    <br>
                    <div class="form-group" style="width: 250px;text-align:center;margin:auto;">
                   <select class="inputtext"  name="skin_tone" id="form">
                   <option value=" "  >Choisir votre forme</option>
                        <option  value="Skiny">skiny</option>
                        <option value="Apouchou">apouchou</option>
                        <option value="normale">normale</option>
                   </select>
                </div>
                   <br>

                    <div class="file-input-container">
                                <label for="file" class="file-label">Choisir une photo profil</label>
                                <input type="file" id="file" class="file-input" name="imgprofil" onchange="showFileName()">
                                <span id="file-name" class="file-name">Aucun fichier choisi</span>
                                <span id="error-message7" class="errorcodoction" >Veuillez entrer une photo de profil.</span>
                            </div> <br>


                    </div>

                    <div class="form-group">
                        <label class="labelcache" for="motpass">Mot de passe</label>
                        <input class="inputtext" type="text" id="motpass" name="password" placeholder="Mot de passe" oninput="afficherLabel(this)">
                        <span id="error-message3" class="errorcodoction" >Veuillez entrer un mot de passe.</span>
                    </div>
                    <div class="form-group">
                        <label class="labelcache" for="confirmmotpass">Confirmer le mot de passe</label>
                        <input class="inputtext" type="text" id="confirmmotpass" placeholder="Confimer le mot de passe" name="confirmmotpass" oninput="afficherLabel(this)">
                        <span id="error-message4" class="errorcodoction" >Veuillez confirmer votre mot de passe.</span>
                        <div id="passwordError" class="text-danger mt-2" style="display: none;">Les mots de passe ne correspondent pas</div>
                    </div>


                    <div class="form-group">
                        <input type="checkbox" name="condition" id="agree" >
                        <label class="checkboxcondition"  for="confirmmotpass">J'accepte les conditions.</label>
                        <span id="error-message" class="errorcodoction" >Veuillez accepter les conditions pour continuer.</span>
                    </div>


                     <div class="btninscri">
                        <button class="btninscription" id="submit-form" type="submit" name="inscription"  >inscription</button>
                    </div>



                    <div class="dejacompte">
                        Vous avez déjà  un compte ? <br> <br>
                        <a href="{{ route('login') }}" class="connectezvous">Connectez-vous </a>
                    </div>
              </form>


    </div>






  <script>

        document.getElementById("submit-form").addEventListener("click", function(event) {
            event.preventDefault(); // Empêche l'envoi immédiat du formulaire

            // Récupérer la valeur de l'indicatif du pays
            var countryCode = document.getElementById("country-code").value;

            // Récupérer la valeur du numéro de téléphone
            var phoneNumber = document.getElementById("numtel").value;

            // Concaténer l'indicatif et le numéro de téléphone
            var fullPhoneNumber = countryCode + phoneNumber;

            // Ajouter le numéro de téléphone complet au formulaire (si vous soumettez via JavaScript)
            var phoneField = document.createElement("input");
            phoneField.type = "hidden"; // Cacher ce champ dans le formulaire
            phoneField.name = "tel"; // Le même nom que dans le formulaire
            phoneField.value = fullPhoneNumber;

            // Ajoutez ce champ caché au formulaire avant de soumettre
            document.forms[0].appendChild(phoneField);

            // Soumettre le formulaire
            document.forms[0].submit();
        });


                function updatePrefix() {
            const select = document.getElementById('country-code');
            const selectedOption = select.options[select.selectedIndex];
            const prefix = selectedOption.value;

            // Inject the prefix directly into the input as a placeholder
            const input = document.getElementById('numtel');
            input.placeholder = `Numéro de téléphone (${prefix})`;
        }

        function showFileName() {
        var input = document.getElementById('file');
        var fileNameDisplay = document.getElementById('file-name');
        if (input.files.length > 0) {
            fileNameDisplay.textContent = input.files[0].name;
        } else {
            fileNameDisplay.textContent = 'Aucun fichier choisi';
        }
    }

    document.querySelector('form').addEventListener('submit', function (event) {
        const password = document.getElementById('motpass').value;
        const confirmPassword = document.getElementById('confirmmotpass').value;

        if (password !== confirmPassword) {
            event.preventDefault(); // Empêche la soumission du formulaire
            document.getElementById('passwordError').style.display = 'block';
        } else {
            document.getElementById('passwordError').style.display = 'none';
        }
    });


    document.getElementById('myForm2').addEventListener('submit', function(event) {
        // event.preventDefault();
        // event.preventDefault(); // Empêcher la soumission du formulaire


    var checkbox = document.getElementById('agree');
    var errorMessage = document.getElementById('error-message');

    var email = document.getElementById("email").value;
    var motpass = document.getElementById("motpass").value;
    var confirmmotpass = document.getElementById("confirmmotpass").value;
    var pseudo = document.getElementById("pseudo").value;

    var errorMessage1 = document.getElementById('error-message1');
    var errorMessage2 = document.getElementById('error-message2');
    var errorMessage3 = document.getElementById('error-message3');
    var errorMessage4 = document.getElementById('error-message4');
    var errorMessage5 = document.getElementById('error-message5');
    var errorMessage6 = document.getElementById('error-message6');
    var errorMessage7 = document.getElementById('error-message7');
    var errorMessage8 = document.getElementById('error-message8');
    if(email === "") {
        // console.log('error');
      errorMessage2.style.display = 'block';
      event.preventDefault(); // Empêcher la soumission du formulaire
    }else if(pseudo === ""){
      errorMessage1.style.display = 'block';
      event.preventDefault(); // Empêcher la soumission du formulaire

    }else  if(motpass === ""){
      errorMessage3.style.display = 'block';
      event.preventDefault(); // Empêcher la soumission du formulaire

    } else if(confirmmotpass === ""){
      errorMessage4.style.display = 'block';
      event.preventDefault(); // Empêcher la soumission du formulaire
    }else if (!checkbox.checked) {
        event.preventDefault(); // Empêche la soumission du formulaire
        errorMessage.style.display = 'block'; // Affiche le message d'erreur
    } else {
        errorMessage.style.display = 'none'; // Cache le message d'erreur si la case est cochée
        // this.submit();
    }

   });


function showContent(contentId, btn) {
    // Masquer tout le contenu
    document.getElementById('content1').style.display = 'none';
    document.getElementById('content2').style.display = 'none';

    // Afficher le contenu sélectionné
    document.getElementById(contentId).style.display = 'block';

    // Supprimer la classe 'active' de tous les boutons
    var buttons = document.querySelectorAll('.toggle-btn');
    buttons.forEach(function(button) {
        button.classList.remove('active');
    });

    // Ajouter la classe 'active' au bouton cliqué
    btn.classList.add('active');

    // Déplacer le fond rouge sous le bouton cliqué
    var background = document.querySelector('.background');
    var offset = btn.offsetLeft;

    // Ajuster la position du fond rouge
    background.style.transform = `translateX(${offset}px)`;
}


    </script>


@endsection





    document.getElementById('myForm2').addEventListener('submit', function(event) {
        // event.preventDefault();
        // event.preventDefault(); // Empêcher la soumission du formulaire


    var checkbox = document.getElementById('agree');
    var errorMessage = document.getElementById('error-message');

    var email = document.getElementById("email").value;
    var motpass = document.getElementById("motpass").value;
    var confirmmotpass = document.getElementById("confirmmotpass").value;
    var pseudo = document.getElementById("pseudo").value;

    var errorMessage1 = document.getElementById('error-message1');
    var errorMessage2 = document.getElementById('error-message2');
    var errorMessage3 = document.getElementById('error-message3');
    var errorMessage4 = document.getElementById('error-message4');
    var errorMessage5 = document.getElementById('error-message5');
    var errorMessage6 = document.getElementById('error-message6');
    var errorMessage7 = document.getElementById('error-message7');
    var errorMessage8 = document.getElementById('error-message8');
    if(email === "") {
        // console.log('error');
      errorMessage2.style.display = 'block';
      event.preventDefault(); // Empêcher la soumission du formulaire
    }else if(pseudo === ""){
      errorMessage1.style.display = 'block';
      event.preventDefault(); // Empêcher la soumission du formulaire

    }else  if(motpass === ""){
      errorMessage3.style.display = 'block';
      event.preventDefault(); // Empêcher la soumission du formulaire

    } else if(confirmmotpass === ""){
      errorMessage4.style.display = 'block';
      event.preventDefault(); // Empêcher la soumission du formulaire
    }else if (!checkbox.checked) {
        event.preventDefault(); // Empêche la soumission du formulaire
        errorMessage.style.display = 'block'; // Affiche le message d'erreur
    } else {
        errorMessage.style.display = 'none'; // Cache le message d'erreur si la case est cochée
        // this.submit();
    }

   });



   *************************************
   @extends('layouts.app')

@section('content')
    <div class="container mt-4">
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

     </div>

  <style>
    .button-container {
        display: flex;
        justify-content: center;
        width: 80%; /* Le conteneur occupe 100% de la largeur de l'écran */
        max-width: 100%; /* Limite la largeur maximale pour grands écrans */
        background-color: #695959;
        color: white;
        font-weight: bold;
        border-radius: 10px;
        padding: 5px;
        position: relative;
        margin: 5px auto; /* Centrer le conteneur horizontalement */
        bottom: 5px;
        margin: auto;
    }

    .toggle-btn {
        width: 48%; /* Chaque bouton occupe presque la moitié de la largeur */
        padding: 10px;
        font-size: 15px;
        border: none;
        color: white;
        font-weight: bold;
        background-color: transparent;
        cursor: pointer;
        transition: background-color 0.3s ease, transform 0.3s ease;
        border-radius: 10px;
        z-index: 1; /* Assure que les boutons restent au-dessus du fond */

    }

    .toggle-btn.active {
        color: white;
        border: none;
    }
    .toggle-btn.hover {
        border: none;
    }

    .content52 {
        margin-top: 30px;

        text-align: center;
        width: 100%;
        margin: auto;
    }

    .background {
        position: absolute;
        height: 80%;
        width: 48%; /* La largeur du fond rouge correspond à celle des boutons */
        background-color: #E81075;
        border-radius: 10px;
        border:none;
        top: 5px;
        left: -3px;
        transition: transform 0.3s ease;
    }

    shelect {
        background-color: #E81075;  /* Couleur de fond */
        color: white;               /* Couleur du texte */
        border: none;               /* Suppression de la bordure par défaut */
        border-radius: 15px;        /* Bord arrondi de 15px */
        padding: 10px 15px;         /* Espacement intérieur pour plus de confort */
        font-size: 16px;            /* Taille du texte */
        cursor: pointer;            /* Curseur en mode pointer */
        outline: none;              /* Suppression du contour lors de la sélection */
    }

    .selectville option {
        color: black;               /* Couleur des options pour contraste */
        background-color: white;    /* Couleur de fond des options */
    }




        .form-control {
            width: 100%;
            padding: 8px;
            font-size: 14px;
        }

        .form-group {
    margin-bottom: 15px;
}
.country-selector {
    width: 50px !important; /* Force la largeur à 100px */
    min-width: 100px !important; /* Évite que la largeur s'étende */
    max-width: 100px !important; /* Évite tout dépassement */
    border: 3px solid #E81075;
    border-radius: 4px;
    margin-right: 10px;
    height: 40px;
    font-size: 14px;
}
.inputtext {
    flex: 1;
    height: 40px;
    font-size: 14px;
}


.inputtext:focus {
    border-color: #E81075;
    box-shadow: 0 0 5px rgba(232, 16, 117, 0.5);
}

.errorcodoction {
    font-size: 12px;
    color: red;
    display: none;
}

div[style*="position: relative;"] {
    display: flex;
    align-items: center;
}


    </style>

    <div class="lesparties">

        <div class="partimg">
            <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 35rem;"
            src="{{ asset('storage/public/images/couple2.png') }}" >
           <h3 style="font-family: cursive;color:#f02882">Bienvenu sur Kuqplan</h3>
        </div>


        <form action="{{ route('users.store') }}" method="POST" class="formulaireinscri" id="myForm4" enctype="multipart/form-data">
            @csrf
            <div class="logoinscr">
                <svg xmlns="http://www.w3.org/2000/svg" width="54" height="54" viewBox="0 0 24 24" style="fill: #E81075;">
                    <path d="M19 8h-2v3h-3v2h3v3h2v-3h3v-2h-3zM4 8a3.91 3.91 0 0 0 4 4 3.91 3.91 0 0 0 4-4 3.91 3.91 0 0 0-4-4 3.91 3.91 0 0 0-4 4zm6 0a1.91 1.91 0 0 1-2 2 1.91 1.91 0 0 1-2-2 1.91 1.91 0 0 1 2-2 1.91 1.91 0 0 1 2 2zM4 18a3 3 0 0 1 3-3h2a3 3 0 0 1 3 3v1h2v-1a5 5 0 0 0-5-5H7a5 5 0 0 0-5 5v1h2z"></path>
                </svg>
                <h3 style="color:#741c43">S'inscrire</h3>
            </div>
        
            <div class="form-group">
                <label class="labelcache" for="email">Email</label>
                <input class="inputtext" type="email" id="email" name="email" value="{{ old('email') }}" placeholder="Email" oninput="afficherLabel(this)">
                <span id="error-message2" class="errorcodoction">Veuillez entrer un email.</span>
            </div>
        
            <div class="form-group">
                <label class="labelcache" for="pseudo">Pseudo/Prénom</label>
                <input class="inputtext" type="text" id="pseudo" name="name" value="{{ old('name') }}" placeholder="Pseudo/Prénom" oninput="afficherLabel(this)">
                <span id="error-message1" class="errorcodoction">Veuillez créer un pseudo.</span>
            </div>
        
            <div class="form-group" style="width: 250px; text-align: center; margin: 10px auto;">
                <select class="inputtext" name="skin_tone" id="genderSelect" onchange="showContentBasedOnGender()">
                    <option value="homme" {{ old('gender') == 'homme' ? 'selected' : '' }}>Homme</option>
                    <option value="femme" {{ old('gender') == 'femme' ? 'selected' : '' }}>Femme</option>
                </select>
            </div>
        
            <div id="content1" class="content52"></div>
            <div id="content2" class="content52" style="display: none;">
                <div class="form-group">
                    <div style="display: flex; align-items: center;">
                        <select id="country-code" class="country-selector" name="country_code">
                            <option value="+229" data-flag="🇧🇯" {{ old('country_code') == '+229' ? 'selected' : '' }}>Bénin (+229)</option>
                            <option value="+228" data-flag="🇹🇬" {{ old('country_code') == '+228' ? 'selected' : '' }}>Togo (+228)</option>
                            <option value="+225" data-flag="🇨🇮" {{ old('country_code') == '+225' ? 'selected' : '' }}>Côte d'Ivoire (+225)</option>
                            <option value="+221" data-flag="🇸🇳" {{ old('country_code') == '+221' ? 'selected' : '' }}>Sénégal (+221)</option>
                            <option value="+223" data-flag="🇲🇱" {{ old('country_code') == '+223' ? 'selected' : '' }}>Mali (+223)</option>
                        </select>
                        <input class="inputtext" id="numtel" type="tel" name="tel" value="{{ old('tel') }}" placeholder="Numéro de téléphone">
                    </div>
                    <span id="error-message5" class="errorcodoction">Veuillez entrer votre numéro de téléphone.</span>
                </div>
        
                <div class="form-group">
                    <label class="labelcache" for="pseudo">Age</label>
                    <input class="inputtext" type="number" id="age" name="age" value="{{ old('age') }}" placeholder="Age" oninput="afficherLabel(this)">
                    <span id="error-message6" class="errorcodoction">Veuillez entrer votre âge.</span>
                </div>
        
                <div class="form-group" style="width: 250px; text-align: center; margin: auto;">
                    <select class="inputtext" name="city" id="ville">
                        <option value=" ">{{ old('city') == '' ? 'Choisir votre ville' : old('city') }}</option>
                        <option value="Abomey-calavi" {{ old('city') == 'Abomey-calavi' ? 'selected' : '' }}>Abomey-calavi</option>
                        <option value="Abidjan" {{ old('city') == 'Abidjan' ? 'selected' : '' }}>Abidjan</option>
                        <option value="Cotonou" {{ old('city') == 'Cotonou' ? 'selected' : '' }}>Cotonou</option>
                        <option value="Lome" {{ old('city') == 'Lome' ? 'selected' : '' }}>Lome</option>
                        <option value="Parakou" {{ old('city') == 'Parakou' ? 'selected' : '' }}>Parakou</option>
                    </select>
                </div>
        
                <div class="form-group" style="width: 250px; text-align: center; margin: auto;">
                    <select class="inputtext" name="skin_tone" id="form">
                        <option value=" ">{{ old('skin_tone') == '' ? 'Choisir votre forme' : old('skin_tone') }}</option>
                        <option value="Skiny" {{ old('skin_tone') == 'Skiny' ? 'selected' : '' }}>Skiny</option>
                        <option value="Apouchou" {{ old('skin_tone') == 'Apouchou' ? 'selected' : '' }}>Apouchou</option>
                        <option value="normale" {{ old('skin_tone') == 'normale' ? 'selected' : '' }}>Normale</option>
                    </select>
                </div>
        
                <div class="file-input-container">
                    <label for="file" class="file-label">Choisir une photo de profil</label>
                    <input type="file" id="file" class="file-input" name="imgprofil" onchange="showFileName()">
                    <span id="file-name" class="file-name">{{ old('imgprofil') }}</span>
                    <span id="error-message7" class="errorcodoction">Veuillez entrer une photo de profil.</span>
                </div>
            </div>
        
            <div class="form-group">
                <label class="labelcache" for="motpass">Mot de passe</label>
                <input class="inputtext" type="text" id="motpass" name="password" value="{{ old('password') }}" placeholder="Mot de passe" oninput="afficherLabel(this)">
                <span id="error-message3" class="errorcodoction">Veuillez entrer un mot de passe.</span>
            </div>
        
            <div class="form-group">
                <label class="labelcache" for="confirmmotpass">Confirmer le mot de passe</label>
                <input class="inputtext" type="text" id="confirmmotpass" name="confirmmotpass" value="{{ old('confirmmotpass') }}" placeholder="Confirmer le mot de passe" oninput="afficherLabel(this)">
                <span id="error-message4" class="errorcodoction">Veuillez confirmer votre mot de passe.</span>
                <div id="passwordError" class="text-danger mt-2" style="display: none;">Les mots de passe ne correspondent pas</div>
            </div>

        
            <div class="form-group">
                <input type="checkbox" name="condition" id="agree" >
                <label class="checkboxcondition"  for="confirmmotpass">J'accepte les conditions.</label>
                <span id="error-message9" class="errorcodoction" style="display: none;" >Veuillez accepter les conditions pour continuer.</span>
            </div>


             <div class="btninscri">
                <button class="btninscription" id="submit-form" type="submit" name="inscription"  >inscription</button>
            </div>



            <div class="dejacompte">
                Vous avez déjà  un compte ? <br> <br>
                <a href="{{ route('login') }}" class="connectezvous">Connectez-vous </a>
            </div>
        </form>
        

    </div>


  <script>

function showContentBasedOnGender() {
    var gender = document.getElementById('genderSelect').value;

    // Cacher tous les contenus
    document.getElementById('content1').style.display = 'none';
    document.getElementById('content2').style.display = 'none';

    // Afficher le contenu en fonction du sexe choisi
    if (gender === 'homme') {
        document.getElementById('content1').style.display = 'block';
    } else if (gender === 'femme') {
        document.getElementById('content2').style.display = 'block';
    }
}




    document.getElementById("myForm4").addEventListener("submit", function(event) {
        // Initialiser une variable pour savoir si des erreurs existent
        var hasError = false;

        // Valider pseudo
        var pseudo = document.getElementById("pseudo").value;
        if (pseudo == "") {
            document.getElementById("error-message1").style.display = "block";
            hasError = true;
        } else {
            document.getElementById("error-message1").style.display = "none";
        }

        // Valider email
        var email = document.getElementById("email").value;
        if (email == "") {
            document.getElementById("error-message2").style.display = "block";
            hasError = true;
        } else {
            document.getElementById("error-message2").style.display = "none";
        }

        // Valider téléphone
        var tel = document.getElementById("numtel").value;
        if (tel == "") {
            document.getElementById("error-message5").style.display = "block";
            hasError = true;
        } else {
            document.getElementById("error-message5").style.display = "none";
        }

        // Valider âge
        var age = document.getElementById("age").value;
        if (age == "") {
            document.getElementById("error-message6").style.display = "block";
            hasError = true;
        } else {
            document.getElementById("error-message6").style.display = "none";
        }

        // Valider la photo
        var fileInput = document.getElementById("file");
        if (!fileInput.value) {
            document.getElementById("error-message7").style.display = "block";
            hasError = true;
        } else {
            document.getElementById("error-message7").style.display = "none";
        }

        // Valider le mot de passe
        var password = document.getElementById("motpass").value;
        if (password == "") {
            document.getElementById("error-message3").style.display = "block";
            hasError = true;
        } else {
            document.getElementById("error-message3").style.display = "none";
        }

        // Valider la confirmation du mot de passe
        var passwordConfirmation = document.getElementById("confmotpass").value;
        if (password !== passwordConfirmation) {
            document.getElementById("error-message4").style.display = "block";
            hasError = true;
        } else {
            document.getElementById("error-message4").style.display = "none";
        }

        // Si des erreurs sont détectées, on empêche la soumission du formulaire
        if (hasError) {
            event.preventDefault();
        }
    });




        document.getElementById("submit-form").addEventListener("click", function(event) {
            event.preventDefault(); // Empêche l'envoi immédiat du formulaire

            // Récupérer la valeur de l'indicatif du pays
            var countryCode = document.getElementById("country-code").value;

            // Récupérer la valeur du numéro de téléphone
            var phoneNumber = document.getElementById("numtel").value;

            // Concaténer l'indicatif et le numéro de téléphone
            var fullPhoneNumber = countryCode + phoneNumber;

            // Ajouter le numéro de téléphone complet au formulaire (si vous soumettez via JavaScript)
            var phoneField = document.createElement("input");
            phoneField.type = "hidden"; // Cacher ce champ dans le formulaire
            phoneField.name = "tel"; // Le même nom que dans le formulaire
            phoneField.value = fullPhoneNumber;

            // Ajoutez ce champ caché au formulaire avant de soumettre
            document.forms[0].appendChild(phoneField);

            // Soumettre le formulaire
            document.forms[0].submit();
        });


                function updatePrefix() {
            const select = document.getElementById('country-code');
            const selectedOption = select.options[select.selectedIndex];
            const prefix = selectedOption.value;

            // Inject the prefix directly into the input as a placeholder
            const input = document.getElementById('numtel');
            input.placeholder = `Numéro de téléphone (${prefix})`;
        }

        function showFileName() {
        var input = document.getElementById('file');
        var fileNameDisplay = document.getElementById('file-name');
        if (input.files.length > 0) {
            fileNameDisplay.textContent = input.files[0].name;
        } else {
            fileNameDisplay.textContent = 'Aucun fichier choisi';
        }
    }

    document.querySelector('form').addEventListener('submit', function (event) {
        const password = document.getElementById('motpass').value;
        const confirmPassword = document.getElementById('confirmmotpass').value;

        if (password !== confirmPassword) {
            event.preventDefault(); // Empêche la soumission du formulaire
            document.getElementById('passwordError').style.display = 'block';
        } else {
            document.getElementById('passwordError').style.display = 'none';
        }
    });


    




    </script>


@endsection


 <script>

            function showContentBasedOnGender() {
                var gender = document.getElementById('genderSelect').value;

                // Cacher tous les contenus
                document.getElementById('content1').style.display = 'none';
                document.getElementById('content2').style.display = 'none';

                // Afficher le contenu en fonction du sexe choisi
                if (gender === 'homme') {
                    document.getElementById('content1').style.display = 'block';
                } else if (gender === 'femme') {
                    document.getElementById('content2').style.display = 'block';
                }
            }

            function validateForm() {
        // Get all form elements
        const form = document.getElementById('myForm4');
        const email = document.getElementById('email');
        const pseudo = document.getElementById('pseudo');
        const genderSelect = document.getElementById('genderSelect');
        const countryCode = document.getElementById('country-code');
        const numtel = document.getElementById('numtel');
        const age = document.getElementById('age');
        const ville = document.getElementById('ville');
        const formSelect = document.getElementById('form'); // Assuming this refers to the "skin tone" select
        const file = document.getElementById('file');
        const motpass = document.getElementById('motpass');
        const confirmmotpass = document.getElementById('confirmmotpass');
        const agree = document.getElementById('agree');
        const passwordError = document.getElementById('passwordError');

        // Clear any previous error messages
        clearErrorMessages();

        // Validate email
        if (!isValidEmail(email.value)) {
            showError(email, 'Veuillez entrer un email valide.');
            return false;
        }

        // Validate pseudo
        if (pseudo.value.trim() === '') {
            showError(pseudo, 'Veuillez créer un pseudo.');
            return false;
        }

        // Validate gender-specific fields (if female)
        if (genderSelect.value === 'femme') {
            if (numtel.value.trim() === '') {
            showError(numtel, 'Veuillez entrer votre numéro de téléphone.');
            return false;
            }

            if (isNaN(age.value) || age.value.trim() === '') {
            showError(age, 'Veuillez entrer votre âge.');
            return false;
            }

            if (ville.value === ' ') {
            showError(ville, 'Veuillez choisir votre ville.');
            return false;
            }

            if (formSelect.value === ' ') {
            showError(formSelect, 'Veuillez choisir votre forme.');
            return false;
            }

            if (!file.files.length) {
            showError(file, 'Veuillez choisir une photo de profil.');
            return false;
            }
        }

        // Validate password match
        if (motpass.value !== confirmmotpass.value) {
            showError(confirmmotpass, passwordError, 'Les mots de passe ne correspondent pas.');
            return false;
        }

        // Validate terms and conditions
        if (!agree.checked) {
            showError(agree, 'Veuillez accepter les conditions pour continuer.');
            return false;
        }

        // If all validations pass, allow form submission
        return true;
        }

        function isValidEmail(email) {
        const emailRegex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        return emailRegex.test(email);
        }

        function showError(element, messageElement, errorMessage = '') {
        element.classList.add('error');
        if (messageElement) {
            messageElement.textContent = errorMessage;
            messageElement.style.display = 'block';
        } else {
            const errorSpan = element.nextElementSibling;
            if (errorSpan) {
            errorSpan.textContent = errorMessage;
            errorSpan.style.display = 'block';
            }
        }
        }

        function clearErrorMessages() {
        const errorElements = document.querySelectorAll('.errorcodoction, .text-danger');
        errorElements.forEach(element => {
            element.textContent = '';
            element.style.display = 'none';
        });
        const errorInputs = document.querySelectorAll('.error');
        errorInputs.forEach(element => element.classList.remove('error'));
        }

        const submitButton = document.getElementById('submit-form');
        submitButton.addEventListener('click', function(event) {
        if (!validateForm()) {
            event.preventDefault(); // Prevent form submission if validation 1  fails
        }
        });

        document.getElementById("submit-form").addEventListener("click", function(event) {
            event.preventDefault(); // Empêche l'envoi immédiat du formulaire

            // Récupérer la valeur de l'indicatif du pays
            var countryCode = document.getElementById("country-code").value;

            // Récupérer la valeur du numéro de téléphone
            var phoneNumber = document.getElementById("numtel").value;

            // Concaténer l'indicatif et le numéro de téléphone
            var fullPhoneNumber = countryCode + phoneNumber;

            // Ajouter le numéro de téléphone complet au formulaire (si vous soumettez via JavaScript)
            var phoneField = document.createElement("input");
            phoneField.type = "hidden"; // Cacher ce champ dans le formulaire
            phoneField.name = "tel"; // Le même nom que dans le formulaire
            phoneField.value = fullPhoneNumber;

            // Ajoutez ce champ caché au formulaire avant de soumettre
            document.forms[0].appendChild(phoneField);

            // Soumettre le formulaire
            document.forms[0].submit();
        });


                function updatePrefix() {
            const select = document.getElementById('country-code');
            const selectedOption = select.options[select.selectedIndex];
            const prefix = selectedOption.value;

            // Inject the prefix directly into the input as a placeholder
            const input = document.getElementById('numtel');
            input.placeholder = `Numéro de téléphone (${prefix})`;
        }

        function showFileName() {
        var input = document.getElementById('file');
        var fileNameDisplay = document.getElementById('file-name');
        if (input.files.length > 0) {
            fileNameDisplay.textContent = input.files[0].name;
        } else {
            fileNameDisplay.textContent = 'Aucun fichier choisi';
        }
    }

    document.querySelector('form').addEventListener('submit', function (event) {
        const password = document.getElementById('motpass').value;
        const confirmPassword = document.getElementById('confirmmotpass').value;

        if (password !== confirmPassword) {
            event.preventDefault(); // Empêche la soumission du formulaire
            document.getElementById('passwordError').style.display = 'block';
        } else {
            document.getElementById('passwordError').style.display = 'none';
        }
    });
***************

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\RechargementController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\Auth\ForgotPasswordController;



// Afficher le formulaire pour récupérer le mot de passe



use App\Models\Feedback;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route pour la page d'accueil
// Route::get('/acceuil', [HomeController::class, 'acceuil'])->name('acceuil');



Route::get('/', function () {
    return redirect()->route('acceuil.index');
})->name('home');

// Route::get('/acceuil', function () {
//     return view('acceuil.index');
// })->name('acceuil.index');

Route::get('/users/conditions', function () {
    return view('users.conditions');
})->name('users.conditions');

Route::get('/password/forgot', [PasswordResetController::class, 'showForgotPasswordForm'])->name('password.forgot');
Route::post('/password/send-code', [PasswordResetController::class, 'sendResetCode'])->name('password.send-code');
Route::get('/password/confirm', [PasswordResetController::class, 'showConfirmationForm'])->name('password.confirm');
Route::post('/password/verify-code', [PasswordResetController::class, 'verifyResetCode'])->name('password.verify-code');
Route::get('/password/reset', [PasswordResetController::class, 'showResetForm'])->name('password.reset.form');
Route::post('/password/reset', [PasswordResetController::class, 'resetPassword'])->name('password.reset');




Route::resource('acceuil', HomeController::class);

Route::resource('feedbacks', FeedbackController::class);
Route::get('/users/confirmation', [UserController::class, 'confirmation'])->name('users.confirmation');
Route::post('/users/confirmation', [UserController::class, 'verifyCode'])->name('users.verifyCode');
Route::post('verify/{code}', [UserController::class, 'verify'])->name('users.verify');
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/users/store', [UserController::class, 'store'])->name('users.store');
Route::post('/users', [UserController::class, 'store'])->name('users.store'); // Enregistrer un utilisateur



Route::get('blogs', [BlogController::class, 'index'])->name('blogs.index');
Route::get('blogs/{blog}', [BlogController::class, 'show'])->name('blogs.show');



Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);


// Protection des routes avec le middleware 'auth'
Route::middleware('auth')->group(function () {

    // Route de déconnexion
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Routes protégées par le rôle d'administrateur pour lister les utilisateurs
    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('/users/liste', [UserController::class, 'index2'])->name('users.liste');
        Route::get('/users/listedeleted', [UserController::class, 'index5'])->name('users.listedeleted');
        Route::get('/users/listeactivity', [UserController::class, 'index6'])->name('users.listeactivity');
        Route::get('/users/listedeblocked', [UserController::class, 'index7'])->name('users.listedeblocked');
        Route::get('/medias/liste', [MediaController::class, 'index2'])->name('medias.liste');
        Route::get('/medias/listedeleted', [MediaController::class, 'index3'])->name('medias.listedeleted');
        Route::get('/rechargements/liste', [RechargementController::class, 'index2'])->name('rechargements.liste');
        Route::get('/users/liste_', [UserController::class, 'index3'])->name('users.liste_');
        Route::get('/users/import', [UserController::class, 'index4'])->name('users.import');
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::post('/users/{user}/desactivecpt', [UserController::class, 'desactivecpt'])->name('users.desactivecpt');
        Route::post('/users/{user}/activecpt', [UserController::class, 'activecpt'])->name('users.activecpt');
        Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy'); // Suppression

        // Afficher le formulaire pour créer un nouveau blog
        Route::get('/blogs/create', [BlogController::class, 'create'])->name('blogs.create');
        Route::post('/blogs', [BlogController::class, 'store'])->name('blogs.store');
        Route::get('/blogs/{blog}/edit', [BlogController::class, 'edit'])->name('blogs.edit');
        Route::put('/blogs/{blog}', [BlogController::class, 'update'])->name('blogs.update');
        Route::patch('/blogs/{blog}', [BlogController::class, 'update'])->name('blogs.update');
        Route::delete('/blogs/{blog}', [BlogController::class, 'destroy'])->name('blogs.destroy');

    });





    // Routes pour les actions utilisateur (changements de mot de passe, profil, désactivation/activation de compte, déblocage de profil)
    Route::post('/filter-users', [UserController::class, 'filterUsers'])->name('filter.users');
    Route::post('/users/{user}/changepass', [UserController::class, 'changepass'])->name('users.changepass');
    Route::post('/users/{user}/changeprofil', [UserController::class, 'changeprofil'])->name('users.changeprofil');
    Route::post('/users/{id}/deblocage', [UserController::class, 'deblocage'])->name('users.deblocage');
    Route::delete('users/{id}/destroydeblocked', [UserController::class, 'destroydeblocked'])->name('users.destroydeblocked');
    Route::post('/rechargements/operation', [RechargementController::class, 'operation'])->name('rechargements.operation');
    Route::get('/rechargement', [RechargementController::class, 'index'])->name('rechargements.index');
    Route::post('/initiate-payment', [RechargementController::class, 'initiatePayment'])->name('rechargements.initiatePayment');
    Route::get('/payment-success', [RechargementController::class, 'success'])->name('rechargements.success');
    Route::get('/payment-error', [RechargementController::class, 'error'])->name('rechargements.error');

    Route::resource('rechargements', RechargementController::class);
    Route::resource('medias', MediaController::class);

    // Routes pour UserController avec les méthodes explicites
    Route::get('/users', [UserController::class, 'index'])->name('users.index'); // Liste des utilisateurs
    Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show'); // Afficher un utilisateur
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit'); // Formulaire de modification
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update'); // Mise à jour complète
    Route::patch('/users/{user}', [UserController::class, 'update']); // Mise à jour partielle


});


----
<?php

namespace App\Http\Controllers;

use App\Models\Pack;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Feexpay\FeexpayPhp\FeexpayClass;
use Illuminate\Support\Facades\Log;

class RechargementController extends Controller
{
    public function index()
    {
        $packs = Pack::all();
        return view('rechargements.index', compact('packs'));
    }



public function initiatePayment(Request $request)
{
    $userId = auth()->id();
    $amount = $request->input('amount'); // Amount selected by the user
    $phoneNumber = $request->input('numeroclient');
    $reseau = $request->input('reseau');

    Log::info('Montant : ' . $amount);
    Log::info('Numéro : ' . $phoneNumber);
    Log::info('Réseau : ' . $reseau);

    // Retrieve sensitive info from .env for security
    $shopId = env('FEEXPAY_SHOP_ID', '66c8be8f9d7f993348230f6a');
    $apiToken = env('FEEXPAY_API_TOKEN', 'test_Hg7Kjl3ZAM63UuIUpuudD9nKuu3ZAM67Kjl3Uuhn');
    $callbackUrl = route('rechargements.verifyPayment');
    $errorCallbackUrl = route('rechargements.errorPayment');
    $mode = 'SANDBOX';

    // Initialize Feexpay payment class
    $feexpay = new FeexpayClass($shopId, $apiToken, $callbackUrl, $mode, $errorCallbackUrl);

    // Start payment initiation
    try {
        $result = $feexpay->init($amount, "button_payee", false, $phoneNumber, "Recharge for user {$userId}", $reseau);

        if ($result['status'] === 'success') {
            return redirect()->back()->with('success', 'Paiement initié, veuillez confirmer.');
        } else {
            return redirect()->back()->with('error', 'Le paiement n’a pas pu être initié. Veuillez réessayer.');
        }
    } catch (\Exception $e) {
        // Handle exceptions or errors during payment initiation
        return redirect()->back()->with('error', 'Une erreur est survenue: ' . $e->getMessage());
    }
}


    public function verifyPayment(Request $request)
    {
        $transactionStatus = $request->input('status'); // Feexpay returns this in the callback
        $userId = auth()->id();

        if ($transactionStatus === 'success') {
            // Record transaction and update credits if successful
            Transaction::create([
                'user_id' => $userId,
                'profile_id' => 2, // Default profile ID
                'amount' => $request->input('amount')
            ]);
        
            $user = User::findOrFail($userId);
        
            // Determine credits based on amount
            $amount = $request->input('amount');
            if ($amount == 500) {
                $user->nbrecredit += 1;
            } elseif ($amount == 1000) {
                $user->nbrecredit += 2;
            } elseif($amount == 2000){
                $user->nbrecredit += 5;  
            }
        
            $user->save();
        
            return redirect()->route('rechargements.index')->with('success', 'Votre compte a été rechargé.');
        }
        

        return redirect()->route('rechargements.index')->with('error', 'Le paiement a échoué. Veuillez réessayer.');
    }

    public function index2()
    {
        $transactions =Transaction::all();
        return view('rechargements.liste', compact('transactions'));
    }


}






