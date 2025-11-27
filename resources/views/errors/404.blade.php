

@extends('layouts.app')

@section('content')
<div class="container mt-4" style="text-align: center;">
    <h1>404 - Page introuvable</h1>
    <p style="color:red;margin:25px auto;">La page que vous recherchez n'existe pas.</p>
    <a class="connectezsupport" href="{{ route('home') }}">Retour à l'accueil</a>
  </div>

@endsection



