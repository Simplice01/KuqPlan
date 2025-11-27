@extends('layouts.app')

@section('content')
<div class="container mt-4" style="text-align: center;">
    <h1>504 - Erreur de serveur</h1>
    <p style="color:red;margin:25px auto;"></p>
    <a class="connectezsupport" href="{{ route('home') }}">Retour à l'accueil</a>
  </div>

@endsection
