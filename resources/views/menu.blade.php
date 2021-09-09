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

                <li class="nav-item">
                    <a class="nav-link" href="#about">Qui sommes nous</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#timeline">Nos services</a>
                </li>

                

                <li class="nav-item">
                    <a class="nav-link" href="#reviews">Témoignages</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#booking">Prendre un rv</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#contact">Contact</a>
                </li>

                @if (Route::has('login'))

                    @auth
                        <li class="nav-item">
                            <a href="{{ url('/dashboard') }}" class="nav-link">Dashboard</a>
                        </li>
                @else
                    <li class="nav-item">

                        <a href="{{ route('login') }}" class="nav-link">Se connecter</a>
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