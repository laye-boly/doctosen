<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="description" content="">
        <meta name="author" content="">

        <title>Doctose -  @yield('title')</title>

        <!-- CSS FILES -->        
        <link rel="preconnect" href="https://fonts.googleapis.com">
        
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">

   
            <link href="css/bootstrap.min.css" rel="stylesheet">

            <link href="css/bootstrap-icons.css" rel="stylesheet">

            <link href="css/owl.carousel.min.css" rel="stylesheet">

            <link href="css/owl.theme.default.min.css" rel="stylesheet">

            <link href="css/templatemo-medic-care.css" rel="stylesheet">
            <link rel="stylesheet" href="css/style.doctosen.css">
      

    </head>
    
    <body id="top">
    
        <main>
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
                                <a class="nav-link" href="{{route('home')}}#about">Qui sommes nous</a>
                            </li>
            
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('home')}}#timeline">Nos services</a>
                            </li>
            
                            
            
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('home')}}#reviews">Témoignages</a>
                            </li>
            
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle"  id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">Prendre un rv</a>
                                <ul class="dropdown-menu bg-F8F9FA" aria-labelledby="dropdownMenuLink">
                    
                                    <li><a class="dropdown-item BDBEC0-color" href="{{route('home')}}#consultation-booking">Consultation en ligne ou en présentiel</a></li>
                                    <li><a class="dropdown-item BDBEC0-color" href="{{route('home')}}#vaccination-booking">Vaccination</a></li>
                                    
                                </ul>
                            </li>
            
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('home')}}#contact">Contact</a>
                            </li>
            
                            @if (Route::has('login'))
            
                                @auth
                                    <li class="nav-item">
                                        <a href="{{ url('/dashboard') }}" class="nav-link">Dashboard</a>
                                    </li>
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

                <section class="section-padding" id="booking">
                    <div class="container">
                        <div class="row">
                        
                            <div class="col-lg-12 col-12 mx-auto">
                                <div class="booking-form">
                                    
                                    <h2 class="text-center mb-lg-3 mb-2" id="consultation-booking">Connexion</h2>
                                   
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach  ($errors->all() as $error)
                                                    <li>{{$error}}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                            
                                    @endif
                                    @if (session('status'))
                                    <div class="mb-4 font-medium text-sm text-green-600">
                                        {{ session('status') }}
                                    </div>
                                    @endif
                                   
                                    {!! Form::open(['url' => route('login') ]) !!}

                                        <div class="col-md-6">
                                            {{Form::label('email', "Email", ['class' => 'form-label'])}}
                                            {{ Form::email('email', null,['class' => 'form-control', 'required' => 'required', "id" => "email"]) }}
                                
                                        </div>
                                        <div class="col-md-6">
                                    
                                            {{Form::label('password', "Mot de passe", ['class' => 'form-label', 'id' => 'password'])}}<br>
                                            {{ Form::password('password', ['class' => 'form-control', 'required' => 'required']) }}
                                
                                        </div>
                                        <div class="col-md-6">
                                     
                                            {{Form::label('Se souvenir de moi', null, ['class' => 'form-label'])}} 
                                            {{ Form::checkbox('remember', null, ['class' => 'form-control', 'id' => "remember_me"]) }}
     
                                        </div>

                                        <div class="col-md-6">
                                            {{ Form::submit("Se connecter", ['class' => 'btn btn-primary'])}}
                                        </div>

                                        <div id="register-link" class="text-right">
                                            @if (Route::has('password.request'))
                                            <a href="{{ route('password.request') }}" class="text-info">Mot de passe oublié ?</a>
                                        
                                        @endif
                                    {!! Form::close() !!} 
                                   
            

                                </div>
                            </div>

                        </div>
                    </div>
                </section>
                
         
                
  

        </main>

            <footer class="site-footer section-padding" id="contact">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-5 me-auto col-12">
                            <h5 class="mb-lg-4 mb-3">Opening Hours</h5>

                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex">
                                    Sunday : Closed
                                </li>

                                <li class="list-group-item d-flex">
                                    Monday, Tuesday - Firday
                                    <span>8:00 AM - 3:30 PM</span>
                                </li>

                                <li class="list-group-item d-flex">
                                    Saturday
                                    <span>10:30 AM - 5:30 PM</span>
                                </li>
                            </ul>
                        </div>

                        <div class="col-lg-2 col-md-6 col-12 my-4 my-lg-0">
                            <h5 class="mb-lg-4 mb-3">Our Clinic</h5>

                            <p><a href="mailto:hello@company.co">hello@company.co</a><p>

                            <p>123 Digital Art Street, San Diego, CA 92123</p>
                        </div>

                        <div class="col-lg-3 col-md-6 col-12 ms-auto">
                            <h5 class="mb-lg-4 mb-3">Socials</h5>

                            <ul class="social-icon">
                                <li><a href="#" class="social-icon-link bi-facebook"></a></li>

                                <li><a href="#" class="social-icon-link bi-twitter"></a></li>

                                <li><a href="#" class="social-icon-link bi-instagram"></a></li>

                                <li><a href="#" class="social-icon-link bi-youtube"></a></li>
                            </ul>
                        </div>

                        <div class="col-lg-3 col-12 ms-auto mt-4 mt-lg-0">
                            <p class="copyright-text">Copyright © Medic Care 2021 
                            <br><br>Design: <a href="https://templatemo.com" target="_parent">TemplateMo</a></p>
                        </div>

                    </div>
                </section>
            </footer>

           
            <script src="js/jquery.min.js"></script>
            <script src="js/bootstrap.bundle.min.js"></script>
            <script src="js/owl.carousel.min.js"></script>
            <script src="js/scrollspy.min.js"></script>
            <script src="js/custom.js"></script>
     
    </body>
</html>