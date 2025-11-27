@extends('layouts.app')

@section('content')

<style>

</style>


@if (session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Succès!',
        text: '{{ session('success') }}',
        confirmButtonText: 'Ok',
        customClass: {
            confirmButton: 'swal2-confirm' // Applique la classe au bouton "Ok"
        }
    });
</script>
@endif

@if (session('error'))
<script>
    Swal.fire({
        icon: 'error',
        title: 'Erreur!',
        text: '{{ session('error') }}',
        confirmButtonText: 'Ok',
        customClass: {
            confirmButton: 'swal2-confirm' // Applique la classe au bouton "Ok"
        }
    });
</script>
@endif

@if ($errors->any())
<script>
    Swal.fire({
        icon: 'error',
        title: 'Erreur de validation!',
        html: '<ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>',
        confirmButtonText: 'Ok',
        customClass: {
            confirmButton: 'swal2-confirm' // Applique la classe au bouton "Ok"
        }
    });
</script>
@endif

<div class="container">
    <h2 style="color:#E81075;text-align:center;font-weight:bold;margin-top:5px;" class="mb-4">Blogs</h2>
    <div style="margin: auto;text-align:center;" class="d-flex ">
        @auth
            @if(auth()->user()->role == 'admin' )
                <!-- Bouton Modifier -->
                <a class="btninscription"  href="{{ route('blogs.create') }}">
                   Nouvelle publication
                </a>
            @endif
        @endauth
    </div>
    <br>

    <div class="mb-4">
      <!-- Barre de recherche stylisée avec largeur réduite -->
      <div class="input-group mb-3" style="max-width: 400px;">
        <input style="border-bottom: 2px solid #E81075" type="text" id="search" class="form-control" placeholder="Rechercher une publication..." aria-label="Rechercher une blog" aria-describedby="search-addon" style="border: 2px solid #E81075; border-right: none;">
        <span class="input-group-text" id="search-addon" style="background:none; border-left: 2px solid #E81075;">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: #E81075;">
                <path d="M19.023 16.977a35.13 35.13 0 0 1-1.367-1.384c-.372-.378-.596-.653-.596-.653l-2.8-1.337A6.962 6.962 0 0 0 16 9c0-3.859-3.14-7-7-7S2 5.141 2 9s3.14 7 7 7c1.763 0 3.37-.66 4.603-1.739l1.337 2.8s.275.224.653.596c.387.363.896.854 1.384 1.367l1.358 1.392.604.646 2.121-2.121-.646-.604c-.379-.372-.885-.866-1.391-1.36zM9 14c-2.757 0-5-2.243-5-5s2.243-5 5-5 5 2.243 5 5-2.243 5-5 5z"></path>
            </svg>
        </span>
    </div>
    </div>

    <div id="message" class="alert alert-success mt-3" style="display:none;"></div>
    <div class="row" id="products-list">
        @foreach ($blogs as $blog)
            <div class="col-md-4 mb-4 product-item" data-name="{{ strtolower($blog->title) }}">

                <div class="blog-card" >

                    <!-- Section de l'image, du titre et du prix à gauche -->
                    <a href="{{ route('blogs.show', $blog->id) }}" >
                    <div class="blog-image-section">
                        @if ($blog->image)
                        <img  src="{{ asset('storage/' . $blog->image) }}"  alt="{{ $blog->title }}" >
                    @else
                        <img src="https://via.placeholder.com/600x300"  alt="No image" >
                    @endif
                </a>
                        <div class="blog-title-price">
                            <h5> {{ $blog->title }}</h5>
                            <h5>              
                                
                                <div class="lireplus">

                                    <a  class="share-button" style="color:black;"   href="{{ route('blogs.show', $blog->id) }}">Lire l'article</a>    
    
                                  </div>
                                 <br>
                                @php
                                $days = \Carbon\Carbon::parse($blog->created_at)->diffInDays(now());
                            @endphp

                            <small>Publié
                                @if($days === 0)
                                    aujourd'hui
                                @elseif($days === 1)
                                    il y a 1 jour
                                @else
                                    il y a {{ $days }} jours
                                @endif
                            </small></h5>
                            {{-- <p>Prix: 19.99€</p> --}}
                            
                            <div class="blog-footer">
                                <div class="buttons" style="display:none;">
                                    <!-- Bouton J'aime -->

                                    <button class="like-button {{ $blog->userLiked ? 'liked' : '' }}"
                                        data-id="{{ $blog->id }}"
                                        data-authenticated="{{ auth()->check() ? 'true' : 'false' }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                        <path d="M4 21h1V8H4a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2zM20 8h-7l1.122-3.368A2 2 0 0 0 12.225 2H12L7 7.438V21h11l3.912-8.596L22 12v-2a2 2 0 0 0-2-2z"></path>
                                    </svg>
                                    <span class="like-count">{{ $blog->likes_count }}</span>
                                </button>

                                    <!-- Bouton Partage -->
                                    <button  class="share-button"  id="shareBtn" data-id="{{ $blog->id }}">

                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                            <path d="M3 12c0 1.654 1.346 3 3 3 .794 0 1.512-.315 2.049-.82l5.991 3.424c-.018.13-.04.26-.04.396 0 1.654 1.346 3 3 3s3-1.346 3-3-1.346-3-3-3c-.794 0-1.512.315-2.049.82L8.96 12.397c.018-.131.04-.261.04-.397s-.022-.266-.04-.397l5.991-3.423c.537.505 1.255.82 2.049.82 1.654 0 3-1.346 3-3s-1.346-3-3-3-3 1.346-3 3c0 .136.022.266.04.397L8.049 9.82A2.982 2.982 0 0 0 6 9c-1.654 0-3 1.346-3 3z"></path>
                                        </svg>
                                    </button>

                                    <!-- Bouton Contact -->


                                    <button class="contact-button" style="color:black;" id="contactBtn" data-id="{{ $blog->id }}" data-phone="{{ $blog->tel }}">Lire</button>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    </div>
    <div class="pagination-wrapper">
        {{ $blogs->links() }}
    </div>


</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<script>
    $(document).ready(function() {
        $('#search').on('input', function() {
            var query = $(this).val().toLowerCase();
            $('.product-item').each(function() {
                var title = $(this).data('name');
                $(this).toggle(title.includes(query));
            });
        });
    });
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

@endsection

