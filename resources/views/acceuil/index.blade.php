
@extends('layouts.app')

@section('content')
  
    <div class="cvimgcoveracl">
      <div id="mesbtnhdac" class="mesbtnhdac">
          <a class="btnhdac" href="{{ route('login') }}">Connexion</a> 
           <a class="btnhdac" href="{{ route('users.create') }}">inscription</a>
      </div>

    </div>
    <div class="afflogosuivre">
      
        <div class="logosuivrehdac">
        <a style="text-decoration:none;color:black" href="{{ route('users.create') }}">
          <svg xmlns="http://www.w3.org/2000/svg" width="34" height="34" viewBox="0 0 24 24" style="fill: rgb(232, 16, 117);transform: ;msFilter:;"><path d="M7.5 6.5C7.5 8.981 9.519 11 12 11s4.5-2.019 4.5-4.5S14.481 2 12 2 7.5 4.019 7.5 6.5zM20 21h1v-1c0-3.859-3.141-7-7-7h-4c-3.86 0-7 3.141-7 7v1h17z"></path></svg>
          <h6>S'identifier</h6></a> 
        </div>
         
       <div class="logosuivrehdac"> 
        <a style="text-decoration:none;color:black;" href="{{ route('users.create') }}">
        <svg xmlns="http://www.w3.org/2000/svg" width="34" height="34" viewBox="0 0 24 24" style="fill: rgb(232, 16, 117);transform: ;msFilter:;"><path d="M19.023 16.977a35.13 35.13 0 0 1-1.367-1.384c-.372-.378-.596-.653-.596-.653l-2.8-1.337A6.962 6.962 0 0 0 16 9c0-3.859-3.14-7-7-7S2 5.141 2 9s3.14 7 7 7c1.763 0 3.37-.66 4.603-1.739l1.337 2.8s.275.224.653.596c.387.363.896.854 1.384 1.367l1.358 1.392.604.646 2.121-2.121-.646-.604c-.379-.372-.885-.866-1.391-1.36zM9 14c-2.757 0-5-2.243-5-5s2.243-5 5-5 5 2.243 5 5-2.243 5-5 5z"></path></svg>     
        <h6>Chercher </h6></a>
      </div>

      <div class="logosuivrehdac">
        <a style="text-decoration:none;color:black;" href="{{ route('users.create') }}">
          <svg xmlns="http://www.w3.org/2000/svg" width="34" height="34" viewBox="0 0 24 24" style="fill: rgb(232, 16, 117);transform: ;msFilter:;"><path d="M16.604 11.048a5.67 5.67 0 0 0 .751-3.44c-.179-1.784-1.175-3.361-2.803-4.44l-1.105 1.666c1.119.742 1.8 1.799 1.918 2.974a3.693 3.693 0 0 1-1.072 2.986l-1.192 1.192 1.618.475C18.951 13.701 19 17.957 19 18h2c0-1.789-.956-5.285-4.396-6.952z"></path><path d="M9.5 12c2.206 0 4-1.794 4-4s-1.794-4-4-4-4 1.794-4 4 1.794 4 4 4zm0-6c1.103 0 2 .897 2 2s-.897 2-2 2-2-.897-2-2 .897-2 2-2zm1.5 7H8c-3.309 0-6 2.691-6 6v1h2v-1c0-2.206 1.794-4 4-4h3c2.206 0 4 1.794 4 4v1h2v-1c0-3.309-2.691-6-6-6z"></path></svg>   
          <h6>Trouver </h6></a>
      </div>

     <div class="logosuivrehdac">
     <a style="text-decoration:none;color:black;" href="{{ route('users.create') }}"> 
        <svg xmlns="http://www.w3.org/2000/svg" width="34" height="34" viewBox="0 0 24 24" style="fill: rgb(232, 16, 117);transform: ;msFilter:;"><path d="M20 10.999h2C22 5.869 18.127 2 12.99 2v2C17.052 4 20 6.943 20 10.999z"></path><path d="M13 8c2.103 0 3 .897 3 3h2c0-3.225-1.775-5-5-5v2zm3.422 5.443a1.001 1.001 0 0 0-1.391.043l-2.393 2.461c-.576-.11-1.734-.471-2.926-1.66-1.192-1.193-1.553-2.354-1.66-2.926l2.459-2.394a1 1 0 0 0 .043-1.391L6.859 3.513a1 1 0 0 0-1.391-.087l-2.17 1.861a1 1 0 0 0-.29.649c-.015.25-.301 6.172 4.291 10.766C11.305 20.707 16.323 21 17.705 21c.202 0 .326-.006.359-.008a.992.992 0 0 0 .648-.291l1.86-2.171a1 1 0 0 0-.086-1.391l-4.064-3.696z"></path></svg>
        <h6>Contacter</h6>
        </a>
      </div>
     

    </div>
    <div class="lesimgac">

    <div>
      <a href="{{ route('users.create') }}">
        <img class="imgacceuil" src="{{ asset('storage/public/images/imgtlphne.jpg') }}"  alt="" srcset="">
      </a>
    </div>

    <div>
      <a href="{{ route('users.create') }}">
        <img class="imgacceuil" src="{{ asset('storage/public/images/immll.jpg') }}"  alt="" srcset="">
      </a>
    </div>

    <div>
      <a href="{{ route('users.create') }}">
        <img class="imgacceuil" src="{{ asset('storage/public/images/immlll.jpg') }}"  alt="" srcset="">
      </a>
    </div>

    
    <div class="container">
        <h2 style="color:#E81075;text-align:center;font-weight:bold;margin-top:5px;" class="mb-4">Blogs</h2>
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
    
 

    <div class=" titrepage mt-2">
        <h2 style="color:#E81075;text-align:center;font-weight:bold;margin-top:5px;" class="mb-4">Avis</h2>
        <div class="carousel">
            @foreach ($feedbacks as $feedback)
                   <div class="carousel__item">
                   <h1 style="text-align:center;"><svg xmlns="http://www.w3.org/2000/svg" width="44" height="44" viewBox="0 0 24 24" style="fill: black;transform: ;msFilter:;"><path d="M12 2C6.579 2 2 6.579 2 12s4.579 10 10 10 10-4.579 10-10S17.421 2 12 2zm0 5c1.727 0 3 1.272 3 3s-1.273 3-3 3c-1.726 0-3-1.272-3-3s1.274-3 3-3zm-5.106 9.772c.897-1.32 2.393-2.2 4.106-2.2h2c1.714 0 3.209.88 4.106 2.2C15.828 18.14 14.015 19 12 19s-3.828-.86-5.106-2.228z"></path></svg></h1>
                   <p>
                     <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" style="fill: rgb(232, 16, 117);transform: ;msFilter:;"><path d="M6.5 10c-.223 0-.437.034-.65.065.069-.232.14-.468.254-.68.114-.308.292-.575.469-.844.148-.291.409-.488.601-.737.201-.242.475-.403.692-.604.213-.21.492-.315.714-.463.232-.133.434-.28.65-.35l.539-.222.474-.197-.485-1.938-.597.144c-.191.048-.424.104-.689.171-.271.05-.56.187-.882.312-.318.142-.686.238-1.028.466-.344.218-.741.4-1.091.692-.339.301-.748.562-1.05.945-.33.358-.656.734-.909 1.162-.293.408-.492.856-.702 1.299-.19.443-.343.896-.468 1.336-.237.882-.343 1.72-.384 2.437-.034.718-.014 1.315.028 1.747.015.204.043.402.063.539l.025.168.026-.006A4.5 4.5 0 1 0 6.5 10zm11 0c-.223 0-.437.034-.65.065.069-.232.14-.468.254-.68.114-.308.292-.575.469-.844.148-.291.409-.488.601-.737.201-.242.475-.403.692-.604.213-.21.492-.315.714-.463.232-.133.434-.28.65-.35l.539-.222.474-.197-.485-1.938-.597.144c-.191.048-.424.104-.689.171-.271.05-.56.187-.882.312-.317.143-.686.238-1.028.467-.344.218-.741.4-1.091.692-.339.301-.748.562-1.05.944-.33.358-.656.734-.909 1.162-.293.408-.492.856-.702 1.299-.19.443-.343.896-.468 1.336-.237.882-.343 1.72-.384 2.437-.034.718-.014 1.315.028 1.747.015.204.043.402.063.539l.025.168.026-.006A4.5 4.5 0 1 0 17.5 10z"></path></svg>
                     {{ $feedback->content }}
                     <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" style="fill:rgb(232, 16, 117);transform: ;msFilter:;"><path d="m21.95 8.721-.025-.168-.026.006A4.5 4.5 0 1 0 17.5 14c.223 0 .437-.034.65-.065-.069.232-.14.468-.254.68-.114.308-.292.575-.469.844-.148.291-.409.488-.601.737-.201.242-.475.403-.692.604-.213.21-.492.315-.714.463-.232.133-.434.28-.65.35l-.539.222-.474.197.484 1.939.597-.144c.191-.048.424-.104.689-.171.271-.05.56-.187.882-.312.317-.143.686-.238 1.028-.467.344-.218.741-.4 1.091-.692.339-.301.748-.562 1.05-.944.33-.358.656-.734.909-1.162.293-.408.492-.856.702-1.299.19-.443.343-.896.468-1.336.237-.882.343-1.72.384-2.437.034-.718.014-1.315-.028-1.747a7.028 7.028 0 0 0-.063-.539zm-11 0-.025-.168-.026.006A4.5 4.5 0 1 0 6.5 14c.223 0 .437-.034.65-.065-.069.232-.14.468-.254.68-.114.308-.292.575-.469.844-.148.291-.409.488-.601.737-.201.242-.475.403-.692.604-.213.21-.492.315-.714.463-.232.133-.434.28-.65.35l-.539.222c-.301.123-.473.195-.473.195l.484 1.939.597-.144c.191-.048.424-.104.689-.171.271-.05.56-.187.882-.312.317-.143.686-.238 1.028-.467.344-.218.741-.4 1.091-.692.339-.301.748-.562 1.05-.944.33-.358.656-.734.909-1.162.293-.408.492-.856.702-1.299.19-.443.343-.896.468-1.336.237-.882.343-1.72.384-2.437.034-.718.014-1.315-.028-1.747a7.571 7.571 0 0 0-.064-.537z"></path></svg>
                   </p>
                   <h6 class="nameavis">{{ $feedback->user->name }}</h6>
                 </div>
          @endforeach
      </div>

</script>
@endsection