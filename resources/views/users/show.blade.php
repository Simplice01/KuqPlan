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

<div class="user-details-container">
    @if ($user->gender==="female")
    <div class="user-icon">
        @if($user->imgprofil)
        <!-- Affichage de l'image de l'utilisateur en cercle -->
        {{-- src="{{ asset('storage/images/couple.png') }}" --}}
        <img src="{{ asset('storage/' . $user->imgprofil) }}" alt="User Image" class="rounded-circle" width="90" height="90">
        @auth
        @if(auth()->user()->role == 'admin' || auth()->user()->id == $user->id)
        <h6><button style="border:none;font-weight:bold;color:#E81075;" type="submit" onclick="openModal3()">Modifier</button></h6>
        @endif
        @endauth
        @else
        <!-- Affichage de l'icône par défaut -->
        <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" viewBox="0 0 24 24" style="fill: orange;">
            <path d="M12 2C6.579 2 2 6.579 2 12s4.579 10 10 10 10-4.579 10-10S17.421 2 12 2zm0 5c1.727 0 3 1.272 3 3s-1.273 3-3 3c-1.726 0-3-1.272-3-3s1.274-3 3-3zm-5.106 9.772c.897-1.32 2.393-2.2 4.106-2.2h2c1.714 0 3.209.88 4.106 2.2C15.828 18.14 14.015 19 12 19s-3.828-.86-5.106-2.228z"></path>
        </svg>
    @endif

    </div>


    <h4 style="padding-bottom: 10px;color:rgb(0, 0, 0);">{{ $user->name }}</h4>





    @if($user->statutcpt === 'nonvalide')
    <h6 style="padding-bottom: 10px;color:rgb(0, 0, 0);" >Non vérifié <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" style="fill: rgb(255, 3, 3);transform: ;msFilter:;"><path d="M11 7h2v7h-2zm0 8h2v2h-2z"></path><path d="m21.707 7.293-5-5A.996.996 0 0 0 16 2H8a.996.996 0 0 0-.707.293l-5 5A.996.996 0 0 0 2 8v8c0 .266.105.52.293.707l5 5A.996.996 0 0 0 8 22h8c.266 0 .52-.105.707-.293l5-5A.996.996 0 0 0 22 16V8a.996.996 0 0 0-.293-.707zM20 15.586 15.586 20H8.414L4 15.586V8.414L8.414 4h7.172L20 8.414v7.172z"></path></svg></h6>
    @else
    <h6 style="padding-bottom: 10px;color:rgb(0, 0, 0);" >Vérifié <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" style="fill: rgb(4, 219, 58);transform: ;msFilter:;"><path d="M12 2C6.486 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.514 2 12 2zm0 18c-4.411 0-8-3.589-8-8s3.589-8 8-8 8 3.589 8 8-3.589 8-8 8z"></path><path d="M9.999 13.587 7.7 11.292l-1.412 1.416 3.713 3.705 6.706-6.706-1.414-1.414z"></path></svg></h6>
    @endif
    <div class="user-infor" style="border-radius: 25px;">


        <!-- Icône pour l'email -->
        <div style="display: block">
             <div style="display:flex;justify-content:space-between;">
                <h6>{{ $user->city }} <svg fill="#E81075" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18" height="18" viewBox="0 0 395.71 395.71" xml:space="preserve"><g id="SVGRepo_bgCarrier" stroke-width="0"/><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"/><g id="SVGRepo_iconCarrier"> <g> <path d="M197.849,0C122.131,0,60.531,61.609,60.531,137.329c0,72.887,124.591,243.177,129.896,250.388l4.951,6.738 c0.579,0.792,1.501,1.255,2.471,1.255c0.985,0,1.901-0.463,2.486-1.255l4.948-6.738c5.308-7.211,129.896-177.501,129.896-250.388 C335.179,61.609,273.569,0,197.849,0z M197.849,88.138c27.13,0,49.191,22.062,49.191,49.191c0,27.115-22.062,49.191-49.191,49.191 c-27.114,0-49.191-22.076-49.191-49.191C148.658,110.2,170.734,88.138,197.849,88.138z"/> </g> </g></svg></h6>
                @if(auth()->user()->role == 'admin' || auth()->user()->id == $user->id)
                <h6 style="color:#555;">{{ $user->nbrecredit }} Crédits </h6>
                @endif
                <h6>{{ $user->age }} ans </h6>
             </div>
             <div style="display:flex;justify-content:space-between;">
                <h6>{{ $user->skin_tone }}</h6>
                @if(auth()->user()->role == 'admin' || auth()->user()->id == $user->id||$etat==='visible')
                <h6> <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;"><path d="m20.487 17.14-4.065-3.696a1.001 1.001 0 0 0-1.391.043l-2.393 2.461c-.576-.11-1.734-.471-2.926-1.66-1.192-1.193-1.553-2.354-1.66-2.926l2.459-2.394a1 1 0 0 0 .043-1.391L6.859 3.513a1 1 0 0 0-1.391-.087l-2.17 1.861a1 1 0 0 0-.29.649c-.015.25-.301 6.172 4.291 10.766C11.305 20.707 16.323 21 17.705 21c.202 0 .326-.006.359-.008a.992.992 0 0 0 .648-.291l1.86-2.171a.997.997 0 0 0-.085-1.39z"></path></svg>{{ $user->tel }}</h6>
                 @else
                 <h6> <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;"><path d="m20.487 17.14-4.065-3.696a1.001 1.001 0 0 0-1.391.043l-2.393 2.461c-.576-.11-1.734-.471-2.926-1.66-1.192-1.193-1.553-2.354-1.66-2.926l2.459-2.394a1 1 0 0 0 .043-1.391L6.859 3.513a1 1 0 0 0-1.391-.087l-2.17 1.861a1 1 0 0 0-.29.649c-.015.25-.301 6.172 4.291 10.766C11.305 20.707 16.323 21 17.705 21c.202 0 .326-.006.359-.008a.992.992 0 0 0 .648-.291l1.86-2.171a.997.997 0 0 0-.085-1.39z"></path></svg>********</h6>
                 @endif
            </div>
        </div>
        @if(auth()->user()->role == 'admin' || auth()->user()->id == $user->id||$etat==='visible')
        <p>
            <!-- Bouton WhatsApp -->
            <button onclick="window.location.href='https://wa.me/{{ $user->tel }}'">

                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" style="fill: rgb(8, 192, 63);transform: ;msFilter:;">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M18.403 5.633A8.919 8.919 0 0 0 12.053 3c-4.948 0-8.976 4.027-8.978 8.977 0 1.582.413 3.126 1.198 4.488L3 21.116l4.759-1.249a8.981 8.981 0 0 0 4.29 1.093h.004c4.947 0 8.975-4.027 8.977-8.977a8.926 8.926 0 0 0-2.627-6.35m-6.35 13.812h-.003a7.446 7.446 0 0 1-3.798-1.041l-.272-.162-2.824.741.753-2.753-.177-.282a7.448 7.448 0 0 1-1.141-3.971c.002-4.114 3.349-7.461 7.465-7.461a7.413 7.413 0 0 1 5.275 2.188 7.42 7.42 0 0 1 2.183 5.279c-.002 4.114-3.349 7.462-7.461 7.462m4.093-5.589c-.225-.113-1.327-.655-1.533-.73-.205-.075-.354-.112-.504.112s-.58.729-.711.879-.262.168-.486.056-.947-.349-1.804-1.113c-.667-.595-1.117-1.329-1.248-1.554s-.014-.346.099-.458c.101-.1.224-.262.336-.393.112-.131.149-.224.224-.374s.038-.281-.019-.393c-.056-.113-.505-1.217-.692-1.666-.181-.435-.366-.377-.504-.383a9.65 9.65 0 0 0-.429-.008.826.826 0 0 0-.599.28c-.206.225-.785.767-.785 1.871s.804 2.171.916 2.321c.112.15 1.582 2.415 3.832 3.387.536.231.954.369 1.279.473.537.171 1.026.146 1.413.089.431-.064 1.327-.542 1.514-1.066.187-.524.187-.973.131-1.067-.056-.094-.207-.151-.43-.263"></path>
                </svg>
            </button>

            <!-- Bouton Appel -->
            <button onclick="window.location.href='tel:{{ $user->tel }}'">

                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" style="fill: rgb(11, 29, 185);transform: ;msFilter:;">
                    <path d="M16.57 22a2 2 0 0 0 1.43-.59l2.71-2.71a1 1 0 0 0 0-1.41l-4-4a1 1 0 0 0-1.41 0l-1.6 1.59a7.55 7.55 0 0 1-3-1.59 7.62 7.62 0 0 1-1.59-3l1.59-1.6a1 1 0 0 0 0-1.41l-4-4a1 1 0 0 0-1.41 0L2.59 6A2 2 0 0 0 2 7.43 15.28 15.28 0 0 0 6.3 17.7 15.28 15.28 0 0 0 16.57 22zM6 5.41 8.59 8 7.3 9.29a1 1 0 0 0-.3.91 10.12 10.12 0 0 0 2.3 4.5 10.08 10.08 0 0 0 4.5 2.3 1 1 0 0 0 .91-.27L16 15.41 18.59 18l-2 2a13.28 13.28 0 0 1-8.87-3.71A13.28 13.28 0 0 1 4 7.41zM20 11h2a8.81 8.81 0 0 0-9-9v2a6.77 6.77 0 0 1 7 7z"></path>
                    <path d="M13 8c2.1 0 3 .9 3 3h2c0-3.22-1.78-5-5-5z"></path>
                </svg>
            </button>
        </p>

         @else
        <p>
            <h6 style="color:red;font-size:12px;">Débloqué ce profil pour accéder au contact de {{ $user->name }} </h6>
            <form action="{{ route('users.deblocage', $user->id) }}" method="POST" class="d-inline">
                @csrf
                <button style="border: 2px solid #E81075;font-size:12px;" class="btninscription" > <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" style="fill: #E81075;transform: ;msFilter:;"><path d="M12 2C9.243 2 7 4.243 7 7v3H6a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8a2 2 0 0 0-2-2h-1V7c0-2.757-2.243-5-5-5zM9 7c0-1.654 1.346-3 3-3s3 1.346 3 3v3H9V7zm4 10.723V20h-2v-2.277a1.993 1.993 0 0 1 .567-3.677A2.001 2.001 0 0 1 14 16a1.99 1.99 0 0 1-1 1.723z"></path></svg>Débloquer</button>

               </form>
        </p>
        @endif

    </div>
        @auth
        @if(auth()->user()->role == 'admin' || auth()->user()->id == $user->id)
            <!-- Bouton Modifier -->
            <div style="display: flex;justify-content:space-between;padding:15px;" >

                <a style="font-weight: bold;color:black;" href="{{ route('users.edit', $user->id) }}">Editer prfofil</a>
                <a style="font-weight: bold;color:black;" href="{{ route('rechargements.index') }}">Recharger</a>

                <button style="background:none;border:none;font-weight: bold;" type="submit" onclick="openModal()">Sécurité</button>
            </div>

        @endif

        @if(auth()->user()->role == 'admin')
            <!-- Bouton Supprimer -->
            <div style="display: flex;justify-content:space-between;padding:15px;" >
               @if ($user->statutcpt==='nonvalide')
               <form action="{{ route('users.activecpt', $user->id) }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btndesactive" >
                    Activé
                </button>
               </form>

               @else
               <form action="{{ route('users.desactivecpt', $user->id) }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btnactive" >
                    Désactivé
                </button>

               @endif

            </form>
            <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button class="btnactive" type="submit" >
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(255, 255, 255, 1);transform: ;msFilter:;">
                        <path d="M5 20a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V8h2V6h-4V4a2 2 0 0 0-2-2H9a2 2 0 0 0-2 2v2H3v2h2zM9 4h6v2H9zM8 8h9v12H7V8z"></path>
                        <path d="M9 10h2v8H9zm4 0h2v8h-2z"></path>
                    </svg>
                    Supprimer
                </button>
            </form>
        </div>
         @endif
    @endauth

