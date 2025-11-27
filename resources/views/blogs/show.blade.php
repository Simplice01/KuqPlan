@extends('layouts.app')

@section('content')

<style>
    .blog-card {
        max-width: 900px;
        margin: 50px auto;
        background-color: #fff;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        display: flex;
        flex-direction: row;
    }
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
   
    <div style="display:block;margin:auto;margin-top:15px;" class="blog-card">

        <!-- Section de l'image, du titre et du prix à gauche -->
        <div class="blog-image-section"> 
            @if ($blog->image)
            <img style="width: 50%;;" src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}">
        @else
            <img src="https://via.placeholder.com/600x300" alt="No image">
        @endif
        </div>



        <!-- Section de description et des boutons à droite -->
        <div class="blog-details-section">
            <div class="blog-description">
                <h2 class="cadretitreb" style="text-align: center; color:rgb(0, 0, 0); font-weight: bold; font-size: 25px;">
                    {{ $blog->title }}
                </h2>
            
                @if (!empty($blog->content))
                    @foreach (explode("\n\n", $blog->content) as $paragraph)
                        <p style="text-align: justify;">
                            {{ $paragraph }}
                        </p>
                    @endforeach
                @else
                    <p style="text-align: justify;">Le contenu de cet article est vide.</p>
                @endif
            </div>
            <div class="blog-footer">
                <div class="buttons" style="padding:15px;margin:auto;">

                    <h5 style="font-weight:bold;color:red;">
                        @php
                            $days = \Carbon\Carbon::parse($blog->datebpub)->diffInDays(now());
                        @endphp
    
                        <small>Publié
                            @if($days === 0)
                                aujourd'hui
                            @elseif($days === 1)
                                il y a 1 jour
                            @else
                                il y a {{ $days }} jours
                            @endif
                        </small>
                    </h5>

                     <br>
                    <button class="share-button" style="color:black;" id="shareBtn" data-id="{{ $blog->id }}">
                        Partager
                    </button> 
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<div style="margin: auto;text-align:center;" class="d-flex ">
    @auth
        @if(auth()->user()->role == 'admin' || auth()->user()->id == $blog->user_id)
            <!-- Bouton Modifier -->
            <a class="btn btn-primary mr-2" href="{{ route('blogs.edit', $blog->id) }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(255, 255, 255, 1);transform: ;msFilter:;"><path d="m18.988 2.012 3 3L19.701 7.3l-3-3zM8 16h3l7.287-7.287-3-3L8 13z"></path><path d="M19 19H8.158c-.026 0-.053.01-.079.01-.033 0-.066-.009-.1-.01H5V5h6.847l2-2H5c-1.103 0-2 .896-2 2v14c0 1.104.897 2 2 2h14a2 2 0 0 0 2-2v-8.668l-2 2V19z"></path></svg>
                Modifier
            </a>

            <!-- Bouton Supprimer -->
            <form action="{{ route('blogs.destroy', $blog->id) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">
                    Supprimer
                </button>
            </form>
        @endif
    @endauth
</div>

<script>
    $(document).ready(function() {
    $('.like-button').on('click', function() {
        var $likeButton = $(this);
        var blogId = $likeButton.data('id');

                $.ajax({
            url: '/like/' + blogId,
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
                if (data.status === 'not_authenticated') {
                    window.location.href = data.redirect_url;
                } else if (data.status === 'liked' || data.status === 'unliked') {
                    $likeButton.find('.like-count').text(data.likes_count);
                    $likeButton.toggleClass('liked', data.status === 'liked');
                }
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
            }
        });

    });

        // Gestion du Partage
        document.querySelector('.share-button').addEventListener('click', function () {
            const id = this.dataset.id;
            window.open(`https://www.facebook.com/sharer/sharer.php?u=http://example.com/blogs/${id}`, '_blank');
        });

        // Gestion du Contact
        document.querySelector('.contact-button').addEventListener('click', function () {
            const phone = this.dataset.phone;
            window.location.href = `https://wa.me/${phone}?text=Bonjour, j'aimerais discuter de votre blog.`;
        });
    });
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

@endsection
