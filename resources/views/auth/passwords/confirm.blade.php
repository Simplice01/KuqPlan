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
        src="{{ asset('storage/public/images/rb.png') }}" >
       <h3 style="font-family: cursive;color:#f02882">Confirmation de mail</h3>
    </div>

    <form action="{{ route('password.verify-code') }}" class="formulaireinscri" method="POST">
        @csrf
        <div class="logoinscr">
            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" style="fill: #f02882;transform: ;msFilter:;"><path d="M20 4H6c-1.103 0-2 .897-2 2v5h2V8l6.4 4.8a1.001 1.001 0 0 0 1.2 0L20 8v9h-8v2h8c1.103 0 2-.897 2-2V6c0-1.103-.897-2-2-2zm-7 6.75L6.666 6h12.668L13 10.75z"></path><path d="M2 12h7v2H2zm2 3h6v2H4zm3 3h4v2H7z"></path></svg>
           <br>
           <small>Entrer le code envoyé à votre email</small>
        </div>
       
        <div class="mb-3">
            <label for="code" class="form-label" class="inputtext">Code de confirmation</label>
            <input type="text" name="code" id="code" placeholder="Entrer le code de confirmation"  class="inputtext" required>
        </div>
        <div class="btninscri">
            <button type="submit" class="btninscription">Réinitialiser</button>
        </div>
        <br> <br>
       
    </form>
    <br> <br>
</div>
@endsection
