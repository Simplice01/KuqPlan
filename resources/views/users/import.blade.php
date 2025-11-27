
@extends('layouts.app')

@section('content')

<div class="user-list">
    <div class="user-item">
        <div class="user-image">
            <img src="https://via.placeholder.com/100" alt="User 1">
            <span class="online-indicator"></span>
        </div>
        <div class="user-name">User 1</div>
    </div>
    <div class="user-item">
        <div class="user-image">
            <img src="https://via.placeholder.com/100" alt="User 2">
            <span class="online-indicator"></span>
        </div>
        <div class="user-name">User 2</div>
    </div>
    <div class="user-item">
        <div class="user-image">
            <img src="https://via.placeholder.com/100" alt="User 3">
            <span class="online-indicator"></span>
        </div>
        <div class="user-name">User 3</div>
    </div>
    <!-- Ajoutez d'autres utilisateurs ici -->
</div>


<style>


.user-list {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
}

.user-item {
    display: flex;
    align-items: center;
    margin: 10px 0;
}

.user-image {
    position: relative;
    margin-right: 10px;
}

.user-image img {
    width: 100px;
    height: 100px;
    border-radius: 50%; /* Pour rendre l'image circulaire */
    border: 2px solid #f0f0f0; /* Bordure autour de l'image */
}

.online-indicator {
    position: absolute;
    bottom: 5px; /* Ajuste cette valeur selon la taille de l'image */
    right: 5px; /* Ajuste cette valeur selon la taille de l'image */
    width: 20px; /* Taille de l'indicateur */
    height: 20px; /* Taille de l'indicateur */
    background-color: green; /* Couleur de l'indicateur */
    border-radius: 50%; /* Rendre l'indicateur circulaire */
    border: 2px solid white; /* Bordure blanche pour l'indicateur */
}

.user-name {
    font-size: 18px; /* Taille du texte du nom */
    color: #333; /* Couleur du texte */
}
</style>
@endsection
