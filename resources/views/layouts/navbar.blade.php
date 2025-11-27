
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
        }

        .navbar {
            /* background-color: rgb(232, 16, 117,0.9); */
            background: linear-gradient(135deg, #1f1b1d, #E81075);
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            position: sticky; /* Fixed navbar */
            top: 0;
            z-index: 100;
            width: 100%;
        }

        .logo {
            color: white;
            font-size: 24px;
            font-weight: bold;
        }

        .nav-links {
            list-style: none;
            display: flex;
            gap: 20px;
            margin-right: 20px;

        }

        .nav-links li {
            opacity: 1;
            transform: translateX(0);
            transition: all 0.3s ease;
        }

        .nav-links li a {
            text-decoration: none;
            color: white;
            font-size: 15px;
            font-weight: bold;
            padding: 5px 10px;
            position: relative;
        }

        .nav-links li a::before {
            content: '';
            position: absolute;
            width: 0%;
            height: 3px;
            bottom: 0;
            left: 0;
            background-color: white;
            transition: width 0.3s ease;
        }

        .nav-links li a:hover::before {
            width: 100%;
        }

        .hamburger {
            display: none;
            flex-direction: column;
            cursor: pointer;
        }

        .hamburger span {
            height: 3px;
            width: 25px;
            background-color: white;
            margin: 4px;
            transition: all 0.3s ease;
        }

        /* Responsive Styling */
        @media screen and (max-width: 768px) {
            .nav-links {
                position: fixed;
                top: 0;
                right: -25px;
                height: 100vh;
                width: 60%;
                background-color: #E81075;

                flex-direction: column;
                justify-content: center;
                align-items: center;
                transform: translateX(100%);
                transition: transform 0.5s ease;
                padding-top: -20px;
            }

            .nav-links.open {
                transform: translateX(0);
            }

            .hamburger {
                display: flex;
            }

            .hamburger.active span:nth-child(1) {
                transform: rotate(45deg) translate(5px, 5px);
            }

            .hamburger.active span:nth-child(2) {
                opacity: 0;
            }

            .hamburger.active span:nth-child(3) {
                transform: rotate(-45deg) translate(5px, -5px);
            }
        }
    </style>

    <nav class="navbar">
        <div class="logo"><a style="text-decoration:none;color:white;" href="{{ route('home') }}">Kuqplan</a> </div>
        <ul class="nav-links">

        @guest
            <li><a href="{{ route('home') }}">Acceuil</a></li>
            <li><a href="{{ route('blogs.index') }}">Blog</a></li>
            <li><a href="{{ route('login') }}">Connexion</a></li>
            <li><a href="{{ route('users.create') }}">Inscription</a></li>
        @endguest
        @auth
        @if(auth()->user()->role === 'admin')
        <li><a href="{{ route('users.index') }}">Acceuil</a></li>
        <li><a href="{{ route('blogs.index') }}">Blog</a></li>
        <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li>
                <a href="{{ route('users.show', auth()->user()->id) }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgb(255, 255, 255);transform: ;msFilter:;">
                        <path d="M8 12.052c1.995 0 3.5-1.505 3.5-3.5s-1.505-3.5-3.5-3.5-3.5 1.505-3.5 3.5 1.505 3.5 3.5 3.5zM9 13H7c-2.757 0-5 2.243-5 5v1h12v-1c0-2.757-2.243-5-5-5zm11.294-4.708-4.3 4.292-1.292-1.292-1.414 1.414 2.706 2.704 5.712-5.702z"></path>
                    </svg>
                </a>
            </li>
        @elseif(auth()->user()->role === 'user')
        <li><a href="{{ route('users.index') }}">Acceuil</a></li>
        <li><a href="{{ route('blogs.index') }}">Blog</a></li>
        <li><a href="{{ route('rechargements.index') }}">Recharger</a></li>
            <li><a href="{{ route('users.show', auth()->user()->id) }}">Profil</a></li>
        @endif
        <li>
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Déconnexion</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li>
        @endauth
        </ul>
        <div class="hamburger">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </nav>

    <script>
        const hamburger = document.querySelector('.hamburger');
        const navLinks = document.querySelector('.nav-links');

        hamburger.addEventListener('click', () => {
            hamburger.classList.toggle('active');
            navLinks.classList.toggle('open');
        });
    </script>

