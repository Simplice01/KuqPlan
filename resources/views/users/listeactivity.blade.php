

@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>Activité</h1>

    <!-- Barre de recherche avec style personnalisé -->
    <div class="mb-4">
        <input type="text" id="search" class="form-control search-input" placeholder="Rechercher un media...">
    </div>

    <table class="table" id="users-table">
        <thead>
            <tr>
                <th>Id</th>
                <th>user</th>
                <th>Activté</th>
                <th>Date-heure</th>
                {{-- <th>Actions</th> --}}
            </tr>
        </thead>
        <tbody>
            @foreach ($usersactivitys as $usersactivity)
            <div>


                <tr style="border-bottom:3px solid black;padding-top:50px;">
                    <td>{{ $loop->iteration }}</td>
                    <td> <a href="{{ route('users.show',$usersactivity->user_id) }}"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: #E81078;transform: ;msFilter:;"><path d="M12 5c-7.633 0-9.927 6.617-9.948 6.684L1.946 12l.105.316C2.073 12.383 4.367 19 12 19s9.927-6.617 9.948-6.684l.106-.316-.105-.316C21.927 11.617 19.633 5 12 5zm0 11c-2.206 0-4-1.794-4-4s1.794-4 4-4 4 1.794 4 4-1.794 4-4 4z"></path><path d="M12 10c-1.084 0-2 .916-2 2s.916 2 2 2 2-.916 2-2-.916-2-2-2z"></path></svg></a> </td>
                    <td>{{ $usersactivity->activity_type }}</td>
                    <td>{{ $usersactivity->created_at }}</td>
                    {{-- <td>
                        <form id="deleteForm" action="{{ route('medias.destroy', $usersactivity->id) }}" method="POST" >
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" onclick="confirmDeletion()" type="submit">Supprimer</button>
                        </form>
                    </td> --}}
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


    function confirmDeletion() {
    Swal.fire({
        title: 'Êtes-vous sûr ?',
        text: "Cette action est irréversible !",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Oui, supprimer',
        cancelButtonText: 'Annuler'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('deleteForm').submit();
        }
    });
}
</script>

<style>
    .search-input {
        width: 250px; /* Ajustez la largeur selon vos besoins */
        margin-right: auto;
        margin-left: auto;
        display: block;
    }

    #users-table {
        width: 100%;
        border-collapse: collapse;
        margin: 20px 0;
        font-size: 16px;
        font-family: Arial, sans-serif;
    }

    /* En-têtes de la table */
    #users-table thead th {
        background-color: #6b143e;
        color: #fff;
        padding: 10px;
        text-align: left;
        border: 1px solid #ddd;
    }

    /* Lignes de la table */
    #users-table tbody tr:nth-child(even) {
        background-color: #ebafcc;
    }

    #users-table tbody tr:nth-child(odd) {
        background-color: #fff;
    }

    /* Cellules de données */
    #users-table tbody td {
        padding: 10px;
        border: 1px solid #ddd;
        text-align: left;
    }

    /* Style des icônes */
    #users-table svg {
        cursor: pointer;
        transition: transform 0.2s ease;
    }
    #users-table svg:hover {
        transform: scale(1.2);
    }

    /* Bouton de suppression */
    #users-table button {
        background: none;
        border: none;
        padding: 0;
        cursor: pointer;
    }


</style>
@endsection



