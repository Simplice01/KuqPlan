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
                <h4 style="color:#741c43">S'inscrire</h4>
            </div>
        
            <div class="form-group">
                <label class="labelcache" for="email">Email</label>
                <input class="inputtext" type="email" id="email" name="email" value="{{ old('email') }}" placeholder="Email" oninput="afficherLabel(this)" required>
                <span id="error-message2" class="errorcodoction" style="display: none;">Veuillez entrer un email valide.</span>
            </div>
        
            <div class="form-group">
                <label class="labelcache" for="pseudo">Pseudo/Prénom</label>
                <input class="inputtext" type="text" id="pseudo" name="name" value="{{ old('name') }}" placeholder="Pseudo/Prénom" oninput="afficherLabel(this)" required>
                <span id="error-message1" class="errorcodoction">Veuillez créer un pseudo.</span>
            </div>
        
            <div class="form-group" style="width: 250px; text-align: center; margin: 10px auto;">
                <select class="inputtext" name="gender" id="genderSelect" onchange="showContentBasedOnGender()">
                    <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Homme</option>
                    <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Femme</option>
                </select>
            </div>
        
            <div id="content1" class="content52"></div>
            <div id="content2" class="content52" style="display: none;">
                <div class="form-group">
                    <div style="display: flex; align-items: center;">
                        <div style="display: flex; align-items: center; border: 1px solid #E81075; border-radius: 5px; overflow: hidden; width: 90%;margin:auto;">
                            <select id="country-code" class="country-selector" name="country_code" style="border: none; padding: 2px; background: transparent; appearance: none;">
                                <option value="+229" data-flag="🇧🇯" {{ old('country_code') == '+229' ? 'selected' : '' }}>Benin(+229)</option>
                                <option value="+228" data-flag="🇹🇬" {{ old('country_code') == '+228' ? 'selected' : '' }}>Togo(+228)</option>
                                <option value="+225" data-flag="🇨🇮" {{ old('country_code') == '+225' ? 'selected' : '' }}>Cote-d'ivoir(+225)</option>
                                <option value="+221" data-flag="🇸🇳" {{ old('country_code') == '+221' ? 'selected' : '' }}>+221</option>
                                <option value="+223" data-flag="🇲🇱" {{ old('country_code') == '+223' ? 'selected' : '' }}>+223</option>
                            </select>
                            <input class="inputtext" id="numtel" type="tel" name="tel" value="{{ old('tel') }}" placeholder="Téléphone" style="border: none; padding: 5px; flex: 1;">
                        </div>
                    </div>
                    <span id="error-message5" class="errorcodoction">Veuillez entrer votre numéro de téléphone.</span>
                </div>
                
        
                <div class="form-group">
                    <label class="labelcache" for="pseudo">Age</label>
                    <input class="inputtext" type="number" id="age" name="age" value="{{ old('age') }}" placeholder="Age" oninput="afficherLabel(this)">
                    <span id="error-message6" class="errorcodoction">Veuillez entrer votre âge.</span>
                </div>
        
                <div class="form-group" style="width: 250px; text-align: center; margin: 10px auto;">
                    <select class="inputtext" name="city" id="ville">
                        <option value=" ">{{ old('city') == '' ? 'Choisir votre ville' : old('city') }}</option>
                        <option value="Abomey-calavi" {{ old('city') == 'Abomey-calavi' ? 'selected' : '' }}>Abomey-calavi</option>
                        <option value="Abidjan" {{ old('city') == 'Abidjan' ? 'selected' : '' }}>Abidjan</option>
                        <option value="Cotonou" {{ old('city') == 'Cotonou' ? 'selected' : '' }}>Cotonou</option>
                        <option value="Lome" {{ old('city') == 'Lome' ? 'selected' : '' }}>Lome</option>
                        <option value="Parakou" {{ old('city') == 'Parakou' ? 'selected' : '' }}>Parakou</option>
                    </select>
                    <span id="error-message77" class="errorcodoction">Veuillez entrer votre ville.</span>
                </div>
        
                <div class="form-group" style="width: 250px; text-align: center; margin: 10px auto;">
                    <select class="inputtext" name="skin_tone" id="skin_tone">
                        <option value=" ">{{ old('skin_tone') == '' ? 'Choisir votre forme' : old('skin_tone') }}</option>
                        <option value="Skiny" {{ old('skin_tone') == 'Skiny' ? 'selected' : '' }}>Skiny</option>
                        <option value="Apouchou" {{ old('skin_tone') == 'Apouchou' ? 'selected' : '' }}>Apouchou</option>
                        <option value="normale" {{ old('skin_tone') == 'normale' ? 'selected' : '' }}>Normale</option>
                    </select>
                    <span id="error-message8" class="errorcodoction">Veuillez entrer votre ville.</span>
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
                <input class="inputtext" type="text" id="motpass" name="password" value="{{ old('password') }}" placeholder="Mot de passe" oninput="afficherLabel(this)" required>
                <span id="error-message3" class="errorcodoction">Veuillez entrer un mot de passe.</span>
            </div>
        
            <div class="form-group">
                <label class="labelcache" for="confirmmotpass">Confirmer le mot de passe</label>
                <input class="inputtext" type="text" id="confirmmotpass" name="confirmmotpass" value="{{ old('confirmmotpass') }}" placeholder="Confirmer le mot de passe" oninput="afficherLabel(this)" required>
                <span id="error-message4" class="errorcodoction">Veuillez confirmer votre mot de passe.</span>
                <div id="passwordError" class="text-danger mt-2" style="display: none;">Les mots de passe ne correspondent pas</div>
            </div>

        
            <div class="form-group">
                <input type="checkbox" name="condition" id="agree" required >
                <label class="checkboxcondition"  for="confirmmotpass">J'accepte les conditions.</label>
                <span id="error-message9" class="errorcodoction" style="display: none;" >Veuillez accepter les conditions pour continuer.</span>
            </div>


             <div class="btninscri">
               
                <button class="btninscription" id="submit-form" type="submit" name="inscription">Inscription</button>
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
        if (gender === 'male') {
            document.getElementById('content1').style.display = 'block';
        } else if (gender === 'female') {
            document.getElementById('content2').style.display = 'block';
        }
    }

    document.getElementById('myForm4').addEventListener('submit', function(event) {
        var gender = document.getElementById('genderSelect').value;
        var email = document.getElementById("email").value;
        var motpass = document.getElementById("motpass").value;
        var confirmmotpass = document.getElementById("confirmmotpass").value;
        var pseudo = document.getElementById("pseudo").value;
        var numtel = document.getElementById("numtel").value;
        var age = document.getElementById("age").value;
        var ville = document.getElementById("ville").value;
        var skin_tone = document.getElementById("skin_tone").value;
        var imgprofil = document.getElementById("file").value; // Correction : utiliser l'ID correct
        var agree = document.getElementById('agree');

        var errorMessage1 = document.getElementById('error-message1');
        var errorMessage3 = document.getElementById('error-message3');
        var errorMessage4 = document.getElementById('error-message4');
        var errorMessage5 = document.getElementById('error-message5');
        var errorMessage6 = document.getElementById('error-message6');
        var errorMessage7 = document.getElementById('error-message7');
        var errorMessage77 = document.getElementById('error-message77');
        var errorMessage8 = document.getElementById('error-message8');
        var errorMessage9 = document.getElementById('error-message9'); // Conditions

        var isValid = true;

        // Vérification des champs de base
        if (email === "") {
            errorMessage1.style.display = 'block';
            isValid = false;
        } else {
            errorMessage1.style.display = 'none';
        }

        if (pseudo === "") {
            errorMessage3.style.display = 'block';
            isValid = false;
        } else {
            errorMessage3.style.display = 'none';
        }

        if (motpass === "" || confirmmotpass === "") {
            errorMessage4.style.display = 'block';
            isValid = false;
        } else if (motpass !== confirmmotpass) {
            errorMessage4.innerText = 'Les mots de passe ne correspondent pas.';
            errorMessage4.style.display = 'block';
            isValid = false;
        } else {
            errorMessage4.style.display = 'none';
        }

        // Vérification pour les females
        if (gender === "female") {
            if (numtel === "") {
                errorMessage5.style.display = 'block';
                isValid = false;
            } else {
                errorMessage5.style.display = 'none';
            }

            if (age === "") {
                errorMessage6.style.display = 'block';
                isValid = false;
            } else {
                errorMessage6.style.display = 'none';
            }

            if (ville === "") {
                errorMessage77.style.display = 'block';
                isValid = false;
            } else {
                errorMessage77.style.display = 'none';
            }

            if (imgprofil === "") {
                errorMessage7.style.display = 'block';
                isValid = false;
            } else {
                errorMessage7.style.display = 'none';
            }
        }

        // Vérification des conditions
        if (!agree.checked) {
            errorMessage9.style.display = 'block';
            isValid = false;
        } else {
            errorMessage9.style.display = 'none';
        }

        // Empêche la soumission si une erreur existe
        if (!isValid) {
            event.preventDefault();
        }
    });

    document.getElementById('phone-form').addEventListener('submit', function (e) {
        const countryCode = document.getElementById('country-code').value; // Récupère l'indicatif
        const phoneNumber = document.getElementById('numtel').value.trim(); // Récupère le numéro

        if (!phoneNumber) {
            e.preventDefault(); // Empêche l'envoi du formulaire
            document.getElementById('error-message5').style.display = 'block';
            return;
        }

        // Concatène l'indicatif et le numéro dans la variable 'tel'
        const fullPhoneNumber = `${countryCode}${phoneNumber}`;
        document.getElementById('numtel').value = fullPhoneNumber; // Met à jour le champ 'tel'
    });
   </script>
    

  
@endsection