</div>

     <div style="margin:auto;">
    @auth
        @if(auth()->user()->id == $user->id)
            <!-- Bouton Modifier -->
            <div class="content52" >
                <form action="{{ route('medias.store') }}"    method="post" enctype="multipart/form-data">
                    @csrf
                    <label for="file-input" class="file-container">
                        <div class="file-preview">
                            <span class="file-icon">+</span>
                        </div>
                        <input style="display:none;" id="file-input" type="file" name="file_path" accept="image/*"  onchange="displayFileName()">
                        <div id="confirmation"></div>
                        <p id="errorMessage" class="error-messageimgprive">Veuillez sélectionner une image.</p>
                    </label> <br><br>
                    <div class="form-group">
                        <button  class="btninscription" type="submit" onclick="addImage()">Ajouter l'image</button>
                    </div>
                </div>
            </form>


         @endif
    @endauth
</div>





    {{-- <h4 style="text-align: center;margin:10px;">Médias de {{ $user->name}}</h4> <br> --}}

     </div>

    <div class="row m-1" id="products-list">
        <div class="button-container">
            <div class="background"></div> <!-- Élément de fond -->
            <button id="btn1" class="toggle-btn" onclick="showContent('content1', this)">Profile</button>
            <button id="btn2" class="toggle-btn" onclick="showContent('content2', this)">Médias</button>
        </div>
        <div id="content1" class="content52">
            <img  class="aucuneimgpp" src="{{ asset('storage/' . $user->imgprofil) }}"  alt="image">

        </div>
        <div id="content2" class="content52" style="display: none;">
                @if($medias->isEmpty())
            <p style="margin:auto;color:red;font-weight:bold;">Aucune publication</p>

           @elseif ($user->nbrecredit=!0||auth()->user()->role == 'admin' || auth()->user()->id == $user->id)
           @foreach ($medias as $media)
           <a href="{{ route('medias.show', $media->id) }}">

            <img  class="aucuneimgpp" src="{{ asset('storage/public/images/' . $media->file_path) }}"  alt="image">
           </a>
           @endforeach
           @else
           <svg xmlns="http://www.w3.org/2000/svg" width="54" height="54" viewBox="0 0 24 24" style="fill: rgb(232, 16, 117,0.5);transform: ;msFilter:;"><path d="M12 2C9.243 2 7 4.243 7 7v3H6a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8a2 2 0 0 0-2-2h-1V7c0-2.757-2.243-5-5-5zM9 7c0-1.654 1.346-3 3-3s3 1.346 3 3v3H9V7zm4 10.723V20h-2v-2.277a1.993 1.993 0 0 1 .567-3.677A2.001 2.001 0 0 1 14 16a1.99 1.99 0 0 1-1 1.723z"></path></svg>
           <p style="padding:10px;color:rgb(255, 0, 0,0.5);">Vous devez disposer d'aumoins 2 crédit disponible avant de voir les médias de {{ $user->name}} </p>

            @endif

        </div>
        @else

        <div class="user-icon">
            @if($user->imgprofil)
            <!-- Affichage de l'image de l'utilisateur en cercle -->
            <img src="{{ asset('storage/images/' . basename($user->imgprofil)) }}" alt="User Image" class="rounded-circle" width="80" height="80">
        @else
            <!-- Affichage de l'icône par défaut -->
            <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" viewBox="0 0 24 24" style="fill: #E81075;">
                <path d="M12 2C6.579 2 2 6.579 2 12s4.579 10 10 10 10-4.579 10-10S17.421 2 12 2zm0 5c1.727 0 3 1.272 3 3s-1.273 3-3 3c-1.726 0-3-1.272-3-3s1.274-3 3-3zm-5.106 9.772c.897-1.32 2.393-2.2 4.106-2.2h2c1.714 0 3.209.88 4.106 2.2C15.828 18.14 14.015 19 12 19s-3.828-.86-5.106-2.228z"></path>
            </svg>
        @endif

        </div>
        <h4 style="padding-bottom: 10px;color:rgb(0, 0, 0);">{{ $user->name }} </h4>
        <h5 style="padding-bottom: 10px;color:rgb(0, 0, 0);">{{ $user->email }} </h5>
        <div class="user-infor" style="border-radius: 25px;">

            <h5 style="padding-bottom: 10px;color:rgb(0, 0, 0);">{{ $user->nbrecredit }} Crédits</h5>
            <svg xmlns="http://www.w3.org/2000/svg" width="54" height="54" viewBox="0 0 24 24" style="fill: rgb(232, 16, 117,0.5);transform: ;msFilter:;"><path d="M12 2C9.243 2 7 4.243 7 7v3H6a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8a2 2 0 0 0-2-2h-1V7c0-2.757-2.243-5-5-5zM9 7c0-1.654 1.346-3 3-3s3 1.346 3 3v3H9V7zm4 10.723V20h-2v-2.277a1.993 1.993 0 0 1 .567-3.677A2.001 2.001 0 0 1 14 16a1.99 1.99 0 0 1-1 1.723z"></path></svg>

         <p>
            Votre profile et vos informations sont sécurisées,et  peut-être vu par vous uniquement.
         </p>
        </div>
        @if(auth()->user()->role == 'admin'|| auth()->user()->id == $user->id)
        <!-- Bouton Modifier -->
        <div style="display: flex;justify-content:space-between;padding:15px;" >
            <a style="font-weight: bold;color:black;" href="{{ route('rechargements.index') }}">Recharger</a>
            <button style="background:none;border:none;font-weight: bold;" type="submit" onclick="openModal()">Sécurité</button>
        </div>

       @endif

    </div>

   @endif



