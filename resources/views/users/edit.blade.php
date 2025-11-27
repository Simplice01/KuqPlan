@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
        <h4 style="text-align: center;" class="mb-4">Modifier</h4>

        <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
           <div style="text-align:center;">
              
            <div class="form-group">
                <label class="labelcache" for="name">Pseudo</label>
                <input class="inputtext" type="text" id="name"  name="email" value="{{ old('name', $user->name) }}" readonly placeholder="Email" oninput="afficherLabel(this)">
            </div>
           
            <div class="form-group">
                <label class="labelcache" for="email">Email</label>
                <input class="inputtext" type="email" id="email"  name="email" value="{{ old('email', $user->email) }}" readonly placeholder="Email" oninput="afficherLabel(this)">
                <span id="error-message2" class="errorcodoction" >Veuillez entrer un email.</span>
            </div>

            <div class="form-group">
                <label class="labelcache" for="pseudo">Numéro de téléphone</label>
                <input class="inputtext" id="numtel" type="tel" value="{{ old('tel', $user->tel) }}"  name="tel" placeholder="Numéro de téléphone" oninput="afficherLabel(this)">
                <span id="error-message5" class="errorcodoction">Veuillez entré votre de numero téléphone.</span>
            </div>
        </div>


            <select class="selectville" name="city" id="ville">
                <option value="{{ old('city', $user->city) }}">{{ $user->city }}</option>
                <option  value="Abomey-calavi">Abomey-calavi</option>
                <option value="Abidjan">Abidjan</option>
                <option value="Cotonou">Cotonou</option>
                <option value="Lome">Lome</option>
                <option value="Parakou">Parakou</option>
            </select>
    
            <br>
           <select class="selectville" name="skin_tone" id="form">
           <option value="{{ old('skin_tone ', $user->skin_tone ) }}"  >{{ $user->skin_tone }}</option>
                <option  value="Skiny">skiny</option>
                <option value="Apouchou">apouchou</option>
                <option value="normale">normale</option>
           </select>

            {{-- <button type="submit" class="btn btn-primary">Mettre à Jour le Client</button> --}}
            <div class="btninscri" style="margin:15px auto;">
                <button class="btninscription" type="submit" name="inscription"  >Modifier</button>
            </div>
        </form>
    </div>
@endsection
