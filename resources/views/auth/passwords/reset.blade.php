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

<div class="lesparties">

    <div class="partimg">
        <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 20rem;"
        src="{{ asset('storage/public/images/ter.png') }}" >
        <h3 style="font-family: cursive;color:#f02882">Changer le mot de passe</h3>
    </div>

    <form action="{{ route('password.reset') }}" method="POST" class="formulaireinscri" id="resetPasswordForm">
        <div style="padding: 15px;" class="logoinscr">
            <svg xmlns="http://www.w3.org/2000/svg" width="44" height="44" viewBox="0 0 24 24" style="fill: #E81075;"><path d="M12 2a5 5 0 1 0 5 5 5 5 0 0 0-5-5zm0 8a3 3 0 1 1 3-3 3 3 0 0 1-3 3zm9 11v-1a7 7 0 0 0-7-7h-4a7 7 0 0 0-7 7v1h2v-1a5 5 0 0 1 5-5h4a5 5 0 0 1 5 5v1z"></path></svg>       
            <h5 style="padding: 15px;color:#f02882">Changer le mot de passe</h5>
        </div>
        @csrf
        <div class="mb-3">
            <input type="password" name="password" placeholder="Nouveau mot de passe" id="password" class="inputtext" required>
        </div>
        <div class="mb-3">
            <input type="password" name="password_confirmation" placeholder="Confirmez le mot de passe" id="password_confirmation" class="inputtext" required>
        </div>
        <div class="btninscri">
            <button type="submit" class="btninscription">Réinitialiser</button>
        </div>
        <br><br>
    </form>
</div>

<script>
    document.getElementById('resetPasswordForm').addEventListener('submit', function (e) {
        // Récupération des champs de mot de passe
        const password = document.getElementById('password').value;
        const passwordConfirmation = document.getElementById('password_confirmation').value;

        // Vérifications
        if (password.length < 8) {
            e.preventDefault();
            Swal.fire({
                icon: 'error',
                title: 'Erreur!',
                text: 'Le mot de passe doit contenir au moins 8 caractères.',
                confirmButtonText: 'Ok',
                customClass: {
                    confirmButton: 'swal2-confirm'
                }
            });
            return;
        }

        if (password !== passwordConfirmation) {
            e.preventDefault();
            Swal.fire({
                icon: 'error',
                title: 'Erreur!',
                text: 'Les mots de passe ne correspondent pas.',
                confirmButtonText: 'Ok',
                customClass: {
                    confirmButton: 'swal2-confirm'
                }
            });
            return;
        }
    });
</script>
@endsection