</div>


<div id="myModal" class="modal">
    <div class="modal-content">

      <div class="modal-header">
        <span class="close" onclick="closeModal()">&times;</span>
      </div>
      <div class="modal-body">

      <form action="{{ route('users.changepass',$user->id) }}" method="post" id="modifpassword" style="text-align: center;" class="formulaireinscrim">
         @csrf
          <div style="text-align:center;" class="logoinscr">
          <h5>Modifier mot de passe </h5>
          </div>

          <div class="form-group">
              <label class="labelcache" for="motpass">Ancien</label>
              <input class="inputtext" type="text" id="passwordanci" name="passwordanc" placeholder="Ancien " oninput="afficherLabel(this)">
          </div>
          <div class="form-group">
              <label class="labelcache" for="motpass">Nouveau</label>
              <input class="inputtext" type="text" id="anpassword" name="anpassword" placeholder="Nouveau" oninput="afficherLabel(this)">
          </div>
          <div class="form-group">
            <label class="labelcache" for="motpass">Confirmer</label>
            <input class="inputtext" type="text" id="password" name="password" placeholder="Nouveau" oninput="afficherLabel(this)">
          </div>
          <div id="passwordError" class="text-danger mt-2" style="display: none;font-weight:bold;">Les mots de passe ne correspondent pas</div>

          <div class="btninscri">
              <button class="btninscription" type="submit" name="modifiermotpass">Modifier</button>
          </div>
          <br>
         <div class="btninscri">
          <a href="{{ route('password.forgot') }}" class="connectezsupport">Mot de passe oublié ?</a>
        </div>
     </form>

      </div>
    </div>
  </div>


  <div id="myModal3" class="modal">
    <div class="modal-content">

      <div class="modal-header">
        <span class="close" onclick="closeModal3()">&times;</span>
      </div>
      <div class="modal-body">

           <form id="modifierprofil" action="{{route('users.changeprofil',$user->id) }}" method="post" class="formulaireinscrim" enctype="multipart/form-data">
              @csrf
            {{-- <h4 style="color:#E81075;padding-bottom:25px;">Modifier photo</h4>  --}}
                  <div class="file-input-container">

                    <label for="file-input" class="file-container">
                        <div style="margin:auto;"  class="file-preview">
                            <span class="file-icon"><svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" style="fill: rgba(232, 16, 117, 1);transform: ;msFilter:;"><path d="M7.5 6.5C7.5 8.981 9.519 11 12 11s4.5-2.019 4.5-4.5S14.481 2 12 2 7.5 4.019 7.5 6.5zM20 21h1v-1c0-3.859-3.141-7-7-7h-4c-3.86 0-7 3.141-7 7v1h17z"></path></svg></span>
                        </div>
                        <input id="file-input2"  type="file" name="imgprofil"   onchange="showFileName()">

                      {{-- <label for="file" class="file-label">Choisir un fichier</label>
                      <input type="file" id="file-input2" class="file-input" name="s_photoprofil" onchange="showFileName()"> --}}
                      <span id="file-name" class="file-name">Aucun fichier choisi</span>
                      <p id="errorMessage2" class="error-messageimgprive">Veuillez sélectionner une image.</p>
                  </div> <br> <br>
                  <button onclick="addImage2()" type="submit" name="modifierprofilimg"  class="btninscription">Mofiier la photo</button>
             </form>

      </div>
    </div>
  </div>



