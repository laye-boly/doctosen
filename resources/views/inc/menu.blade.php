<nav class="navbar navbar-expand-lg bg-light fixed-top shadow-lg">
    <div class="container">
        <a class="navbar-brand mx-auto d-lg-none" href="index.html">
            Medic Care
            <strong class="d-block">Health Specialist</strong>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="/">Home</a>
                </li>
               
                @if(Auth::user()!= null && Auth::user()->type == "doctor")
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('schedule.index')}}">Mes emplois de temps</a>
                    </li>
                @endif
                @if(Auth::user()!= null && (Auth::user()->type == "doctor" || Auth::user()->type == "patient"))
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('appointement.index')}}">Consulation</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('medical.index')}}">Document Médicaux</a>
                    </li>
                @endif

                @if(Auth::user() != null && Auth::user()->type == "doctor")
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('diploma.index')}}">Mes diplômes</a>
                    </li>
                @endif

                @if(Auth::user() != null && Auth::user()->type == "hospital")
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('vaccine.index')}}">Mes vaccins</a>
                    </li>
                @endif

                @if (Auth::user() != null && (Auth::user()->type == "doctor" || Auth::user()->type == "hospital"))
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('hospital.index')}}">Mes hôpitaux</a>
                    </li>
                    
                @endif

                @if (Auth::user() != null &&  Auth::user()->type == "hospital")
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('vaccine.appointement.index')}}">Mes Rendez -vous</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{route('vaccine.schedule.index')}}">Mes emploi des temps</a>
                    </li>
                    
                @endif

                @if (Auth::user() != null &&  Auth::user()->type == "patient")
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('vaccine.appointement.index')}}">Vaccination</a>
                    </li>
                @endif

                

                <li class="nav-item">
                    <a class="nav-link" href="/user/profile">Mon profil</a>
                </li>

                

                <li class="nav-item">
                    <a class="nav-link" href="{{route('home')}}#contact">Nous Contacter</a>
                </li>

                @if (Route::has('login'))

                    @auth
                        {{-- <li class="nav-item">
                            <a href="/logout" class="nav-link">Se déconnecter</a>
                        </li> --}}
                @else
                    <li class="nav-item">

                        <a href="{{ route('login') }}#consultation-booking" class="nav-link">Se connecter</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">

                            <a href="{{ route('register') }}" class="nav-link">S'inscrire</a>
                        </li>
                    @endif
                    @endauth

                 @endif

            </ul>
        </div>

    </div>
</nav>