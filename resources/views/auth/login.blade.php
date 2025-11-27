
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



    <div class="lesparties">

        <div class="partimg">
            <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 20rem;"
            src="{{ asset('storage/public/images/coulpe1.png') }}" >
           <h3 style="font-family: cursive;color:#f02882">Se connecter à Kuqplan</h3>
        </div>

        <form action="{{ route('login') }}" method="POST" class="formulaireinscri">
            @csrf
              <div style="padding: 15px;"  class="logoinscr">
                 <svg xmlns="http://www.w3.org/2000/svg" width="44" height="44" viewBox="0 0 24 24" style="fill: #E81075;transform: ;msFilter:;"><path d="M12 2a5 5 0 1 0 5 5 5 5 0 0 0-5-5zm0 8a3 3 0 1 1 3-3 3 3 0 0 1-3 3zm9 11v-1a7 7 0 0 0-7-7h-4a7 7 0 0 0-7 7v1h2v-1a5 5 0 0 1 5-5h4a5 5 0 0 1 5 5v1z"></path></svg>       
                 <h5 style="padding: 15px;color:#f02882">Se connecter</h5>
                </div>
       
               <div class="form-group">
                   <label class="labelcache" for="email">Email</label>
                   <input class="inputtext" type="email" id="email" name="email" placeholder="Email" oninput="afficherLabel(this)" required>
               </div>
               <div class="form-group">
                   <label class="labelcache" for="motpass">Mot de passe</label>
                   <input class="inputtext" type="password" id="motpass" name="password" placeholder="Mot de passe" oninput="afficherLabel(this)" required>
               </div>
        
                <div class="btninscri">
                   <button class="btninscription" type="submit" name="connexion">Connexion</button>
               </div>
       
               <div class="dejacompte">
                   Vous n'avez pas un compte ? <br> <br>
                   <a href="{{ route('users.create') }}" class="connectezvous">Inscrivez-vous</a> <br> <br>
                   
                   <a href="{{ route('password.forgot') }}" class="connectezsupport">Mot de passe oublié ?</a>


               </div>
         </form>
              
        
    </div>


   
     


    @endsection
