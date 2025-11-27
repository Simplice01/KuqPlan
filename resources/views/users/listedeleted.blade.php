

@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>Users(supprimé)</h1>

    <!-- Barre de recherche avec style personnalisé -->
    <div class="mb-4">
        <input type="text" id="search" class="form-control search-input" placeholder="Rechercher un client...">
    </div>

    <table class="table" id="users-table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Pseudo</th>
                <th>Email</th>
                <th>Date_création</th>
                <th>Dernière_modif</th>
                <th>Profile</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($usersdeleteds as $usersdeleted)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $usersdeleted->name}}</td>
                    <td>{{ $usersdeleted->email }}</td>
                    <td>{{ $usersdeleted->created_at }}</td>
                    <td>{{ $usersdeleted->updated_at }}</td>
                    <td>  <a style="background: none;border:none;"  href="{{ route('users.show', $usersdeleted->id) }}"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgb(226, 52, 8);transform: ;msFilter:;"><path d="M6 7H5v13a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7H6zm10.618-3L15 2H9L7.382 4H3v2h18V4z"></path></svg></a>  </td>
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


function confirmDeletion(event) {
    event.preventDefault();
    if (confirm("Êtes-vous sûr de vouloir supprimer cet utilisateur ?")) {
        event.target.submit();
    }
    return false;
}

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



