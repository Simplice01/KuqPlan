@extends('layouts.app')

@section('content')
<div class="lesparties">

    <div class="partimg">
        <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 15rem;"
        src="{{ asset('storage/public/images/fun.png') }}" >
       <h3 style="font-family: cursive;color:#f02882">Envoyer un mail</h3>
    </div>
 
    <form action="{{ route('password.send-code') }}" class="formulaireinscri" method="POST">
        <div style="padding: 15px;"  class="logoinscr">
            <svg xmlns="http://www.w3.org/2000/svg" width="44" height="44" viewBox="0 0 24 24" style="fill: #E81075;transform: ;msFilter:;"><path d="m18.73 5.41-1.28 1L12 10.46 6.55 6.37l-1.28-1A2 2 0 0 0 2 7.05v11.59A1.36 1.36 0 0 0 3.36 20h3.19v-7.72L12 16.37l5.45-4.09V20h3.19A1.36 1.36 0 0 0 22 18.64V7.05a2 2 0 0 0-3.27-1.64z"></path></svg>
            <h3 style="padding: 15px;color:#f02882"></h3>
           </div>
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label"></label>
            <input type="email" name="email" id="email" placeholder="Entrer votre email" class="inputtext" required>
        </div>
        <div class="btninscri">
            <button type="submit" class="btninscription">Envoyer le code</button>
        </div>
        <br> <br>
        
    </form>
</div>
@endsection
