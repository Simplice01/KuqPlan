@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h3 class="mb-4 text-center text-black">Modifier la publication</h3>
    {{-- @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif --}}
    <form action="{{ route('blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="title">Titre</label>
            <input type="text" id="title" value="{{ old('nom', $blog->title) }}" name="title" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="content">Description</label>
            <textarea id="content" name="content"  class="form-control" rows="3">{{ old('nom', $blog->content) }}</textarea>
        </div>


        <div class="form-group">
            <label for="image">Image</label>
            <!-- Affiche l'image actuelle si elle existe -->
            @if($blog->image)
                <div class="mb-3">
                    <img src="{{ asset('storage/' . $blog->image) }}" alt="Image du blog"  style="max-width: 200px;">
                </div>
            @endif
          
                <label for="image">Image</label>
                <input type="file"  name="image" value="{{ old('nom', $blog->image) }}"  accept="image/*">
           


        </div>

        <div class="form-group" style="margin: auto;padding:10px;">
            <button class="btninscription" type="submit"  >Modifier la publication</button>
         </div>
    </form>
</div>
@endsection
