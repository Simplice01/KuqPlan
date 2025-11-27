
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

    
    </div>
    {{-- @include('blogs.index') --}}
    <div>
 

    <div class=" titrepage mt-2">
          
      </div>

</script>
@endsection