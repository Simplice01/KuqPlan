@extends('layouts.app')

@section('content')
<style>
    .custom-file-upload {
    position: relative;
    width: 100%;
}

.custom-file-input {
    position: absolute;
    top: 0;
    right: 0;
    opacity: 0;
    width: 100%;
    height: 100%;
    cursor: pointer;
}

.custom-file-label {
    background-color: #f8f9fa;
    padding: 10px 15px;
    display: inline-block;
    cursor: pointer;
    border: 1px solid #ced4da;
    border-radius: 4px;
    width: 100%;
    text-align: center;
}

.custom-file-label:hover {
    background-color: #e2e6ea;
}

.custom-file-input:focus + .custom-file-label {
    border-color: #80bdff;
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
}

</style>
    <div class="container mt-4 w-50">
        <h1 class="mb-4 text-center text-dark">Ajouter une blog</h1>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

       

        <form action="{{ route('blogs.store') }}" method="POST" enctype="multipart/form-data" accept="image/*">
            @csrf

            <div class="form-group">
                <label for="title">Titre</label>
                <input type="text" id="title" name="title" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="content">Contenu</label>
                <textarea id="content" name="content" class="form-control" rows="3"></textarea>
            </div>


            <div class="form-group custom-file-upload">
                <label for="image" class="custom-file-label">Choisir une image</label>
                <input type="file" id="image" name="image" class="form-control-file custom-file-input" accept="image/*">
            </div> <br> <br>


             <div class="form-group" style="margin: auto;padding:10px;">
                <button class="btninscription" type="submit"  >Ajouter la publication</button>
             </div>
        </form>

    </div>
@endsection