{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}

<script>

document.getElementById('modifpassword').addEventListener('submit', function (event) {
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('anpassword').value;

        if (password !== confirmPassword) {
            event.preventDefault(); // Empêche la soumission du formulaire
            document.getElementById('passwordError').style.display = 'block';
        } else {
            document.getElementById('passwordError').style.display = 'none';
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

function displayFileName() {
        const input = document.getElementById('file-input');
        const fileName = input.files[0].name;

        document.getElementById('confirmation').innerText = fileName;
    }
    function displayFileName() {
        const input = document.getElementById('file-input');
        const fileName = input.files[0].name;

        document.getElementById('confirmation').innerText = fileName;
    }

    function addImage() {
        const fileInput = document.getElementById('file-input');
        const errorMessage = document.getElementById('errorMessage');

        // Vérifier si un fichier a été sélectionné
        if (fileInput.files.length === 0) {
            errorMessage.style.display = 'block';
            event.preventDefault();
        } else {
            errorMessage.style.display = 'none';
            // Ajoutez ici le code pour traiter l'ajout de l'image
            // Par exemple : envoyer le formulaire avec une image
            document.getElementById('myFormimg').submit();
        }
    }

    function addImage2() {
        const fileInput = document.getElementById('file-input2');
        const errorMessage = document.getElementById('errorMessage2');

        // Vérifier si un fichier a été sélectionné
        if (fileInput.files.length === 0) {
            errorMessage.style.display = 'block';
            event.preventDefault();
        } else {
            errorMessage.style.display = 'none';
            // Ajoutez ici le code pour traiter l'ajout de l'image
            // Par exemple : envoyer le formulaire avec une image
            document.getElementById('modifierprofil').submit();
        }
    }

    document.getElementById('contactForm').addEventListener('submit', function(event) {
  event.preventDefault(); // Empêcher l'envoi du formulaire (à remplacer par votre propre logique)
  console.log('Formulaire soumis !');
  closeModal(); // Fermer la modal après la soumission du formulaire
});
function openModal() {
  var modal = document.getElementById('myModal');
  modal.style.display = 'block';
}
function closeModal() {
  var modal = document.getElementById('myModal');
  modal.style.display = 'none';
}
function openModal3() {
  var modal2 = document.getElementById('myModal3');
  modal2.style.display = 'block';
  event.preventDefault();
}
function closeModal3() {
  var modal = document.getElementById('myModal3');
  modal.style.display = 'none';
}

function showFileName() {
        var input = document.getElementById('file-input2');
        var fileNameDisplay = document.getElementById('file-name');
        if (input.files.length > 0) {
            fileNameDisplay.textContent = input.files[0].name;
        } else {
            fileNameDisplay.textContent = 'Aucun fichier choisi';
        }
    }


</script>





<style>
    /* a{
        text-decoration:none;
    } */
    .btnactive{
        background-color: red;
        text-align:center;
        color:white;
        border:2px solid white;
        border-radius:10px;
        padding:8px;
        font-weight:bold;

    }
    .btndesactive{
        background-color: rgb(11, 180, 11);
        text-align:center;
        color:white;
        border:2px solid white;
        border-radius:10px;
        padding:8px;
        font-weight:bold;

    }

    .button-container {
        display: flex;
        justify-content: space-between;
        width: 100%; /* Le conteneur occupe 100% de la largeur de l'écran */
        max-width: 100%; /* Limite la largeur maximale pour grands écrans */
        background-color: #d4bbaf;
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
        font-size: 18px;
        border: none;
        color: rgb(0, 0, 0);
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


.publication-card {
    max-width: 300px;
    margin: 10px auto;
    background-color: #ffffff;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 15px 20px rgba(0, 0, 0, 0.1);
    display: flex;
    flex-direction: row;
}


.user-infor a, .user-infor button {
        color: rgb(0, 0, 0);
        margin-right: 10px;
        font-size: 1.2em;
        text-decoration: none
    }

    .user-infor button {
        background: none;
        border: none;
        cursor: pointer;
    }

    .user-infor i {
        margin-right: 5px;
    }
    .user-details-container {
        max-width: 600px;
        margin: 50px auto;
        padding: 20px;
        background: none;
        /* background-color: rgb(236, 223, 223); */
        border-radius: 15px;
        box-shadow: 0 25px 25px rgba(0, 0, 0, 0.1);
        text-align: center;
        animation: fadeIn 1.5s ease-in-out;
    }

    .user-icon {
        margin-bottom: 20px;
        animation: bounceIn 1.5s;
    }

    .user-infor h1 {
        font-size: 1.5rem;
        color: #ffffff;
        margin-bottom: 15px;
        animation: slideIn 1s ease-out;
    }
    .user-infor {
        padding: 20px;
        border: 5px solid #E81075; /* Couleur orange pour correspondre à ton style global */
        border-top: none; Ouvre la bordure en haut
        border-radius:25px; /* Bordures arrondies en bas */
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1); /* Ajoute un ombrage pour un effet de profondeur */
        background: none;
        margin-top: -15px; /* Permet à la section de remonter un peu pour accentuer l'ouverture en haut */
        position: relative;
        animation: fadeInUp 1.2s ease-out;
    }

    .user-infor:before {
        content: '';
        display: block;
        width: 50px; /* Taille de l'ouverture en haut */
        height: 2px; /* Hauteur de la ligne en haut de l'ouverture */
        background-color: #c26b00;
        border-radius:50%;
        position: absolute;
        top: -2px;
        left: calc(50% - 25px); /* Centrer l'ouverture */
    }

    .user-infor p {
        font-size: 1rem;
        color: #555;
        animation: fadeInUp 1.2s ease-out;
    }
    .copy-status {
        color: #32cd32; /* Couleur vert lime pour "Copié" */
        font-size: 0.9em;
        margin-left: 10px;
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    @keyframes bounceIn {
        0% { transform: scale(0.5); opacity: 0; }
        80% { transform: scale(1.1); opacity: 1; }
        100% { transform: scale(1); }
    }

    @keyframes slideIn {
        from { transform: translateX(-100%); }
        to { transform: translateX(0); }
    }

    @keyframes fadeInUp {
        from { transform: translateY(20px); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
    }
</style>
@endsection
