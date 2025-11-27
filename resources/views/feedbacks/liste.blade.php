

@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>feedbacks</h1>

    <!-- Barre de recherche avec style personnalisé -->
    <div class="mb-4">
        <input type="text" id="search" class="form-control search-input" placeholder="Rechercher un feedback...">
        <a style="text-decoration: none;font-weight:bold;" href="{{ route('feedbacks.create') }}">Créer un avis</a>
    </div>

    <table class="table" id="users-table">
        <thead>
            <tr>
                <th>Id</th>
                <th>user</th>
                <th>content</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($feedbacks as $feedback)
            <div>

            
                <tr style="border-bottom:3px solid black;padding-top:50px;">
                    <td>{{ $feedback->id }}</td>
                    <td> <a href="{{ route('users.show',$feedback->user_id) }}"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;"><path d="M7.5 6.5C7.5 8.981 9.519 11 12 11s4.5-2.019 4.5-4.5S14.481 2 12 2 7.5 4.019 7.5 6.5zM20 21h1v-1c0-3.859-3.141-7-7-7h-4c-3.86 0-7 3.141-7 7v1h17z"></path></svg></a> </td>
                    <td>{{ $feedback->content }}</td>
                    <td>
                        <form action="{{ route('feedbacks.destroy', $feedback->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit">Supprimer</button>
                        </form>
                    </td>
                </tr>
               

            @endforeach
        </tbody>
    </table>
</div>

<!-- Inclure jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Script de recherche dynamique -->
<script>
    $(document).ready(function() {
        $('#search').on('keyup', function() {
            var searchValue = $(this).val().toLowerCase();
            $('#users-table tbody tr').filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(searchValue) > -1)
            });
        });
    });
</script>

<style>
    .search-input {
        width: 250px; /* Ajustez la largeur selon vos besoins */
        margin-right: auto;
        margin-left: auto;
        display: block;
    }
</style>
@endsection



