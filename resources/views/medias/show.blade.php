

@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <!-- Barre de recherche avec style personnalisé -->
    <div style="text-align:center;">
        <img  class="mediashowv" src="{{ asset('storage/public/images/' . $media->file_path) }}"  alt="image">
        @if(auth()->user()->role == 'admin' || auth()->user()->id == $media->user_id)
        <div class="mt-2">
            <form action="{{ route('medias.destroy', $media->id) }}" method="POST" >
                @csrf
                @method('DELETE')
                <button style="background: none;border:none;"pe="submit"><svg xmlns="http://www.w3.org/2000/svg" width="34" heigh="34" viewBox="0 0 24 24" style="fill: rgb(226, 52, 8);transform: ;msFilter:;"><path d="M6 7H5v13a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7H6zm10.618-3L15 2H9L7.382 4H3v2h18V4z"></path></svg></button>
            </form>
        </div>
        @endif
    </div>
</div>

<!-- Inclure jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



<style>
    .search-input {
        width: 250px; /* Ajustez la largeur selon vos besoins */
        margin-right: auto;
        margin-left: auto;
        display: block;
    }
    .mediashowv{
        height: 400px;
        width: auto;
    }
    .deletemedi{
        background-color: red;
        border: 2px solid red;
        color:white;
    }
</style>
@endsection



